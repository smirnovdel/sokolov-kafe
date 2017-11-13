<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\helpers\BaseJson;
use app\models\CartFood;
use app\models\CartSession;
use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property integer $id
 * @property integer $user_id
 *
 * @property CartFood[] $cartFoods
 */

class Cart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'user_id' => 'User Id',
            'json_order' => 'Json Order',
        ];
    }

    /**
     * @inheritdoc
     * @return CartQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CartQuery(get_called_class());
    }



    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        CartSession::getSession();

    }

    public function addFood($model,$del)
    {
        $cart = $this::find()->where(['user_id'=> Yii::$app->user->id])->one();

        if(!$cart){$cart = new Cart;}

            $cart->user_id = Yii::$app->user->id;

            if($cart->save()){

                $cart_food = CartFood::find()->where(['cart_id'=>$cart->id,'food_id'=>$model->id])->one();

                if(!$del){

                    if(!$cart_food){

                        $cart_food = new \app\models\CartFood;
                        $cart_food->count = 1;

                    } else {

                        $cart_food->count = $cart_food->count + 1;
                    }

                    $cart_food->cart_id = $cart->id;
                    $cart_food->food_id = $model->id;

                    if($cart_food->save()){

                    } else{
                       print_r($cart_food->getErrors());};

                } else {

                    if($cart_food){

                        if($cart_food->count == 1){
                            $cart_food->delete();
                            CartSession::getSession();
                        } else {
                            $cart_food->count = $cart_food->count -1;
                            $cart_food->save();
                        }
                    }
                }
            }

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCartFoods()
    {



        return $this->hasMany(CartFood::className(), ['cart_id' => 'id']);


    }

    public function getUser()
    {

        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}