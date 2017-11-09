<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cart_food".
 *
 * @property integer $id
 * @property integer $cart_id
 * @property integer $food_id
 * @property integer $count
 *
 * @property Food $food
 * @property Cart $cart
 */
class CartFood extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart_food';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'id_cart', 'id_food', 'count'], 'integer'],
            [['food_id'], 'exist', 'skipOnError' => true, 'targetClass' => Food::className(), 'targetAttribute' => ['food_id' => 'id']],
            [['cart_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cart::className(), 'targetAttribute' => ['cart_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cart_id' => 'Cart Id',
            'food_id' => 'Food Id',
            'count' => 'Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFood()
    {
        return $this->hasOne(Food::className(), ['id' => 'food_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCart()
    {
        return $this->hasOne(Cart::className(), ['id' => 'cart_id']);
    }

    /**
     * @inheritdoc
     * @return CartFoodQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CartFoodQuery(get_called_class());
    }
}
