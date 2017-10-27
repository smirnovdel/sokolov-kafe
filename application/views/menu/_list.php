<?php
// _list_item.php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

$provider = new yii\data\ArrayDataProvider([
    'allModels' => $model->getFoods()->orderby(['name' => SORT_ASC])->all(),
    /*'sort' => [
        'attributes' => ['id', 'email'],
    ],
    'pagination' => [
        'pageSize' => 2,
    ],*/
]);
?>

<div class="row text-center">
  <div class="box">
    <h3><?= Html::encode($model->name); ?></h3>
    
    <?php
 echo ListView::widget([
    'dataProvider' => $provider,     
    'options' => [
        'tag' => 'div',
        'class' => 'list-wrapper',
        'id' => 'list-wrapper',
        
    ],     
    'layout' => "{pager}\n{items}\n{summary}",
    'itemView' => '_list-food',
     
    
]);
 ?>
  </div>
</div>

