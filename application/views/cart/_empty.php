<?php
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

    <div class="menu-index">

        <div class="row text-center">
            <div class="box">
               <p>Добавьте товар в корзину</p>
            </div>
        </div>



    </div>

</div>
