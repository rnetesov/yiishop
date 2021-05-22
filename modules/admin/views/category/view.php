<?php
/** @var \yii\db\ActiveRecord $model */

use yii\bootstrap\Html;
use yii\widgets\DetailView;

?>

<p>
    <?= Html::a('Update', ['update', 'title' => $model->productLine], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Delete', ['delete', 'title' => $model->productLine], [
        'class' => 'btn btn-danger delete',
        'data' => [
            'confirm' => 'Are you sure you want to delete ' . $model->productLine .' Category?',
        ]
    ]) ?>
</p>



<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'productLine',
        'textDescription',
        [
            'attribute' => 'status',
            'value' => function($model) {
                switch ($model->status) {
                    case 'enable' : $class = 'label-success'; break;
                    case 'disable': $class = 'label-danger'; break;
                    default : $class = 'label-default';
                }
                return '<span class="label '. $class .'">' . $model->status .'</span>';
            },
            'format' => 'raw'
        ]
    ]
]); ?>