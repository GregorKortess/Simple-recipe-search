<?php

namespace common\models;

use phpDocumentor\Reflection\Types\Integer;
use Yii;
use common\models\Ingredient;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "recipe_ingredients".
 *
 * @property int $id
 * @property int $recipe_id
 * @property int $ingredient_id
 */
class Recipe_Ingredient extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recipe_ingredients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['recipe_id', 'ingredient_id'], 'required'],
            [['recipe_id', 'ingredient_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'recipe_id' => 'Recipe ID',
            'ingredient_id' => 'Ingredient ID',
        ];
    }

    /**
     * @param Integer $id
     * @return array
     */
    public static function getIngredientsIdByRecipeId($id)
    {
        $ids = self::find()->where(['recipe_id' => $id])->select('ingredient_id')->asArray()->all();
        $arr = [];
        foreach ($ids as $id) {
            array_push($arr, $id['ingredient_id']);
        }
        return $arr;
    }


    /**
     * @param array $ingredientsIds
     * @return array
     */
    public static function getRecipesByIngredientsId(Array $ingredientsIds)
    {
        // Version 2.0

        $res = [];
        $recipes = [];

        // Сначала находим все рецепты , у которых есть , хотя бы одно совпадение с ингредиентом
        foreach ($ingredientsIds as $id) {
            $arrayOfRecipes = self::find()->where(['ingredient_id' => $id])->select('recipe_id')->asArray()->all();
            array_push($res, $arrayOfRecipes);
        }

        // Избавляемся от лишних слоёв массивов , что бы получить единственный
        // массив с id рецептов
        $recipeValues = [];
        foreach ($res as $item1) {
            foreach ($item1 as $item2) {
                foreach ($item2 as $item3) {
                    array_push($recipeValues, $item3);
                }
            }
        }
        $recipeValues = array_count_values($recipeValues);


        $res = [];
        $resFull = [];

        // Если кол-во искомых элементов = кол-ву найденных рецептов и общее кол-во записей
        // Этого рецепта равны, получается полное совпадение , в противном случае , если совпадений больше двух
        // Возвращаем частичный результат
        foreach ($recipeValues as $key => $value) {
            if ($value == count($ingredientsIds) && self::find()->where(['recipe_id' => $key])->count() == count($ingredientsIds)) {
                array_push($resFull, $key);
            } elseif ($value >= 2) {
                array_push($res, $key);
            }
        }

        // Если есть полные совпадения - возвращаем только их
        if ($resFull) {
            foreach ($resFull as $recipeId) {
                array_push($recipes, Recipe::find()->where(['id' => $recipeId])->all());
            }

           return $recipes;
        }

        // Если полных совпадений нет - возвращаем частичные
        foreach ($res as $recipeId) {
            array_push($recipes, Recipe::find()->where(['id' => $recipeId])->all());
        }

        return $recipes;


    }
}
