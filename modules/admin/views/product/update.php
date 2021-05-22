<?php use app\models\Category;
use app\models\Product;
use app\models\Vendor;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

/** @var \yii\db\ActiveRecord $model */

?>

<div class="col-lg-6">
    <?php $form = ActiveForm::begin(['id' => 'create-category-form']); ?>

    <?= $form->field($model, 'productName') ?>

    <?= $form->field($model, 'productLine')
        ->dropDownList(ArrayHelper::map(Category::find()->all(), 'productLine', 'productLine')) ?>

    <?= $form->field($model, 'productVendor')
        ->dropDownList(ArrayHelper::map(Vendor::find()->all(), 'productVendor', 'productVendor')) ?>

    <?= $form->field($model, 'productDescription') ?>

    <?= $form->field($model, 'quantityInStock') ?>

    <?= $form->field($model, 'buyPrice') ?>

    <?= $form->field($model, 'status')
        ->dropDownList(Product::getStatuses()) ?>

    <?= $form->field($model, 'MSRP') ?>
    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>
