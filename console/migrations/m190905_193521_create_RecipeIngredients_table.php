<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%RecipeIngredients}}`.
 */
class m190905_193521_create_RecipeIngredients_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%recipe_ingredients}}', [
            'id' => $this->primaryKey(),
            'recipe_id' => $this->integer()->notNull(),
            'ingredient_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'recipes',  // это "условное имя" ключа
            'recipe_ingredients', // это название текущей таблицы
            'recipe_id', // это имя поля в текущей таблице, которое будет ключом
            'recipes', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%Recipe_Ingredients}}');
    }
}
