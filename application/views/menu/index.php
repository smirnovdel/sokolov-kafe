<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Меню';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['class'=>'form-horizontal', 'action'=>Url::toRoute(['controllername/add-to-cart','id'=>$product->id])]); ?>

    <?=Html::input('submit','submit','Add to cart',[
                'class'=>'button add',

              ])?>
<?php ActiveForm::end(); ?>
 
<div class="menu-index">

    

   
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
