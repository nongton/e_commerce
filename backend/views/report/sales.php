<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
//use yii\grid\GridView;
use common\models\Stock;
use common\models\User;
use kartik\grid\GridView;
use yii\grid\ActionColumn;
use common\models\Producttype;
use common\models\Order;
/* @var $this yii\web\View */
/* @var $searchModel common\models\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายงาน ยอดขายสินค้า';
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
            'attribute'=>'productType',
            'vAlign'=>'middle',
            'hAlign'=>'center',
            'width'=>'180px',
            'value'=>function($model, $key, $index, $column){
            $id = $model->productType;
            $User = Producttype::find()->where(['Id'=>$id])->one();
            $Name = $User->typeName;
            return $Name;
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Producttype::find()->orderBy('typeName')->asArray()->all(), 'Id', 'typeName'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'productType'],
            'format'=>'raw'
          ],


        [
            'attribute'=>'productName',
            'width'=>'150px',
            'hAlign'=>'center',
        ],
        [
            'attribute'=>'productDetail',
            'hAlign'=>'center',
            'pageSummary'=>'รวม',
            'pageSummaryOptions'=>['class'=>'text-right text-warning'],
        ],
        [
            'attribute'=>'productPrice',
        	'header'=>'ราคาขาย',
            'width'=>'150px',
            'hAlign'=>'right',
            'format'=>['decimal', 2],
           // 'pageSummaryFunc'=>GridView::F_AVG
        ],
        [
        		'header'=>'จำนวนที่ขายไป',
        		'vAlign'=>'middle',
        		'hAlign'=>'center',
        		'width'=>'180px',
        		'value'=>function($model, $key, $index, $column){
        		$id = $model->Id;
        		$count = Order::find()->where(['productId'=>$id])->count();
        		return $count;
        		},
        		'pageSummary'=>true,
        		'format'=>'raw'
      ],
        
            
        [
            'class'=>'kartik\grid\FormulaColumn',
            'header'=>'รวม',
            'value'=>function ($model, $key, $index, $widget) {
             $p = compact('model', 'key', 'index');
             return $widget->col(5, $p) * $widget->col(6, $p);
             },
             'mergeHeader'=>true,
             'width'=>'150px',
             'hAlign'=>'right',
             'format'=>['decimal', 2],
             'pageSummary'=>true
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
        'beforeHeader'=>[
            [
                'columns'=>[
                    ['content'=>'รายละเอียดสินค้า', 'options'=>['colspan'=>5, 'class'=>'text-center warning']],
                    ['content'=>'ราคาและจำนวนคงคลัง', 'options'=>['colspan'=>2, 'class'=>'text-center warning']],
                    ['content'=>'ยอดรวม', 'options'=>['colspan'=>1, 'class'=>'text-center warning']],
                ],
                'options'=>['class'=>'skip-export'] // remove this row from export
            ]
        ],
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
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> รายการสินค้า</h3>',
            'type'=>GridView::TYPE_PRIMARY,
            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset', ['index'], ['class' => 'btn btn-info']),
            'footer'=>false
        ],
        
    ]); ?>

</div>
