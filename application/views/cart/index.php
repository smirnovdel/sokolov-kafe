<?php
$session = Yii::$app->session;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?//= Html::a('Create Cart', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    
    <?php 

    
    
    if (!$_SESSION['curt']){
        
        $session['curt'] = [
            'login_id' => Yii::$app->user->isGuest ? 'guest' : Yii::$app->user->id];
        
    }

?>
    <div class="menu-index">
   
    <div class="row text-center">
  <div class="box">
 <?php
 Pjax::begin(['id' => 'cart','enablePushState' => false]); 

 echo ListView::widget([

     'dataProvider' => $dataProvider,

     'options' => [
         'tag' => 'div',
         'class' => 'list-wrapper',
         'id' => 'list-wrapper',

     ],
     'layout' => "{items}\n{pager}",
     'itemView' => '_list',
 ]);

Pjax::end();
?>
</div>
</div>
        
        
        
</div>

</div>
