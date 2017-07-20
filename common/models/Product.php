<?php

namespace common\models;

use Yii;
use \yii\web\UploadedFile;

/**
 * This is the model class for table "product".
 *
 * @property integer $Id
 * @property string $productName
 * @photo string $photo
 * @property string $productDetail
 * @property string $productPrice
 * @property string $productQuantity
 * @property integer $productType
 */
class Product extends \yii\db\ActiveRecord
{
	public $upload_foler ='uploads';
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
        	[['photo'], 'file',
        				'skipOnEmpty' => true,
        				'extensions' => 'png,jpg'
        	],
            [['productName', 'productDetail', 'productQuantity','productType'], 'string', 'max' => 200],
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
    
    public function upload($model,$attribute)
    {
    	$photo  = UploadedFile::getInstance($model, $attribute);
    	$path = $this->getUploadPath();
    	if ($this->validate() && $photo !== null) {
    		
    		//$fileName = md5($photo->baseName.time()) . '.' . $photo->extension;
    		$fileName = $photo->baseName . '.' . $photo->extension;
    		
    		if($photo->saveAs($path.$fileName)){
    			return $fileName;
    		}
    	}
    	return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }
    
    public function getUploadPath(){
    	return Yii::getAlias('@webroot').'/'.$this->upload_foler.'/';
    }
    
    public function getUploadUrl(){
    	return Yii::getAlias('@web').'/'.$this->upload_foler.'/';
    }
    
    public function getPhotoViewer(){
    	return empty($this->photo) ? Yii::getAlias('@web').'/img/none.png' : $this->getUploadUrl().$this->photo;
    }
    
}
