<?php

/** @var \yii\db\ActiveRecord $user */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="row">
    <?php if (Yii::$app->user->isGuest): ?>
        <h3>To place an order, please login </h3>
    <?php else: ?>
        <div class="col-lg-8">
            <?php $form = ActiveForm::begin([
                'id' => 'cart-checkout-form',
            ]);
            ?>
            <?= $form->field($user, 'contactFirstName')->label('First Name') ?>
            <?= $form->field($user, 'contactLastName')->label('Last Name') ?>
            <?= $form->field($user, 'phone')->label('Your Phone') ?>
            <?= $form->field($user, 'addressLine1')->label('Delivery address') ?>
            <?= $form->field($user, 'country')->label('Country') ?>
            <?= $form->field($user, 'city')->label('City') ?>
            <?= $form->field($user, 'state')->label('State') ?>
            <?= $form->field($user, 'postalCode')->label('Postal Code') ?>

            <div class="form-group">
                <?= Html::submitButton('Checkout', [
                    'class' => 'btn btn-primary'
                ]) ?>
            </div>

            <?php ActiveForm::end() ?>
        </div>
    <?php endif; ?>
</div>
