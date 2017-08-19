<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $Id
 * @property string $delivery
 * @property string $address
 * @property string $district
 * @property integer $provinceId
 * @property string $quantity
 * @property string $price
 * @property string $status
 * @property string $createBy
 * @property string $createTime
 * @property string $oderNum
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    const STATUS_DELETED = 0;
    const STATUS_CART = 1;
    const STATUS_CHECKOUT = 2;
    const STATUS_PENDING = 3;
    const STATUS_COMPLETE = 4;

    
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quantity','status'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'delivery' => 'Delivery',
            'address' => 'Address',
            'district' => 'District',
            'provinceId' => 'Province ID',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'status' => 'Status',
            'createBy' => 'createBy',
            'createTime' => 'createTime',
            'oderNum' => 'oderNum',
        ];
    }
    
    public static $arrOrderStatus = array(
        self::STATUS_DELETED=>"สินค้าโดนลบ",
        self::STATUS_CART=>"สินค้าอยู่ในตะกร้า",
        self::STATUS_CHECKOUT=>"สินค้ากำลังอยู่ในขั้นตอนสั่งซื้อ",
        self::STATUS_PENDING=>"สินค้ากำลังจัดส่ง",
        self::STATUS_COMPLETE=>"จัดส่งถึงผู้รับเรียบร้อย",
    );
    
    public static $arrOrderStatusLabel = array(
    		self::STATUS_DELETED=>"label-danger",
    		self::STATUS_CART=>"label-warning",
    		self::STATUS_CHECKOUT=>"label-warning",
    		self::STATUS_PENDING=>"label-primary",
    		self::STATUS_COMPLETE=>"label-success",
    );
    
}
