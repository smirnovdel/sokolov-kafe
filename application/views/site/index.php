<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
$this->registerJs(
    "$('.carousel').carousel({
        interval: 4000 //changes the speed
    })",
    $this::POS_READY,
    'site-index-carousel'
);
?>
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <div id="carousel-example-generic" class="carousel slide">
                    <!-- Indicators -->
                    <ol class="carousel-indicators hidden-xs">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item">
                            <img class="img-responsive img-full" src="/img/slide-1.jpg" alt="">
                        </div>
                        <div class="item active">
                            <img class="img-responsive img-full" src="/img/slide-2.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive img-full" src="/img/slide-3.jpg" alt="">
                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="icon-prev"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="icon-next"></span>
                    </a>
                </div>
                <h2 class="brand-before">
                    <small>Welcome to</small>
                </h2>
                <h1 class="brand-name">La Bottega Siciliana</h1>
                <hr class="tagline-divider">
                <h2>
                    <small>the  
                        <strong>best cuisine </strong>
                        in Sicily</small>
                </h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center">Бла -  
                    <strong>бла</strong> - бла
                </h2>
                <hr>
                <img class="img-responsive img-border img-left" src="/img/intro-pic.jpg" alt="">
                <hr class="visible-xs">
                <p>Тут будет красивый текст<br><br><br><br><br><br>
                    <br><br>где-то тут он закончится</p>


            </div>
        </div>
    </div>
    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center">Очень
                    <strong>красиво у меня все получается</strong>
                </h2>
                <hr>
                
                <p>И тут что-нибудь напишу</p>
            </div>
        </div>
    </div>
<script>
  
</script>