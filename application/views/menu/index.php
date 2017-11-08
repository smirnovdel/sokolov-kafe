<?php

use Yii;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Меню';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="menu-index">
<p>
        <?= Html::a('Create Foodss', ['create'], ['class' => 'btn btn-success']) ?>
    </p>    
    
    <?php
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => [
        'tag' => 'div',
        'class' => 'list-wrapper',
        'id' => 'list-wrapper',
    ],
    'layout' => "{items}\n{pager}",
    'itemView' => '_list',
    
]);?>
    
</div>
