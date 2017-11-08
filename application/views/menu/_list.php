<?php
// _list_item.php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$provider = new yii\data\ArrayDataProvider([
    'allModels' => $model->getFoods()->orderby(['name' => SORT_ASC])->all(),
    'pagination' => [
        'pageParam' => 'page-food-' . $model->id,
        'pageSize' => 3,
        
    ],
    
]);
?>

<div class="row text-center">
  <div class="box">
    <h3><?= Html::encode($model->name); ?></h3>
    <?php Pjax::begin(['enablePushState' => false]); ?>
    <?php
 echo ListView::widget([
     
    'dataProvider' => $provider,  
     
    'options' => [
        'tag' => 'div',
        'class' => 'list-wrapper',
        'id' => 'list-wrapper',
        
    ],     
    'layout' => "{items}\n{pager}",
    'itemView' => '_list-food',
     
    
]);
 ?>
    <?php Pjax::end(); ?>
  </div>
</div>

