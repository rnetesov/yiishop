<?php

namespace app\assets;


use yii\web\AssetBundle;
use yii\web\View;


class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css'
    ];

    public $js = [
        'js/app.js'
    ];

    public $jsOptions = [
        'position' => View::POS_HEAD
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public function init()
    {
        if (\Yii::$app->controller->module->id === 'admin') {
            $this->css = [
                'css/admin-panel.css'
            ];
            $this->js = [
                'js/admin.js'
            ];
        }
    }
}