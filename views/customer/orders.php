<?php /** @var array $orders */

use yii\helpers\Url; ?>
<?php if ($orders): ?>
    <table class="table table-bordered table-hover">
        <tr>
            <th>Number</th>
            <th>Status</th>
            <th>Date Shipped</th>
            <th>Total Price</th>
        </tr>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td class="col-lg-2 text-left">
                    <a href="<?= Url::to(['customer/order-details', 'id' => $order->orderNumber]) ?>">
                        Order <?= $order->orderNumber ?>
                    </a>
                    <br>
                    <span style="font-size: 0.8em; color: #3c3c3c"><?= (new DateTime($order->orderDate))->format('Y.m.d - H:i') ?></span>
                </td>
                <td>
                    <?= $order->status ?>
                </td>
                <td><?= $order->shippedDate ?? 'no' ?></td>
                <td>$<?= number_format($order->totalPrice, '2', ',', ' ') ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else:; ?>
    <p>Empty </p>
<?php endif; ?>