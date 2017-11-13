<?php

namespace app\models;
use Yii;

$session = Yii::$app->session;


class CartSession 
{
 
      public static function getSession()
    {
        $order = Yii::$app->user->getIdentity()->getCart()->one()->getCartFoods()->with('food');


        if($order->one()){

            foreach ($order->all() as $k=>$v){
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