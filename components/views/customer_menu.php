<?php

use yii\helpers\Url;

?>

<ul class="list-group">
    <li class="list-group-item">
        <b class="glyphicon glyphicon-list-alt"></b>
        <a href="<?= Url::to(['customer/orders']) ?>"> My Orders</a>
        <span class="label label-info"><?= Yii::$app->user->identity->getOrders()->count() ?></span>
    </li>
    <li class="list-group-item">
        <b class="glyphicon glyphicon-cog"></b>
        <a href="<?= Url::to(['customer/profile']) ?>">Profile</a>
    </li>
    <li class="list-group-item">
        <b class="glyphicon glyphicon-off"></b>
        <a href="<?= Url::to(['customer/logout']) ?>"> Log Out</a>
    </li>
</ul>