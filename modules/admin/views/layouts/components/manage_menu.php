<?php

use app\models\Category;
use app\models\Order;
use app\models\Product;
use yii\helpers\Url;

?>

<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" class="">Categories</a>
            </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse <?= (Yii::$app->controller->id == 'category') ? 'in' : '' ?>"
             aria-expanded="true" style="">
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="badge">
                        <?= Category::find()->count() ?>
                    </span>
                    <a href="<?= Url::to(['category/index']) ?>">All</a>
                </li>
                <li class="list-group-item">
                    <span class="badge">
                        <?= Category::find()->where(['status' => 'enable'])->count() ?>
                    </span><a
                            href="<?= Url::to(['category/index', 'CategorySearch[status]' => 'enable']) ?>">Enabled</a>
                </li>
                <li class="list-group-item">
                    <span class="badge">
                        <?= Category::find()->where(['status' => 'disable'])->count() ?>
                    </span>
                    <a href="<?= Url::to(['category/index', 'CategorySearch[status]' => 'disable']) ?>">Disabled</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="collapsed"
                   aria-expanded="false">Products</a>
            </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse <?= (Yii::$app->controller->id == 'product') ? 'in' : '' ?>"
             aria-expanded="false">
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="badge"><?= Product::find()->count() ?></span>
                    <a href="<?= Url::to(['product/index']) ?>">All</a>
                </li>
                <li class="list-group-item">
                    <span class="badge"><?= Product::find()->where(['status' => 'active'])->count() ?></span>
                    <a href="<?= Url::to(['product/index', 'ProductSearch[status]' => 'active']) ?>">Active</a>
                </li>
                <li class="list-group-item">
                    <span class="badge"><?= Product::find()->where(['status' => 'blocked'])->count() ?></span>
                    <a href="<?= Url::to(['product/index', 'ProductSearch[status]' => 'blocked']) ?>">Blocked</a>
                </li>
                <li class="list-group-item">
                    <span class="badge"><?= Product::find()->where(['status' => 'on main'])->count() ?></span>
                    <a href="<?= Url::to(['product/index', 'ProductSearch[status]' => 'on main']) ?>">On Main</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" class="collapsed"
                   aria-expanded="false">
                    Orders</a>
            </h4>
        </div>
        <div id="collapse3" class="panel-collapse collapse <?= (Yii::$app->controller->id == 'order') ? 'in' : '' ?>" aria-expanded="false">
            <ul class="list-group">
                <li class="list-group-item"><span class="badge"><?= Order::find()->count() ?></span>
                    <a href="<?= Url::to(['order/index']) ?>">All</a>
                </li>
                <li class="list-group-item">
                    <span class="badge"><?= Order::find()->where(['status' => 'new'])->count() ?></span>
                    <a href="<?= Url::to(['order/index', 'OrderSearch[status]' => 'new']) ?>">New</a>
                </li>
            </ul>
        </div>
    </div>
</div>