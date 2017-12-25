<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Stock */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="stock-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'productId')->dropDownList(
								$listproduct, 
								['prompt'=>'Select...']); ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'unitprice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manufacturer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'poId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
