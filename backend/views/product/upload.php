<?php

use yii\helpers\Url;
use yii\helpers\BaseUrl;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\web\View;
use common\models\User;
use kartik\file\FileInput;
use common\models\Product;

// With model & without ActiveForm
echo '<label class="control-label">Add Attachments</label>';
echo FileInput::widget([
		'model' =>$modelproduct,
		'attribute' => 'productPic',
		'options' => ['multiple' => true]
]);