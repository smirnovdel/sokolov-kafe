<?php

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class MiniCart extends Widget
{
    public $message;

    public function init()
    {
       
        parent::init();
        
    }

  public function run()
    {
        return $this->render('mini');
    }
}