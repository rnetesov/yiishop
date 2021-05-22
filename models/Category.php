<?php

namespace app\models;

use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    public static function tableName()
    {
        return '{{productlines}}';
    }

    public static function getStatuses()
    {
        return [
            'enable' => 'Enabled',
            'disable' => 'Disabled'
        ];
    }

    public static function findCategoryByTitle($title, $enable = true)
    {
        $query = Category::find()->where(['productLine' => $title]);
        if ($enable) {
            $query->andWhere(['status' => 'enable']);
        }
        return $query->one();
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['productLine' => 'productLine'])
            ->where(['status' => ['active', 'on main']]);
    }

    public function rules()
    {
        return [
            [['productLine', 'textDescription'], 'safe'],
            ['productLine', 'required'],
            ['productLine', 'string', 'length' => [2, 50]],
            ['productLine', 'unique'],
            ['status', 'in', 'range' => array_keys(self::getStatuses())],
            ['textDescription', 'string', 'length' => [0, 4000]]
        ];
    }
}