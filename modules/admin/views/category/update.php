<?php use app\models\Category;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/** @var \yii\base\Model $model */
?>

<div class="col-lg-6">
    <?php $form = ActiveForm::begin(['id' => 'create-category-form']); ?>
    <?= $form->field($model, 'productLine')->label('Title') ?>
    <?= $form->field($model, 'textDescription')->textarea(['rows' => 8])->label('Description') ?>
    <?= $form->field($model, 'status')->dropDownList(Category::getStatuses()) ?>
    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>
