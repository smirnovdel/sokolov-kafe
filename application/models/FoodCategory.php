<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "food_category".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $food_id
 *
 * @property Category $category
 * @property Food $food
 */
class FoodCategory extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'food_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'food_id'], 'required'],
            [['category_id', 'food_id'], 'integer'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['food_id'], 'exist', 'skipOnError' => true, 'targetClass' => Food::className(), 'targetAttribute' => ['food_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'food_id' => 'Food ID',
        ];
    }
    
    public function saveCategory($model)
    {
        $this->category_id = $model->category;
        $this->food_id = $model->id;
        $this->save();
        return true;
    }
    
    
    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFood()
    {
        return $this->hasOne(Food::className(), ['id' => 'food_id']);
    }
}
