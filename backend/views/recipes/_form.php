<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Recipe */
/* @var $form yii\widgets\ActiveForm */

$ingredients = \common\models\Ingredient::getIngredientsList();

$arr = ArrayHelper::toArray($ingredients);
$arr = ArrayHelper::map($arr,'id','name');
?>

<div class="recipe-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Название') ?>

    <?= $form->field($model, 'ingredients')->dropDownList($arr, ['multiple' => 'multiple','size' => count($arr)])->label('Выберите игредиенты (с зажатой клавишей ctrl)'); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
