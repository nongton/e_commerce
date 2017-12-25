<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Stock;
use common\models\User;
/* @var $this yii\web\View */
/* @var $searchModel common\models\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stocks ';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
.grid-view td{ white-space: normal; }

</style>
<div class="stock-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Stock', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           'id',
            ['label'=>'product Detail',
                'format'=>'html',
                'value'=>function($model, $key, $index, $column){
                $id = $model->productId;
                $ProductName = Stock::getProductName($id);
                
                return $ProductName;
                },
                'contentOptions'=>['style'=>'min-width: 150px;'] 
                ],
            'productId',
            'quantity',
            'unitprice',
            'manufacturer',
             'poId',
             'creatBy',
             ['label'=>'creatBy',
                 'format'=>'html',
                 'value'=>function($model, $key, $index, $column){
                 $id = $model->creatBy;
                 $User = User::find()->where(['id'=>$id])->one();
                 $Name = $User->firstName.' '.$User->lastName;
                 return $Name;
                 },
                 'contentOptions'=>['style'=>'min-width: 100px;'] 
                 ],
             'creatTime',

             ['class' => 'yii\grid\ActionColumn', 'contentOptions'=>['style'=>'min-width: 70px;'] ],
        ],
    ]); ?>
</div>
