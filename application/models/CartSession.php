<?php

namespace app\models;
use Yii;

$session = Yii::$app->session;


class CartSession 
{
 
      public static function getSession()
    {        
             
             $_SESSION['login_id'] = Yii::$app->user->isGuest ? 'guest' : Yii::$app->user->id;
             
             if($_SESSION['login_id'] == Yii::$app->user->id){
                 
                 $order = Cart::find()->where(['id_user'=> Yii::$app->user->id])->one();
                    if($order){
                        
                        $_SESSION['curt'] = [
                            'sum' => $order->sum,
                            'count' => $order->count,
                            'json' => $order->json_order,
                        ]; 
                    } else {
                        
                       $_SESSION['curt'] = [
                            'sum' => 0,
                            'count' => 0,
                            'json' => '',
                        ];  
                    }
                 
             } else{
               
                 $_SESSION['curt'] = [
                            'sum' => 0,
                            'count' => 0,
                            'json' => '',
                        ];  
             }
             
    }    
    
    public static function addFoodSessionFromBd()
    {
        $order = Cart::find()->where(['id_user'=> Yii::$app->user->id])->one();
            $_SESSION['curt'] = [
                'sum' =>$order->sum,
                'count' =>$order->count,
                'json' =>$order->json_order,
                ];
    }
    
    
} 