<?php /** @var \yii\db\ActiveRecord $model */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView; ?>

<p>
    <?= Html::a('Update', ['update', 'code' => $model->productCode], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Delete', ['delete', 'code' => $model->productCode], [
        'class' => 'btn btn-danger delete',
        'data' => [
            'confirm' => 'Are you sure you want to delete this product?',
        ]
    ]) ?>
</p>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'productCode',
        'productName',
        'productLine',
        'productVendor',
        'productDescription',
        'quantityInStock',
        'buyPrice',
        [
            'attribute' => 'status',
            'value' => function ($model) {
                switch ($model->status) {
                    case 'active' : $class = 'label-success';break;
                    case 'blocked': $class = 'label-danger';break;
                    case 'on main': $class = 'label-primary';break;
                    default : $class = '';
                }
                return '<span class="label '. $class . '">' . $model->status . '</span>';
            },
            'format' => 'raw'
        ],
        'MSRP'
    ]
]) ?>
