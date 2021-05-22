<?php
/** @var \yii\data\ActiveDataProvider $dataProvider */
/** @var \yii\db\ActiveRecord $searchModel */
/** @var \yii\data\Sort $sort */

use app\models\Category;
use app\models\Vendor;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<p><?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?></p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        [
            'attribute' => 'productLine',
            'label' => 'Title'
        ],
        [
            'attribute' => 'status',
            'value' => function ($model) {
                switch ($model->status) {
                    case 'enable' :$class = 'label-success';break;
                    case 'disable' :$class = 'label-danger';break;
                    default :$class = 'label-default';
                }
                return '<span class="label ' . $class . '">' . Category::getStatuses()[$model->status] . '</span>';
            },
            'filter' => Html::activeDropDownList($searchModel, 'status',
                Category::getStatuses(), [
                    'class' => 'form-control',
                    'prompt' => ''
                ]
            ),
            'options' => [
                'class' => 'col-lg-1'
            ],
            'format' => 'raw'
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'contentOptions' => ['class' => 'col-lg-1'],
            'urlCreator' => function (string $action, $model) {
                return Url::to([$action, 'title' => $model->productLine]);
            }
        ],
    ]
]) ?>