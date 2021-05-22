<?php

/** @var \yii\db\ActiveRecord $user */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="row">
    <div class="col-lg-8">
        <?php $form = ActiveForm::begin([
            'id' => 'cart-checkout-form',
            'enableClientValidation' => false,
        ]);
        ?>

        <?= $form->field($user, 'email')->label('Email address') ?>
        <?= $form->field($user, 'login')->label('Login') ?>
        <?= $form->field($user, 'contactFirstName')->label('First Name') ?>
        <?= $form->field($user, 'contactLastName')->label('Last Name') ?>
        <?= $form->field($user, 'phone')->label('Your Phone') ?>
        <?= $form->field($user, 'addressLine1')->label('Delivery address') ?>
        <?= $form->field($user, 'country')->label('Country') ?>
        <?= $form->field($user, 'city')->label('City') ?>
        <?= $form->field($user, 'state')->label('State') ?>
        <?= $form->field($user, 'postalCode')->label('Postal Code') ?>
        <?= $form->field($user, 'oldPassword')->label('Old Password')->passwordInput() ?>
        <?= $form->field($user, 'newPassword')->label('New Password')->passwordInput() ?>
        <?= $form->field($user, 'repeatPassword')->label('Repeat Password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Update', [
                'class' => 'btn btn-primary'
            ]) ?>
        </div>

        <?php ActiveForm::end() ?>
    </div>
</div>
