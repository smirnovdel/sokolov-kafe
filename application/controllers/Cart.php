<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;


class CartController extends Controller
{
 
       /** @var ShoppingCart $sc */
        
       public function actionView()
    {

          return $this->redirect(['index']);
    } 
    
}
