<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

class MainController extends Controller
{
    public function actions()
    {
        return [
            'error' => ErrorHandler::className()
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}