<?php


namespace app\models;


use yii\db\ActiveRecord;

class Vendor extends ActiveRecord
{
    public static function tableName()
    {
        return '{{vendors}}';
    }
}