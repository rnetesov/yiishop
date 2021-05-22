<?php


namespace app\models;


use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    public static function getStatuses()
    {
        return [
            'new' => 'New',
            'on hold' => 'On Hold',
            'in process' => 'In Process',
            'cancelled' => 'Cancelled',
            'shipped' => 'Shipped'
        ];
    }
    public static function tableName()
    {
        return '{{orders}}';
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['customerNumber' => 'customerNumber']);
    }

    public static function create(array $data)
    {
        $order = new Order();
        $order->orderDate = date('Y-m-d H:i:s', time());
        $order->status = $data['status'] ?? 'new';
        $order->customerNumber = $data['customer_number'];
        $order->totalPrice = $data['total_price'] ?? null;
        $order->shippedDate = $data['shipped_date'] ?? null;
        $order->comments = $data['comments'] ?? null;
        $order->save();
        return $order;
    }
}