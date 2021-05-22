<?php


namespace app\controllers;

use Yii;
use yii\base\Action;
use yii\web\NotFoundHttpException;

class ErrorHandler extends Action
{
    public function run()
    {
        $exception = Yii::$app->errorHandler->exception;
        $this->controller->view->params['exception'] = $exception;

        if (!is_null($exception)) {
            $name = Yii::$app->errorHandler->getExceptionName($exception);
            $message = $exception->getMessage();
            return $this->controller->render('error', compact('exception', 'name', 'message'));
        }
        throw new NotFoundHttpException();
    }
}