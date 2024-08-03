<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/** @var yii\web\View $this */

$this->title = 'Product-Catalog-Management';
?>
<div class="site-index" >
    <h2 class="text-center py-3">CREATE PRODUCT</h2>

    <div class="body-content">  
        <?php $form = ActiveForm::begin(['options' => ['class' => 'mx-auto', 'style' => 'max-width: 600px;']]); ?>
        
        <?= $form->field($post, 'name')->textInput(['class' => 'form-control mb-3']); ?>

        <?= $form->field($post, 'brand')->textInput(['class' => 'form-control mb-3']); ?>

        <?= $form->field($post, 'category')->textInput(['class' => 'form-control mb-3']); ?>

        <?= $form->field($post, 'manu_date')->widget(DatePicker::classname(), [
            'dateFormat' => 'dd-mm-yyyy',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'dd-mm-yyyy',
            ],
            'options' => [
                'class' => 'form-control mb-3',
                'placeholder' => 'Select manufacturing date ...'
            ]
        ]); ?>

        <?= $form->field($post, 'exp_date')->widget(DatePicker::classname(), [
            'dateFormat' => 'dd-mm-yyyy',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'dd-mm-yyyy',
            ],
            'options' => [
                'class' => 'form-control mb-3',
                'placeholder' => 'Select expiry date ...'
            ]
        ]); ?>

        <div class="form-group text-center">
            <?= Html::submitButton('Add Product', ['class' => 'btn btn-primary mr-3']); ?>
            <a href="<?= Yii::$app->homeUrl; ?>" class="btn btn-secondary">Go Back</a>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<style>
    body{
        background-color: aliceblue;
    }
    .site-index h1 {
        font-weight: bold;
        color: #343a40;
    }
    .site-index .form-control {
        border-radius: 0.25rem;
    }
    .site-index .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .site-index .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
</style>
