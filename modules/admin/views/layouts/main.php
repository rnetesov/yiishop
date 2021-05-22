<?php

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\web\View;

/** @var string $content */
/** @var View $this */

AppAsset::register($this);

?>

<?php $this->beginPage() ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?php $this->registerCsrfMetaTags() ?>
        <?php $this->head() ?>
        <title><?= Html::encode($this->title) ?></title>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <?= $this->render('components/menu') ?>
    <div class="container" style="margin-top: 65px">
        <div class="row">
            <div class="col-lg-3">
                <?= $this->render('components/manage_menu') ?>
            </div>
            <div class="col-lg-9">
                <?= $this->render('components/alerts') ?>
                <?= $content ?>
            </div>
        </div>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>