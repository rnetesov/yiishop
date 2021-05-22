<?php


namespace app\controllers;

use app\models\Cart;
use app\models\Customer;
use app\models\OrderDetail;
use app\models\Order;
use app\models\Product;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CartController extends Controller
{
    public function actionIndex()
    {
        $products = Product::findAll((new Cart())->allProductCode());
        return $this->render('index', compact('products'));
    }

    public function actionCheckout()
    {
        /** @var Customer $user */
        $cart = new Cart();
        $user = \Yii::$app->user->identity;

        if ($cart->isEmpty()) throw new HttpException(500, 'Your basket is empty ');

        if (!\Yii::$app->user->isGuest) {
            $user->setScenario(Customer::SCENARIO_CHECKOUT);
            if ($this->request->isPost && $user->load($this->request->post())) {
                if ($user->validate()) {
                    $user->save();
                    $order = Order::create([
                        'customer_number' => $user->getId(),
                        'total_price' => $cart->totalPrice()
                    ]);
                    $this->saveOrderItems($cart->getCart(), $order->orderNumber);
                    $cart->clear();
                    $msg = 'Your order has been successfully saved. Our manager will serve your order soon';
                    \Yii::$app->session->setFlash('success', $msg);
                    return $this->redirect(Url::to(['shop/index']));
                }
            }
        }

        return $this->render('checkout', compact('user'));
    }

    public function actionAdd()
    {
        if ($this->request->isAjax) {
            $this->response->format = Response::FORMAT_JSON;
            $cart = new Cart();
            $code = $this->request->get('code');
            $qty = $this->request->get('qty');
            if ($cart->addProduct($code, $qty)) {
                return ['status' => 'ok'];
            }
        }
        throw new BadRequestHttpException();
    }

    public function actionUpdate()
    {
        if ($this->request->isAjax) {
            $this->response->format = Response::FORMAT_JSON;
            $cart = new Cart();
            $code = $this->request->get('code');
            $qty = $this->request->get('qty');
            if ($cart->updateProduct($code, $qty)) {
                return ['status' => 'ok',];
            }
        }
        throw new BadRequestHttpException();
    }

    public function actionTotalPriceItem()
    {
        if ($this->request->isAjax) {
            $this->response->format = Response::FORMAT_JSON;
            $cart = new Cart();
            $code = $this->request->get('code');
            $price = $cart->totalPriceItem($code);
            if ($price) {
                return [
                    'status' => 'ok',
                    'price' => number_format($price, '2', ',', '')
                ];
            }
        }
        throw new BadRequestHttpException();
    }

    public function actionDelete()
    {
        if ($this->request->isAjax) {
            $this->response->format = Response::FORMAT_JSON;
            $cart = new Cart();
            if ($cart->removeProduct($this->request->get('code'))) {
                return ['status' => 'ok'];
            }
            throw new NotFoundHttpException();
        }
        throw new BadRequestHttpException();
    }

    public function actionTotalPrice()
    {
        if ($this->request->isAjax) {
            $this->response->format = Response::FORMAT_JSON;
            $cart = new Cart();
            return [
                'status' => 'ok',
                'price' => number_format($cart->totalPrice(), '2', ',', ' ')
            ];
        }
        throw new BadRequestHttpException();
    }

    public function actionTotalQty()
    {
        if ($this->request->isAjax) {
            $this->response->format = Response::FORMAT_JSON;
            $cart = new Cart();
            return ['qty' => $cart->totalQty()];
        }
        throw new BadRequestHttpException();
    }

    public function actionClear()
    {
        if ($this->request->isAjax) {
            $this->response->format = Response::FORMAT_JSON;
            $cart = new Cart();
            $cart->clear();
        } else {
            throw new BadRequestHttpException();
        }
    }

    protected function saveOrderItems(array $cart, int $orderNumber)
    {
        foreach ($cart as $code => $item) {
            OrderDetail::create([
                'order_number' => $orderNumber,
                'product_code' => $code,
                'quantity_ordered' => $item['qty'],
                'price_each' => $item['price'] * $item['qty']
            ]);
        }
    }
}