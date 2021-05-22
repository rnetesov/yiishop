<?php

use yii\web\Application;

error_reporting(E_ALL);
ini_set('display_errors', 1);
set_time_limit(300);

//define('YII_ENABLE_ERROR_HANDLER', true);
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require_once __DIR__ .'/../vendor/autoload.php';
require_once __DIR__ .'/../vendor/yiisoft/yii2/Yii.php';

require_once __DIR__. '/../config/functions.php';

$config = require_once __DIR__ . '/../config/web.php';

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

(new Application($config))->run();