<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use dosamigos\fileinput\FileInput;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row text-center">
  <div class="box">
<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'picture')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],

    ]);?>

    <?php $category = ArrayHelper::map(\app\models\Category::find()->all(), 'id','name') ?>
    <?= $form->field($model, 'category')->dropDownList($category, ['prompt' => '---- Select price type ----'])->label('price type') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
