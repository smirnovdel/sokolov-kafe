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
        public function updateOrder($id,$jsonSt,$del)
    {       
          $obj = BaseJson::decode($jsonSt);
          
          is_array($obj) ?: $obj = array();
          
            if (array_key_exists($id, $obj)){
                
                if ($del){
                    
                    if($obj[$id]==1){
                        
                       unset($obj[$id]); 
                       
                    } else {
                        
                    $obj[$id]--;
                    }
                
                } else {
                    $obj[$id]++;
                }
            }
            else {
                $obj[$id] = 1;
            };
          
          $jsonSt = BaseJson::encode($obj);   
          
        return $jsonSt;
    }
    
    
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
    

    
    public function addFoodDb($model,$del)
    {
        $order = $this::find()->where(['id_user'=> Yii::$app->user->id])->one();
        if($order){
           //обновление имеющейся записи в БД
            $order->sum = ($del && $order->count>0) ? $order->sum-$model->price : $order->sum + $model->price ;
            $order->count = $del ? ( $order->count>0 ? $order->count - 1: $order->count ): $order->count + 1 ;
            $order->json_order = $this::updateOrder($model->id,$order->json_order,$del);
            $order->save();
            if(!$order->save()){
                print_r($order->getErrors());}
            
        } else {
            //запись в базу новой сессии
            $this->sum = $model->price;
            $this->count = '1';
            $this->id_user = Yii::$app->user->id;
            $this->json_order = Cart::updateOrder($model->id,$cartrow->json_order);
            $this->save();
                
                if(!$this->save()){
                print_r($this->getErrors());}
        }
        
        
    }
    
    
    public  function addFood($model,$del){
       
                $this->addFoodDb($model,$del);
                CartSession::addFoodSessionFromBd();
           
            
    }

    
}
