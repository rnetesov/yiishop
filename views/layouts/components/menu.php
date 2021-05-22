<?php

use app\models\Cart;
use yii\helpers\Url;

?>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= Url::to(['shop/index']) ?>">YII SHOP</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="<?= Url::to(['shop/index']) ?>">Home</span></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if (Yii::$app->user->isGuest): ?>
                    <li>
                        <a href="#" id="login-in-link"><b class="glyphicon glyphicon-user"></b> Login In</a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="#" id="dropdownMenu1" data-toggle="dropdown" >
                            <b class="glyphicon glyphicon-list"></b>
                            &nbsp;
                            <?php if (Yii::$app->user->identity->contactFirstName): ?>
                                <?= Yii::$app->user->identity->contactFirstName; ?>
                            <?php else: ?>
                                <?= ucfirst(Yii::$app->user->identity->login); ?>
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= Url::to(['customer/orders']) ?>"><b class="glyphicon glyphicon-list-alt"></b> My Orders</a></li>
                            <li><a href="<?= Url::to(['customer/profile']) ?>"><b class="glyphicon glyphicon-cog"></b> Profile</a></li>
                            <li><a href="<?= Url::to(['customer/logout']) ?>"><b class="glyphicon glyphicon-off"></b> Logout</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
                <li>
                    <a id="cart-indicate" href="<?= Url::to(['cart/index']) ?>" style="font-size: 1.2em">
                        <span id="cart-total-items" class="badge"><?= (new Cart())->totalQty() ?></span>
                        <b class="glyphicon glyphicon-shopping-cart"></b>
                        <span class="total-price">
                            <?= number_format((new Cart())->totalPrice(), 2, ',', ' ') ?>
                        </span>
                    </a>
                </li>
            </ul>
            <form method="get" class="navbar-form navbar-right" role="search" action="<?= Url::to(['/']) ?>">
                <div class="form-group">
                    <input type="hidden" name="search" value="">
                    <input type="text" class="form-control" placeholder="Search" size="30" name="q">
                </div>
                <button type="submit" class="btn btn-default"><b class="glyphicon glyphicon-search"></b></button>
            </form>
        </div>
    </div>
</nav>