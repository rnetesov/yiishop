<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'orderNumber') ?>

    <?= $form->field($model, 'orderDate') ?>

    <?= $form->field($model, 'shippedDate') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'comments') ?>

    <?php // echo $form->field($model, 'totalPrice') ?>

    <?php // echo $form->field($model, 'customerNumber') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
