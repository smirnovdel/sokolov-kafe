<?php
// _list_item.php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;


?>



    <h3><?//= Html::encode($model->name); ?></h3>

    <?php
 ?>
      <div class="col-lg-4 text-center">
          <div class="food">
              <div style="min-height: 200px; max-height:200px; overflow: hidden;"><img src="/<?= $model->food->picture ?>" width="93%"></div>
              <p><?= $model->food->name ?></p>
              <p>Вес: <?= $model->food->weight ?></p>
              <p>Цена: <?= $model->food->price ?></p>
              <p>Количество: <?= $model->count ?></p>
                  <?= Html::a('-', ['cart/add-to-cart','id'=>$model->food->id,'del'=>true], ['class' => 'count external-link']) ?>
                  <?= Html::a('+', ['cart/add-to-cart','id'=>$model->food->id], ['class' => 'count external-link']) ?>
              </p>
          </div>
      </div>






