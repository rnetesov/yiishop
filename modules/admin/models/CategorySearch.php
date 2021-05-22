<?php


namespace app\modules\admin\models;

use app\models\Category;
use yii\data\ActiveDataProvider;

class CategorySearch extends Category
{
    public function rules()
    {
        return [
            ['productLine', 'string', 'max' => 50],
            ['status', 'in', 'range' => array_keys(Category::getStatuses())]
        ];
    }

    public function search($params)
    {
        $query = Category::find();
        $dataProvider = new ActiveDataProvider([
            'pagination' => [
                'pageSize' => 10
            ],
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['status' => SORT_ASC]
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['status' => $this->status])
            ->andFilterWhere(['like', 'productLine', $this->productLine]);

        return $dataProvider;
    }
}
