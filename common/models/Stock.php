<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property integer $id
 * @property integer $productId
 * @property integer $quantity
 * @property string $unitprice
 * @property string $manufacturer
 * @property integer $poId
 * @property integer $creatBy
 * @property string $creatTime
 */
class Stock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productId', 'quantity', 'poId', 'creatBy'], 'integer'],
            [['creatTime'], 'safe'],
            [['unitprice', 'manufacturer'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Stock ID',
            'productId' => 'productId',
            'quantity' => 'quantity',
            'unitprice' => 'unitprice',
            'manufacturer' => 'manufacturer',
            'poId' => 'Po',
            'creatBy' => 'Creat By UserId',
            'creatTime' => 'Creat Time',
        ];
    }
    
    public function getProductName($id){
        $objProduct = Product::find()->where(['id' => $id])->one();
        return 'รหัส:'.$objProduct->Id.':'.$objProduct->productName;
    }
}
