<?php
namespace app\models;
use Yii;

use dektrium\user\models\User as BaseUser;

class User extends BaseUser
{
    /** @inheritdoc */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user = static::findOne(['access_token' => $token]);
        if (!$user->isBlocked && $user->isConfirmed) {
            return $user;
        }
        return null;
    }


    public function getCart()
    {
        /*$model = $this->hasOne(Cart::className(), ['user_id' => 'id']);

        if ($model->user_id !== null) {
            return $model;
        } else {
            $cart = new Cart();
            $cart->user_id = Yii::$app->user->id;
            if($cart->save()){

               $this->getCart();
            }

        }*/

        return $this->hasOne(Cart::className(), ['user_id' => 'id']);
    }

    public function afterLogin()
    {

        CartSession::getSession();

    }


}