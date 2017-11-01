<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\MiniCart;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="brand">La Bottega Siciliana</div>
    <div class="address-bar">Autostrada A19 Palermo-Catania | Uscita Dittaino Outlet - 94011 Agira</div>
   
 <?php
 //unset($_SESSION['curt']);
 //unset($_SESSION['login_id']);
 app\models\CartSession::getSession();
 echo 'Сумма: ' . $_SESSION['curt']['sum'] . ' <br>' .'Кол-во: ' . $_SESSION['curt']['count'];
 
 
?>
    
    <?php if (Yii::$app->user->can('admin', ['post' => $model])) { 
    echo Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); 
}  ?>   

    <?php
    NavBar::begin([
           'options' => [
            //'class' => 'navbar-inverse navbar-fixed-top',
            'class' => 'navbar navbar-default',
        ],
    ]);
    
    
   
    
 echo 
        Nav::widget([
        'options' => ['class' => 'nav navbar-nav'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Menu', 'url' => ['/menu']],
            
            Yii::$app->user->isGuest ?
                ['label' => 'Sign in', 'url' => ['/user/security/login']] :
                ['label' => 'Sign out (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/user/security/logout'],
                    'linkOptions' => ['data-method' => 'post']],
                ['label' => 'Register', 'url' => ['/user/registration/register'], 'visible' => Yii::$app->user->isGuest],
            Yii::$app->user->isGuest ?'':['label' => 'Корзина', 'url' => ['/cart']]    
                
                ],
            
    ]);
    NavBar::end();
   echo MiniCart::widget(['message' => 'Good morning']); ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
         <?= $content ?>
    </div>
</div>

<footer >
    <div class="container">
        <div class="row">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
