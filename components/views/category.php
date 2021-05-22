<?php /** @var array $categories */

use yii\helpers\Url;

?>

<ul class="list-group" id="main-category-list">
    <?php foreach ($categories as $category): ?>
        <?php $href = Url::to(['shop/category', 'name' => str_replace(' ', '-', $category->productLine)]) ?>
        <?php $active = (!strcasecmp(Url::current(), $href)) ? 'active' : '' ?>
        <li class="list-group-item <?= $active ?>">
            <a href="<?= $href ?>">
                <?= $category->productLine ?>
            </a>
            <span class="badge"><?= count($category->products) ?></span>
        </li>
    <?php endforeach; ?>
</ul>