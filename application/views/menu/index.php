<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Menu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php/* GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'food',
            'weight',
            'price',
            'time_id',
             //'picture',
            // 'createdata',
            // 'sostav',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */?>
    
    <?php

 
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => [
        'tag' => 'div',
        'class' => 'list-wrapper',
        'id' => 'list-wrapper',
    ],
    'layout' => "{pager}\n{items}\n{summary}",
    'itemView' => '_list',
]);?>
</div>
