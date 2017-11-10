<?php

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>
   
<?php Pjax::begin(['id' => 'menu']); ?>
<div class="col-lg-4 text-center">
<div class="food">
    <div style="min-height: 200px; max-height:200px; overflow: hidden;"><img src="/<?= Html::encode($model->picture); ?>" width="93%"></div>
    <p><?= Html::encode($model->name); ?></p>
    <p>Вес: <?= Html::encode($model->weight); ?></p>
    <p>Цена: <?= Html::encode($model->price); ?></p>
    <?= Html::a('-', ['index','id'=>$model->id,'del'=>true], ['class' => 'count external-link']) ?>
      <?= Html::a('+', ['index','id'=>$model->id,], ['class' => 'count external-link']) ?>
     
    <br />
    <?//= Html::a("Обновить", ['cart/clear'], ['class' => 'btn btn-lg btn-primary']) ?>
 
</div>
</div>
<?php Pjax::end(); ?>

