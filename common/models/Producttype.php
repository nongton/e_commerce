<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "producttype".
 *
 * @property integer $Id
 * @property string $typeName
 * @property string $typeDescription
 */
class Producttype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'producttype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'typeName', 'typeDescription'], 'required'],
            [['Id'], 'integer'],
            [['typeName'], 'string', 'max' => 50],
            [['typeDescription'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'typeName' => 'Type Name',
            'typeDescription' => 'Type Description',
        ];
    }
}
