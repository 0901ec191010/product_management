<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/** @var yii\web\View $this */

$this->title = 'Product-Catalog-Management';
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
?>
<div class="site-index py-3">
    <h2 class="stylish-title">UPDATE PRODUCT</h2>

    <div class="body-content ">
        <?php $form = ActiveForm::begin(['options' => ['class' => 'animated-form']]); ?>
        <div class="row">
            <div class="form-group">
                    <?= $form->field($post, 'name')->textInput(['class' => 'form-control stylish-input']); ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                    <?= $form->field($post, 'brand')->textInput(['class' => 'form-control stylish-input']); ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                    <?= $form->field($post, 'category')->textInput(['class' => 'form-control stylish-input']); ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                    <?= $form->field($post, 'manu_date')->widget(DatePicker::classname(), [
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'dd-mm-yyyy', 
                        ],
                        'options' => [
                            'class' => 'form-control stylish-input',
                            'placeholder' => 'Select'
                        ]
                    ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                    <?= $form->field($post, 'exp_date')->widget(DatePicker::classname(), [
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'dd-mm-yyyy',  
                        ],
                        'options' => [
                            'class' => 'form-control stylish-input',
                            'placeholder' => 'Select ...'
                        ]
                    ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-lg-6 d-flex gap-3">
                    <div class="">
                        <?= Html::submitButton('Update Product', ['class' => 'btn btn-primary stylish-btn', 'id' => 'submit-btn']); ?>
                    </div>
                    <div class="">
                        <a href="<?= Yii::$app->homeUrl; ?>" class="btn btn-secondary stylish-btn">Go Back</a>
                    </div>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<style>
    body {
        font-family: "Roboto", sans-serif;
    
    }
    .stylish-title {
        font-size: 36px;
        color: #2c3e50;
        margin-bottom: 30px;
        animation: fadeInDown 1s;
    }
    .animated-form {
        animation: fadeInUp 1s;
    }
    .stylish-input {
        border-radius: 8px;
        border: 1px solid #ccc;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    .stylish-input:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.6);
    }
    .stylish-btn {
        border-radius: 8px;
        padding: 10px 20px;
        transition: background-color 0.3s, transform 0.3s;
    }
    .stylish-btn:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
    document.getElementById('submit-btn').addEventListener('click', function() {
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
    });
</script>
