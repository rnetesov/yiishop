<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Update Orders: ' . $model->orderNumber;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->orderNumber, 'url' => ['view', 'id' => $model->orderNumber]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="orders-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
