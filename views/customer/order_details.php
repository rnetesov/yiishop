<?php
/** @var \yii\db\ActiveRecord $orderDetails */
/** @var \yii\db\ActiveRecord $order */

use yii\helpers\Url; ?>

<table class="table table-hover">
    <tr>
        <th>Img</th>
        <th>Product Name</th>
        <th>Product Vendor</th>
        <th>Price</th>
        <th>Quantity Ordered</th>
        <th>Total Price</th>
    </tr>
    <?php foreach ($orderDetails as $detail): ?>
        <tr>
            <td class="text-center"><img src="https://dummyimage.com/80x80/ccc/fff" alt=""></td>
            <td><a href="<?= Url::to(['shop/product', 'code' => $detail->productCode]) ?>"><?= $detail->product->productName ?></a></td>
            <td><?= $detail->product->productVendor ?></td>
            <td>$<?= number_format($detail->product->MSRP, '2', ',', ' ') ?></td>
            <td class="text-center"><?= $detail->quantityOrdered ?></td>
            <th>$<?= number_format($detail->priceEach, '2', ',', ' ') ?></th>
        </tr>
    <?php endforeach; ?>
    <tr style="font-weight: bold; font-size: 1.2em">
        <td colspan="4"></td>
        <th class="text-right">Total</th>
        <td class="col-lg-2">$<?= number_format($order->totalPrice, '2', ',', ' ') ?></td>
    </tr>
</table>