<?php

namespace app\models;

use Yii;
/**
 * This is the model class for table "food".
 *
 * @property integer $id
 * @property string $name
 * @property integer $weight
 * @property string $price
 * @property string $picture
 *
 * @property FoodCategory[] $foodCategories
 */
class Food extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'food';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'weight', 'price'], 'required'],
            [['weight'], 'integer'],
            [['price'], 'number'],
            [['name', 'picture'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'weight' => 'Weight',
            'price' => 'Price',
            'picture' => 'Picture',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFoodCategories()
    {
        return $this->hasMany(FoodCategory::className(), ['food_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return FoodQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FoodQuery(get_called_class());
    }
        
    public function getCategories() {
    return $this->hasMany(Category::className(), ['id' => 'category_id'])
      ->viaTable(FoodCategory::tableName(), ['food_id' => 'id']);
}



    public function getQuantity(){
         return 1;
    }
    public function setQuantity(){
         return 1;
    }
    
    public function getPrice()
    {
        return 0;
    }
    
    public function getId()
    {
        return $this->id;
    } 

}

