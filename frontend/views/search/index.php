<?php
/* @var $this yii\web\View */

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$ingredients = \common\models\Ingredient::getIngredientsList();
$arr = ArrayHelper::toArray($ingredients);
$arr = ArrayHelper::map($arr, 'id', 'name');



?>
<div class="align-middle">
<h1>Поиск рецептов</h1>

<?php $form = ActiveForm::begin() ?>

<?= $form->field($model, 'ingredients')->dropDownList($arr, ['multiple' => 'multiple', 'size' => count($arr)])->label('Выберите игредиенты (с зажатой клавишей ctrl)'); ?>

<div class="form-group">
    <?= Html::submitButton('Поиск', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end() ?>

    <?php  if($result): ?>
<?php foreach ($result as $recipe): ?>

    <h3>
         <span class="text-warning"><?php echo $recipe->name ?> </span>
        <br>
        <b>Ингредиенты: </b>

            <?php foreach ($recipe->getIngredients() as $ingredient): ?>
                <?php echo $ingredient->name; ?>,
            <?php endforeach; ?>

    </h3>
    <br><br>
    <hr>

<?php endforeach; ?>
    <?php endif; ?>
</div>