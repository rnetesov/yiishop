<?php
/** @var array $products */
/** @var \yii\data\Pagination $pages */
/** @var string $search */
/** @var string $q */

use app\models\Cart;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Yii Shop';

?>

<?php if (!is_null($search)): ?>
    <div class="row">
        <div class="col-lg-12">
            <h3>Search Result "<?= Html::encode($q) ?>"</h3>
        </div>
    </div>
<?php endif; ?>

<div class="row row-flex" id="row-products">
    <?php if (count($products) > 0): ?>
        <?php foreach ($products as $product): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 product-item">
                <div class="thumbnail">
                    <img src="https://dummyimage.com/300" alt="" class="img-thumbnail">
                    <div class="caption text-center">
                        <h4>
                            <a href="<?= Url::to(['shop/product', 'code' => $product->productCode]) ?>"><?= $product->productName ?></a>
                        </h4>
                        <h3 class="text-info">$<?= number_format($product->MSRP, '2', ',', '') ?></h3>
                        <p><?= $product->productVendor ?></p>
                    </div>
                    <div class="product-panel text-center">
                        <p>
                            <?php if ((new Cart())->inCart($product->productCode)): ?>
                                <a href="<?= Url::to(['cart/index']) ?>"
                                   class="glyphicon glyphicon-ok" style="color: #e38d13; border-color: #e38d13">
                                </a>
                            <?php else: ?>
                                <a href="<?= Url::to(['cart/add', 'code' => $product->productCode]) ?>"
                                   class="glyphicon glyphicon-shopping-cart add-to-cart-btn">
                                </a>
                            <?php endif; ?>
                            <a href="#"
                               class="glyphicon glyphicon-heart"></a>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="col-lg-12 text-center">
            <?php echo LinkPager::widget([
                'pagination' => $pages,
                'maxButtonCount' => 5
            ]) ?>
        </div>
    <?php else: ?>
        <div class="col-lg-12"><p>Empty</p></div>
    <?php endif; ?>
</div>

