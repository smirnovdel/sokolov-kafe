<?php

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

?>

<div class="col-lg-4 text-center">
<div class="food">
    <div style="min-height: 200px; max-height:200px; overflow: hidden;"><img src="/<?= Html::encode($model->picture); ?>" width="93%"></div>
    <p><?= Html::encode($model->name); ?></p>
    <p>Вес: <?= Html::encode($model->weight); ?></p>
    <p>Цена: <?= Html::encode($model->price); ?></p>
    <a href="<?php echo Url::to(['cart/add-to-cart','id'=>$model->id,'link'=>'menu/index']); ?>">добавить</a>
    <a href="<?php echo Url::to(['cart/cleart']); ?>">очистить</a>
    <?//= Html::a("Обновить", ['cart/clear'], ['class' => 'btn btn-lg btn-primary']) ?>
 
</div>
</div>

