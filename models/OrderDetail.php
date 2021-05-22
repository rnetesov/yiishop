<?php


namespace app\models;


use yii\db\ActiveRecord;

class OrderDetail extends ActiveRecord
{
    public static function tableName()
    {
        return '{{orderdetails}}';
    }

    public static function create(array $data)
    {
        $orderDetail = new OrderDetail();
        $orderDetail->orderNumber = $data['order_number'];
        $orderDetail->productCode = $data['product_code'];
        $orderDetail->quantityOrdered = $data['quantity_ordered'];
        $orderDetail->priceEach = $data['price_each'];
        return $orderDetail->save();
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['productCode' => 'productCode']);
    }
}