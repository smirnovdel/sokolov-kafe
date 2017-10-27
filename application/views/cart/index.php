<?php

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;


       foreach(Yii::$app->cart->positions as $position){
          echo $this->render('/cart/_cart_item',['position'=>$position]);
        } 