<?php


namespace app\controllers;

use app\models\Customer;
use app\models\Product;
use yii\web\Controller;
use yii\web\HttpException;

class ServiceController extends Controller
{
    public function actionResetPassword()
    {

        $user = Customer::findOne(['login' => $this->request->get('login')]);

        if ($user) {
            $user->oldPassword = $this->request->get('pswd') ?? '1234';
            if ($user->save(false)) {
                return 'Password was changed successfully';
            }
        }

        throw new HttpException(500, 'Error!');
    }

    public function actionUpdateProductStatus()
    {
        $products = Product::find()->groupBy(['productLine'])->all();

        foreach ($products as $product) {
            $product->status = 'on main';
            $product->save();
        }
    }
}