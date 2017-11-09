<?php
// _list_item.php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;


?>

<div class="row text-center">
  <div class="box">
    <h3><?//= Html::encode($model->name); ?></h3>
    <?php Pjax::begin(['enablePushState' => false]); ?>
    <?php
 echo $model->food->name;
 ?>
    <?php Pjax::end(); ?>
  </div>
</div>

