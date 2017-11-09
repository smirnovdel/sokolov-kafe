<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CartFood]].
 *
 * @see CartFood
 */
class CartFoodQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CartFood[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CartFood|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
