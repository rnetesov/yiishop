<?php

use app\models\Order;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Orders', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'orderNumber',
                'options' => [
                    'class' => 'col-lg-1'
                ]
            ],
            [
                'attribute' => 'orderDate',
                'filter' => DateTimePicker::widget([
                    'model' => $searchModel,
                    'attribute'=>'orderDate',
                    'language' => 'en',
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd hh:ii:ss',
                        'todayHighlight' => true
                    ]
                ])
            ],
            [
                'attribute' => 'status',
                'value' => function($model) {
                    switch ($model->status) {
                        case 'new' : $class = 'label-success'; break;
                        case 'on hold': $class = 'label-default'; break;
                        case 'in process': $class = 'label-info'; break;
                        case 'cancelled': $class = 'label-danger'; break;
                        case 'shipped': $class = 'label-default'; break;
                        default :$class = 'label-default';
                    }
                    return '<span class="label ' . $class . '">' . Order::getStatuses()[$model->status] . '</span>';
                },
                'filter' => Html::activeDropDownList($searchModel, 'status',
                    Order::getStatuses(), [
                        'class' => 'form-control',
                        'prompt' => ''
                    ]
                ),
                'format' => 'raw',
            ],
            'totalPrice',
            [
                'attribute' => 'login',
                'label' => 'Customer',
                'value' => 'customer.login',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
