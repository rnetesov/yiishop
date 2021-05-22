<?php

/** @var \yii\base\Model $model */

use app\models\Category;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

?>

<div class="col-lg-6">
    <?php $form = ActiveForm::begin(['id' => 'create-category-form']); ?>
    <?= $form->field($model, 'productName') ?>
    <?= $form->field($model, 'productLine')->dropDownList(ArrayHelper::map(Category::find()->all(), 'productLine', 'productLine')) ?>
    <?= $form->field($model, 'productVendor') ?>
    <?= $form->field($model, 'productDescription')->textarea(['rows' => 10]) ?>
    <?= $form->field($model, 'quantityInStock') ?>
    <?= $form->field($model, 'buyPrice') ?>
    <?= $form->field($model, 'MSRP') ?>
    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>
