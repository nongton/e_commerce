<?php

namespace common\models;

use Yii;
use \yii\web\UploadedFile;

/**
 * This is the model class for table "product".
 *
 * @property integer $Id
 * @property string $productName
 * @property string $photo
 * @property string $productDetail
 * @property string $productPrice
 * @property string $productQuantity
 * @property integer $productType
 */
class Product extends \yii\db\ActiveRecord
{
	public $upload_foler ='upload';
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
            [['productName', 'productDetail', 'productQuantity','productType','photo'], 'string', 'max' => 200],
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
            'photo' => 'Product photo',
            'productDetail' => 'Product Detail',
            'productPrice' => 'Product Price',
            'productQuantity' => 'Product Quantity',
        	'productType' => 'Product Type'
        ];
    }

    
  
}
