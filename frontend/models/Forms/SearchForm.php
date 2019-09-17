<?php

namespace frontend\models\forms;

use common\models\Recipe_Ingredient;
use yii\base\Model;


class SearchForm extends model
{
    const SCENARIO_DEFAULT = "SEARCH";

    public $ingredients;

    public function rules()
    {
        return [
            [['ingredients'], 'required'],
        ];
    }

    public function search()
    {
        if(count($this->ingredients) < 2) {
            \Yii::$app->session->setFlash('warning','Пожалуйста , укажите хотя бы 2 ингредиентов');
            return false;
        }

        if(count($this->ingredients) > 5) {
            \Yii::$app->session->setFlash('warning','Пожалуйста , укажите не более 5 ингредиентов');
            return false;
        }

       $resArray =  Recipe_Ingredient::getRecipesByIngredientsId($this->ingredients);
       $result = [];
       foreach ($resArray as $res) {
           foreach ($res as $re) {
               array_push($result,$re);
           }
       }

       // Если массив с результатом пустой возвращаем ошибку
       if (empty($result)) {
           return \Yii::$app->session->setFlash('danger','Ничего схожего не найдено');
       }
       return $result;
    }


    public function size($attribute, $params)
    {
        if (count($this->$attribute) < 2) {
            $this->addError($attribute, 'Пожалуйста , укажите хотя бы 2 ингредиента');
        }
    }


}