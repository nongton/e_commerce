<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $Id
 * @property string $productName
 * @property string $productPic
 * @property string $productDetail
 * @property string $productPrice
 * @property string $productQuantity
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productName', 'productPrice', 'productQuantity'], 'required'],
            [['productName', 'productPic', 'productDetail', 'productQuantity'], 'string', 'max' => 200],
            [['productPrice'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'productName' => 'Product Name',
            'productPic' => 'Product Pic',
            'productDetail' => 'Product Detail',
            'productPrice' => 'Product Price',
            'productQuantity' => 'Product Quantity',
        ];
    }
}
