<?php

namespace backend\models\forms;

use yii\base\Model;
use common\models\Recipe;
use common\models\Recipe_Ingredient;

class RecipeForm extends model
{

    public $name;
    public $ingredients;

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['ingredients'], 'required']
        ];
    }



    public function save()
    {
        if ($this->validate()) {

            $recipe = New Recipe();
            $recipe->name = $this->name;
             $recipe->save(false);

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