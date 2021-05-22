<?php
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */

use yii\helpers\Url;

?>

<div class="jumbotron text-center">
    <h2><?= $name ?></h2>
    <h1><?= $exception->statusCode ?>!</h1>
    <p><?= $message ?></p>
    <p><a class="btn btn-primary btn-lg" href="<?= Url::to(['shop/index']) ?>" role="button">Go to Home</a></p>
</div>