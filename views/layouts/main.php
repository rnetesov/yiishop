<?php /** @var string $content */

/** @var \yii\web\View $this */

use app\assets\AppAsset;
use app\components\CategoryWidget;
use app\components\CustomerMenuWidget;
use yii\helpers\Html;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?= $this->render('components/modal/login') ?>

<?= $this->render('components/modal/register') ?>

<?= $this->render('components/menu') ?>

<div class="container">
    <div class="row" style="margin-top: 65px">

        <?= $this->render('components/alerts') ?>

        <?php if (!isset($this->params['exception'])): ?>
            <div class="col-lg-3">
                <?php if (!strcasecmp(Yii::$app->controller->id, 'customer')): ?>
                    <?= CustomerMenuWidget::widget() ?>
                <?php else: ?>
                    <?= CategoryWidget::widget() ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-9">
                <?= $content ?>
            </div>
        <?php else: ?>
            <?= $content ?>
        <?php endif; ?>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>