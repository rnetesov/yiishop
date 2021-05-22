<?php

/** @var \yii\base\Model $model */

use yii\bootstrap\Html;
use yii\widgets\ActiveForm;

?>

<div class="col-lg-6">
    <?php $form = ActiveForm::begin(['id' => 'create-category-form']); ?>
    <?= $form->field($model, 'productLine')->label('Title') ?>
    <?= $form->field($model, 'textDescription')->textarea()->label('Description') ?>
    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>
