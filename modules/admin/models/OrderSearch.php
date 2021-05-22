<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * OrderSearch represents the model behind the search form of `app\models\Orders`.
 */
class OrderSearch extends Order
{
    public $login;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['orderNumber', 'integer'],
            [['orderDate', 'status'], 'safe'],
            [['totalPrice'], 'number'],
            ['login', 'string'],
            ['orderDate', 'datetime', 'format' => 'php:Y-m-d H:i:s']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Order::find()->joinWith('customer');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'orderNumber',
                    'orderDate',
                    'status',
                    'totalPrice',
                    'login'
                ],
                'defaultOrder' => ['status' => SORT_ASC],
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['orderNumber' => $this->orderNumber]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'customers.login', $this->login])
            ->andFilterWhere(['>=', 'totalPrice', $this->totalPrice])
            ->andFilterWhere(['>=', 'orderDate', $this->orderDate]);

        return $dataProvider;
    }
}
