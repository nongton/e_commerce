<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
//use yii\grid\GridView;
use common\models\Stock;
use common\models\User;
use kartik\grid\GridView;
use yii\grid\ActionColumn;
use common\models\Producttype;
/* @var $this yii\web\View */
/* @var $searchModel common\models\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายงาน user';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
.grid-view td{ white-space: normal; }
.skip-export {
 border-bottom: #cacaca 1px solid;
}
</style>
<div class="stock-index">
    <?php 
    $gridColumns =[
        ['class' => 'kartik\grid\CheckboxColumn'],
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'attribute'=>'type',
            'vAlign'=>'middle',
            'hAlign'=>'center',
            'width'=>'180px',
            'value'=>function($model, $key, $index, $column){
            $id = $model->type;
            $type = isset(User::$arrPosition[$id])?User::$arrPosition[$id]:'ไม่ระบุ';
            return $type;
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>User::$arrPosition,
            'filterWidgetOptions'=>[
            		'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'type'],
            'format'=>'raw'
            		],


        [
            'attribute'=>'username',
            'width'=>'150px',
            'hAlign'=>'center',
        ],
        [
            'attribute'=>'firstName',
            'hAlign'=>'center',
            'pageSummaryOptions'=>['class'=>'text-right text-warning'],
        ],
      
      ]
      
    
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'autoXlFormat'=>true,
        
        'showPageSummary'=>true,
        'export'=>[
            'fontAwesome'=>true,
            'showConfirmAlert'=>false,
            'target'=>GridView::TARGET_BLANK
        ],
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
        'resizableColumns'=>true,
        'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
        'responsive'=>true,   

        'pjax'=>true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'hover' => true,
        //'floatHeader'=>true,
       // 'floatHeaderOptions'=>['scrollingTop'=>'50'],
        'toolbar' =>  [
            ['content'=>
                Html::a('PRINT', ['print'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>"001"])
            ],
            '{export}',
            '{toggleData}'
        ],
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i>user ทั้งหมด </h3>',
            'type'=>GridView::TYPE_PRIMARY,
            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset', ['index'], ['class' => 'btn btn-info']),
            'footer'=>false
        ],
        
    ]); ?>

</div>
