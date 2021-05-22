<?php

namespace app\modules\admin\models;

use app\models\Product;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ProductSearch extends Product
{

    public function rules()
    {
        return [
            [['productCode', 'productName', 'productLine', 'productVendor', 'status'], 'string'],
            [['buyPrice', 'MSRP'], 'double']
        ];
    }

    public function search($params)
    {
        $query = Product::find();
        $dataProvider = new ActiveDataProvider([
            'pagination' => [
                'pageSize' => 14,
            ],
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['status' => SORT_ASC]
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'productCode',$this->productCode])
            ->andFilterWhere(['like', 'productName', $this->productName])
            ->andFilterWhere(['like', 'productLine', $this->productLine])
            ->andFilterWhere(['like', 'productVendor', $this->productVendor])
            ->andFilterWhere(['status' => $this->status])
            ->andFilterWhere(['>=', 'buyPrice', $this->buyPrice])
            ->andFilterWhere(['>=', 'MSRP', $this->MSRP]);

        return $dataProvider;
    }
}