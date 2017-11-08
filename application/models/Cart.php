<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\helpers\BaseJson;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $json_order
 * @property integer $count
 * @property integer $sum
 */

class Cart extends \yii\db\ActiveRecord
{
    /** @var CartSession */
   //public $inmemoryStorage;
    
    /*public function afterSave($insert,$changedAttributes) {
       parent::afterSave($insert, $changedAttributes);
     
       $this->inmemoryStorage->save();
        
    }*/
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
            [['id_user'], 'required'],
            [['id_user'], 'integer'],
            [['json_order'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
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
    
    /**
    * Принимает id блюда и json строку.
    * Разбирает строку, добавляет блюдо, возвращает json строку
    *
    * 
    */
 
    
        public function parser()
    {      
          $order = Cart::find()->where(['id_user'=> Yii::$app->user->id])->one();
          
          $count = json_decode($order->json_order, true)?json_decode($order->json_order, true):array();
          
          foreach ($count as $key => $value) {
              
              $masid[] = $key;
          }
          
          $mas = \app\models\Food::find()->where(['id' => $masid])->asArray()->all(); 
          
          foreach ($mas as $key => $value) {
              
              $mas[$key]['count'] = $count[$value['id']];
          }
          
        return $mas;
    }
    
           public function updateOrder($model,$order = false,$del = false)
    {     
          if(!$order) {$order = $this;
          $order->id_user = Yii::$app->user->id;
          }
            $obj = BaseJson::decode($order->json_order);
            is_array($obj) ?: $obj = array();

              if (array_key_exists($model->id, $obj)){

                  if ($del){

                      if($obj[$model->id]==1){

                         unset($obj[$model->id]);
                         $order->sum -= $model->price;
                         $order->count -= 1;

                      } else {
                      $obj[$model->id]--;
                      $order->sum -= $model->price;
                      $order->count -= 1;
                      }

                  } else {

                      $obj[$model->id] = $obj[$model->id] +1;
                      $order->sum += $model->price;
                         $order->count += 1;
                  }
              }
              else if(!$del) {
                  $obj[$model->id] = 1;
                  $order->sum += $model->price;
                  $order->count += 1;
              };

            $order->json_order = BaseJson::encode($obj);   
            
            
          return $order;
    }
    
               
    
    public function addFood($model,$del)
    {
        
        $order = $this::find()->where(['id_user'=> Yii::$app->user->id])->one();
        
        
           //обновление имеющейся записи в БД
            $order = $this::updateOrder($model,$order,$del);
            if(!$order->save()){
                print_r($order->getErrors());} else {
                    if ($order->sum == 0){$order->delete(); }
                    CartSession::addFoodSessionFromBd();
                }
      
        
    }
}