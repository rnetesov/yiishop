<?php /** @var array $products */

use app\models\Cart;
use yii\helpers\Url;

$cart = (new Cart())->getCart();

?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"><b class="glyphicon glyphicon-shopping-cart"></b> Shoping cart</div>
            <div class="panel-body">
                <?php if (count($products) > 0): ?>
                    <table class="table table-bordered table-striped table-hover" id="shopping-cart">
                        <tr>
                            <th>Name</th>
                            <th>QTY</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach ($products as $product): ?>
                            <tr class="text-left">
                                <td>
                                    <h5><a href="<?= Url::to(['shop/product', 'code' => $product->productCode]) ?>">
                                        <?= $product->productName ?></a>
                                    </h5>
                                </td>
                                <td class="col-lg-1">
                                    <div class="form-group">
                                        <input type="text" class="form-control change-qty-cart-input" size="1"
                                               value="<?= $cart[$product->productCode]['qty'] ?>" data-product-code="<?= $product->productCode ?>">
                                    </div>
                                </td>
                                <td>$<?= number_format($product->MSRP, '2', ',', '') ?></td>
                                <td class="total-price">
                                    $<?= number_format($cart[$product->productCode]['qty'] * $product->MSRP, '2', ',', '') ?>
                                </td>
                                <td class="text-center col-lg-2" style="vertical-align: middle">
                                    <button class="btn btn-danger remove-from-cart-btn"
                                            data-product-code="<?= $product->productCode ?>">
                                        <span class="glyphicon glyphicon-remove"></span>
                                        Remove
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="3" class="text-right">
                                <a href="#" class="clear-shopping-cart-btn">Clear cart</a>
                            </td>
                            <td class="text-right">
                                Total
                            </td>
                            <th class="text-center total-price-item">
                                $<?= number_format((new Cart())->totalPrice(), '2', ',', ' ') ?>
                            </th>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <a href="<?= Url::to(['shop/index']) ?>" class="btn btn-info">Continue Shoping</a>
                            </td>
                            <td class="text-center">
                                <a href="<?= Url::to(['cart/checkout']) ?>" class="btn btn-warning">Checkout</a>
                            </td>
                        </tr>
                    </table>
                <?php else: ?>
                    <p>Cart is empty</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

