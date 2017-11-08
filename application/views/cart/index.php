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
 
 foreach ($model as $key => $value) {?>
    <div class="col-lg-4 text-center">
        <div class="food">
         <div style="min-height: 200px; max-height:200px; overflow: hidden;"><img src="/<?= $value['picture'] ?>" width="93%"></div>
         <p><?= $value['name'] ?></p>
    <p>Вес: <?= $value['weight'] ?></p>
    <p>Цена: <?= $value['price'] ?></p>
    <p>Количество: <?= $value['count'] ?>
     <?= Html::a('-', ['cart/add-to-cart','id'=>$value['id'],'del'=>true], ['class' => 'count external-link']) ?>
      <?= Html::a('+', ['cart/add-to-cart','id'=>$value['id']], ['class' => 'count external-link']) ?>
    </p>
        </div>
    </div> 
<?php }
    
Pjax::end();
?>
</div>
</div>
        
        
        
</div>

</div>
