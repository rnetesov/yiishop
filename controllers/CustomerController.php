<?php


namespace app\controllers;


use app\models\Customer;
use app\models\OrderDetail;
use yii\db\ActiveRecord;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CustomerController extends Controller
{
    public function actionLogin()
    {
        if ($this->request->isPost && $this->request->isAjax) {
            \Yii::$app->request->enableCsrfCookie = false;
            $this->response->format = Response::FORMAT_JSON;
            $email = $this->request->post('email');
            $password = $this->request->post('password');
            $remember = $this->request->post('remember');
            $customer = Customer::findCustomerByEmail($email);

            if ($customer) {
                if (\Yii::$app->getSecurity()->validatePassword($password, $customer->hash)) {
                    if (\Yii::$app->user->login($customer, $remember ? 3600 * 24 : 0)) {
                        return 'success';
                    }
                }
            }
            return 'error';
        }

        throw new MethodNotAllowedHttpException();
    }

    public function actionSignUp()
    {
        if ($this->request->isAjax && $this->request->isPost) {
            $this->response->format = Response::FORMAT_JSON;
            $model = new Customer(['scenario' => Customer::SCENARIO_REGISTER]);
            if ($model->load($this->request->post(), '')) {
                if ($model->validate()) {
                    $model->save();
                    return [
                        'status' => 'success'
                    ];
                }
                return [
                    'status' => 'error',
                    'errors' => $model->errors
                ];
            } else {
                throw new BadRequestHttpException('Error loading data');
            }
        }
        throw new MethodNotAllowedHttpException();
    }

    public function actionProfile()
    {
        /** @var ActiveRecord $user */
        if (\Yii::$app->user->isGuest)
            throw new ForbiddenHttpException('Unauthorized users are denied access');

        $user = \Yii::$app->user->identity;
        $user->setScenario(Customer::SCENARIO_PROFILE);

        if ($this->request->isPost && $user->load($this->request->post())) {
            if ($user->validate() && $user->save()) {
                \Yii::$app->session->setFlash('success', 'Your profile was success updated');
                return $this->redirect($this->request->getUrl());
            }
        }

        return $this->render('profile', compact('user'));
    }

    public function actionOrders()
    {
        if (\Yii::$app->user->isGuest)
            throw new ForbiddenHttpException('Unauthorized users are denied access');

        $orders = \Yii::$app->user->identity->getOrders()->orderBy('orderDate DESC')->all();
        return $this->render('orders', compact('orders'));
    }

    public function actionOrderDetails()
    {
        if (\Yii::$app->user->isGuest)
            throw new ForbiddenHttpException('Unauthorized users are denied access');

        /** @var Customer $user */
        $user = \Yii::$app->user->identity;
        $orderId = (int)$this->request->get('id');
        $order = $user->getOrders()->where(['orderNumber' => $orderId])->one();

        if (!$order) throw new NotFoundHttpException('Order not found');
        $orderDetails = OrderDetail::findAll(['orderNumber' => $order->orderNumber]);
        return $this->render('order_details', compact('orderDetails', 'order'));
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout(false);
        return $this->goHome();
    }
}