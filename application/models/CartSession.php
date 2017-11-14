<?php

namespace app\models;

use Yii;


class CartSession
{

    public static function getSession()
    {
        if (isset($_SESSION['cart'])) {
            return $_SESSION['cart'];
        } else {

            $_SESSION['cart'] = [
                'sum' => 0,
                'count' => 0,
            ];
            return $_SESSION['cart'];
        }
    }

    public static function addSession($price)
    {
        CartSession::getSession();

        $_SESSION['cart']['sum'] += $price;
        $_SESSION['cart']['count']++;
    }

    public static function deleteSession($price)
    {
        CartSession::getSession();

        $_SESSION['cart']['sum'] -= $price;
        $_SESSION['cart']['count']--;
    }

    public static function initSession()
    {

        $order = Yii::$app->user->getIdentity()->getCart()->one()->getCartFoods()->with('food');

        if ($order->one()) {

            $total = 0;
            $count = 0;
            foreach ($order->all() as $k => $v) {
                $sum = $v['count'] * $v['food']['price'];
                $total += $sum;
                $count += $v['count'];
            }


            $_SESSION['cart'] = [
                'sum' => $total,
                'count' => $count,
            ];
        } else {

            $_SESSION['cart'] = [
                'sum' => 0,
                'count' => 0,
            ];
        }

    }


}