<?php

/** @var \yii\data\ActiveDataProvider $dataProvider */
/** @var \yii\base\Model $searchModel */

use app\models\Category;
use app\models\Product;
use app\models\Vendor;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<p><?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?></p>

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'productCode',
        'productName',
        [
            'attribute' => 'productVendor',
            'filter' => Html::activeDropDownList($searchModel, 'productVendor',
                ArrayHelper::map(Vendor::find()->all(), 'productVendor', 'productVendor'), [
                    'class' => 'form-control',
                    'prompt' => ''
                ]
            ),
            'options' => [
                'class' => 'col-lg-2'
            ]
        ],
        [
            'attribute' => 'productLine',
            'filter' => Html::activeDropDownList($searchModel, 'productLine',
                ArrayHelper::map(Category::find()->all(), 'productLine', 'productLine'), [
                    'class' => 'form-control',
                    'prompt' => ''
                ]),
            'options' => [
                'class' => 'col-lg-2'
            ]
        ],
        [
            'attribute' => 'status',
            'value' => function ($model) {
                switch ($model->status) {
                    case 'active' : $class = 'label-success';break;
                    case 'blocked': $class = 'label-danger';break;
                    case 'on main': $class = 'label-primary';break;
                    default : $class = 'label-default';
                }
                return '<span class="label '. $class .'">' . $model->status .'</span>';
            },
            'filter' => Html::activeDropDownList($searchModel, 'status', Product::getStatuses(), [
                'class' => 'form-control',
                'prompt' => ''
            ]),
            'options' => [
                'class' => 'col-lg-2'
            ],
            'format' => 'raw'
        ],
        'buyPrice',
        'MSRP',
        'quantityInStock',
        [
            'class' => 'yii\grid\ActionColumn',
            'options' => ['class' => 'col-lg-1'],
            'urlCreator' => function (string $action, $model) {
                return Url::to([$action, 'code' => $model->productCode]);
            }
        ],
    ]
]);

?>