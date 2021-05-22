<?php

use yii\debug\Module;

return [
    'id' => 'yiishop',
    'basePath' => realpath(__DIR__ . '/../'),
    'language' => 'en',
    'controllerNamespace' => 'app\controllers',
    'defaultRoute' => 'shop/index',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => 'main',
            'defaultRoute' => 'main/index',
        ],
        'debug' => [
            'class' => Module::class,
        ],
    ],
    'components' => [
        'user' => [
            'enableAutoLogin' => true,
            'identityClass' => 'app\models\Customer',
        ],
        'errorHandler' => [
            'errorAction' => 'shop/error'
        ],
        'request' => [
            'cookieValidationKey' => 'JQqS9FpkejpXcdSSKNZZCbnFQ8fE7V',
            'enableCsrfValidation' => true,
            'baseUrl' => ''
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'db' => require_once __DIR__ . '/db.php',
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    'bootstrap' => ['debug'],
];
