<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Products;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
   
  
public function actionExportExcel() {
    $posts = Products::find()->all();

    // Check if there are any posts
    if (empty($posts)) {
        Yii::$app->session->setFlash('error', 'No data to export.');
        return $this->redirect(['index']);
    }

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set header row
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'NAME');
    $sheet->setCellValue('C1', 'BRAND');
    $sheet->setCellValue('D1', 'CATEGORY');
    $sheet->setCellValue('E1', 'MANUFACTURING DATE');
    $sheet->setCellValue('F1', 'EXPIRY DATE');

    // Add data rows
    $row = 2;
    foreach ($posts as $post) {
        $sheet->setCellValue('A' . $row, $post->id);
        $sheet->setCellValue('B' . $row, $post->name);
        $sheet->setCellValue('C' . $row, $post->brand);
        $sheet->setCellValue('D' . $row, $post->category);
        $sheet->setCellValue('E' . $row, $post->manu_date);
        $sheet->setCellValue('F' . $row, $post->exp_date);
        $row++;
    }

    // Create Excel file
    $writer = new Xlsx($spreadsheet);
    $filename = 'products.xlsx';

    // Start output buffering
    ob_start();

    // Clear output buffer
    if (ob_get_contents()) {
        ob_end_clean();
    }

    // Serve the file for download
    Yii::$app->response->format = Response::FORMAT_RAW;
    Yii::$app->response->getHeaders()->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    Yii::$app->response->getHeaders()->set('Content-Disposition', 'attachment; filename="' . $filename . '"');
    Yii::$app->response->getHeaders()->set('Cache-Control', 'max-age=0');

    // Output the file
    $writer->save('php://output');
    Yii::$app->response->send();
    exit;
}
    
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $posts = Products::find()->all();
        return $this->render('home',['posts'=>$posts]);
    }

    public function actionCreate(){
        $post = new Products();
        $formData = Yii::$app->request->post();
        if($post->load($formData)){
            if($post->save()){
                yii::$app->getSession() ->setFlash('success', 'Product Added Successfully');
                return $this->redirect(['index']);
        }else{
            yii::$app->getSession() ->setFlash('error', 'failed to post');
        }
        
    }
    return $this->render('create',['post'=>$post]);
    }

    public function actionUpdate($id){
        $post = Products::findOne($id);
        if($post->load(yii::$app->request->post()) && $post->save()){
            yii::$app->getSession() ->setFlash('success', 'Record Update Successfully');
            return $this->redirect(['index','id'=>$id]);
        }
        return $this->render('update',['post'=>$post]);
    }
    public function actionDelete($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    
        if (Yii::$app->request->isPost) {
            $post = Products::findOne($id);
            if ($post && $post->delete()) {
                return ['success' => true];
            }
        }
        return ['success' => false];
    }
    public function actionView($id){
        $post = Products::findOne($id);
        return $this->render('view',['post'=>$post]);
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

}
