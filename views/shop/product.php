<?php /** @var \app\models\Product $product */

use app\models\Cart;
use yii\helpers\Url;
?>

<div class="panel panel-default" style="width: 100%">
    <div class="panel-heading">
        <h3 class="panel-title"><?= $product->productName ?></h3>
    </div>
    <div class="panel-body">
        <div class="row" id="row-products">
            <div class="col-lg-4">
                <img src="https://dummyimage.com/460" alt="" class="img-thumbnail">
            </div>
            <div class="col-lg-8">
                <table class="table" id="product-card">
                    <tr>
                        <th>Code</th>
                        <td><?= $product->productCode ?></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td><?= $product->productName ?></td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td><?= $product->category->productLine ?></td>
                    </tr>
                    <tr>
                        <th>Vendor</th>
                        <td><?= $product->productVendor ?></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><?= $product->productDescription ?></td>
                    </tr>
                    <tr>
                        <th>In Stock</th>
                        <td><?= $product->quantityInStock ?></td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>$<?= number_format($product->MSRP, '2', ',', '') ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?php if ((new Cart())->inCart($product->productCode)): ?>
                                <a href="<?= Url::to(['cart/index']) ?>" class="btn btn-warning">In Cart</a>
                            <?php else: ?>
                                <a href="<?= Url::to(['cart/add', 'code' => $product->productCode]) ?>"
                                      class="btn btn-primary add-to-cart-btn">Buy</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>