<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "recipes".
 *
 * @property int $id
 * @property string $name
 */
class Recipe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recipes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return array
     */
    public function getIngredientsId()
    {
        return Recipe_Ingredient::getIngredientsIdByRecipeId($this->id);
    }

    public function getIngredients()
    {
        return Ingredient::findAll($this->getIngredientsId());
    }
}
