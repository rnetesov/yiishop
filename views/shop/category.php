<?php

/** @var \yii\web\View $this */
$search = null;
$q = null;

echo $this->render('index', compact('products', 'pages', 'search', 'q'));