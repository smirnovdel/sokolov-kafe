<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Foodss]].
 *
 * @see Foodss
 */
class FoodQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Foodss[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Foodss|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
