<?php

/* @var $this yii\web\View */

$this->registerJs(
    "$('#menu').on('pjax:end',   function() { 
  $.pjax.reload({
    container : '#mini',
    replace    : false,
    timeout: '1000',
    url: 'index',
  });		
});
    $('#cart').on('pjax:end',   function() { 
  $.pjax.reload({
    container : '#mini',
  });		
});
        ",
    $this::POS_READY,
    'site-mini-cart'
);
?>
<div class="panel panel-default1" >   
<div class='box'>
        <ul>
            <li>Сумма: <?=$_SESSION['curt']['sum']?></li>
            <li>Кол-во: <?=$_SESSION['curt']['count']?></li>
        </ul>
    </div>
</div>
