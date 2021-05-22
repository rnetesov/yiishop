<?php


namespace app\models;


use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Product extends ActiveRecord
{
    public static function getStatuses()
    {
        return [
            'active' => 'Active',
            'blocked' => 'Blocked',
            'on main' => 'Show on main'
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->createdAt = (new \DateTime())->format('Y-m-d H:i:s');
            }
            return true;
        }
        return false;
    }

    public static function tableName()
    {
        return '{{products}}';
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['productLine' => 'productLine']);
    }


    public function rules()
    {
        return [
            [['productName', 'productLine', 'productVendor', 'productDescription', 'quantityInStock', 'buyPrice', 'MSRP'], 'required'],
            [['productName', 'productVendor'], 'string', 'length' => [5, 255]],
            ['status', 'string'],
            ['productLine', 'in', 'range' => ArrayHelper::getColumn(Category::find()->all(), 'productLine')],
            ['quantityInStock', 'number'],
            [['buyPrice', 'MSRP'], 'double']
        ];
    }
}