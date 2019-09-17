<?php

namespace backend\models\forms;

use common\models\Ingredient;
use yii\base\Model;
use common\models\Recipe;
use common\models\Recipe_Ingredient;

class EditRecipeForm extends model
{

    private $recipe;

    public $id;
    public $name;
    public $ingredients;

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['ingredients'], 'required']
        ];
    }

    public function __construct(Recipe $recipe)
    {
        $this->recipe = $recipe;
        $this->ingredients = Ingredient::getIngredientsList();
        $this->name = $this->recipe->name;
        $this->id = $this->recipe->id;
    }

    public function save()
    {
        if ($this->validate()) {

            // Изменяем название рецепта
            $recipe = $this->recipe;
            $recipe->name = $this->name;
             $recipe->save(false);

             // Удаляем старые данные из связной таблицы , что бы они не дублировались
            $recipe_Ingredient = new Recipe_Ingredient();
            $recipe_Ingredient::deleteAll(['recipe_id' => $this->id ]);

            // Добавляем новые данные в таблицу для связи
            foreach ($this->ingredients as $ingredient_id) {

                $recipe_Ingredient = new Recipe_Ingredient();
                $recipe_Ingredient->recipe_id = $recipe->id;
                $recipe_Ingredient->ingredient_id = $ingredient_id;
                $recipe_Ingredient->save(false);

            }
        }
        return true;
    }
}