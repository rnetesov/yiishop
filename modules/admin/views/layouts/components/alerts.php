<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success">
        <p><?= Yii::$app->session->getFlash('success') ?></p>
    </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger">
        <p><?= Yii::$app->session->getFlash('error') ?></p>
    </div>
<?php endif; ?>