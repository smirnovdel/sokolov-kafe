<?php
// _list_item.php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;


?>

<div class="col-lg-4 text-center">
<div class="food">
    <div style="min-height: 200px; max-height:200px; overflow: hidden;"><img src="<?= Html::encode($model->picture); ?>" width="93%"></div>
    <p><?= Html::encode($model->name); ?></p>
    <p>Вес: <?= Html::encode($model->weight); ?></p>
    <p>Цена: <?= Html::encode($model->price); ?></p>
    <a href="<?php echo Url::to(['menu/add-to-cart','id'=>$model->id]); ?>">добавить</a>
</div>
</div>

