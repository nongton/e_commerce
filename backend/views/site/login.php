<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
          <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <div class="checkbox icheck">
           			 <label>
                		<?= $form->field($model, 'rememberMe')->checkbox() ?>
                		  </label>
		          </div>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn  btn-primary btn-block btn-flat"', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
