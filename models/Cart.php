<?php

namespace app\models;

use yii\base\Model;

class Cart extends Model
{
    const CART_NAME = 'cart';

    public function addProduct(string $code, int $qty): bool
    {
        if ($qty <= 0) return false;
        if ($product = Product::findOne($code)) {
            $cart = $this->getCart();
            if (key_exists($code, $cart)) {
                $cart[$code]['qty'] += $qty;
            } else {
                $cart[$code]['qty'] = $qty;
                $cart[$code]['price'] = $product->MSRP;
            }
            $this->setCart($cart);
            return true;
        }
        return false;
    }

    public function updateProduct(string $code, int $qty): bool
    {
        $cart = $this->getCart();
        if ($qty <= 0) return false;

        if (array_key_exists($code, $cart)) {
            $cart[$code]['qty'] = $qty;
            $this->setCart($cart);
            return true;
        } else {
            if ($product = Product::findOne($code)) {
                $cart[$code]['qty'] = $qty;
                $cart[$code]['price'] = $product->MSRP;
                $this->setCart($cart);
                return true;
            }
        }
        return false;
    }

    public function removeProduct(string $code): bool
    {
        $cart = $this->getCart();
        if (empty($cart)) return false;

        if (key_exists($code, $cart)) {
            unset($cart[$code]);
            $this->setCart($cart);
            return true;
        }
        return false;
    }

    public function clear()
    {
        $this->setCart([]);
    }

    public function allProductCode(): array
    {
        if (\Yii::$app->session->has(Cart::CART_NAME)) {
            return array_keys($this->getCart());
        }
        return [];
    }

    public function inCart(string $code): bool
    {
        $cart = $this->getCart();
        if (empty($cart)) return false;
        return array_key_exists($code, $cart);
    }

    public function totalPrice(): float
    {
        $total = 0.0;
        $cart = $this->getCart();
        if (!empty($cart)) {
            array_walk($cart, function ($value) use (&$total) {
                $total += $value['qty'] * $value['price'];
            });
        }
        return $total;
    }

    public function totalPriceItem($code)
    {
        $cart = $this->getCart();
        if (empty($cart)) return 0;
        if (array_key_exists($code, $cart)) {
            return $cart[$code]['qty'] * $cart[$code]['price'];
        }
        return 0;
    }

    public function totalQty()
    {
        $qty = 0;
        $cart = $this->getCart();
        if (!empty($cart)) {
            array_walk($cart, function ($value) use (&$qty) {
                $qty += $value['qty'];
            });
        }
        return $qty;
    }

    public function isEmpty() : bool
    {
        return empty($this->getCart());
    }

    public function getCart()
    {
        $session = \Yii::$app->session;
        if ($session->has(Cart::CART_NAME)) {
            return $session->get(self::CART_NAME);
        }
        $session->set(self::CART_NAME, []);
        return [];
    }

    private function setCart(array $cart)
    {
        \Yii::$app->session->set(self::CART_NAME, $cart);
    }
}