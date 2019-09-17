<?php

use common\models\Ingredient;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Recipe */


$this->title = 'Create Recipe';
$this->params['breadcrumbs'][] = ['label' => 'Recipes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipe-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'ingredients' => $ingredients,
    ]) ?>

</div>
