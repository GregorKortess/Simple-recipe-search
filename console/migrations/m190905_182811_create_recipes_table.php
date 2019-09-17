<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%recipes}}`.
 */
class m190905_182811_create_recipes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%recipes}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);

        $this->addForeignKey(
            'ingredients',  // это "условное имя" ключа
            'recipes', // это название текущей таблицы
            'id', // это имя поля в текущей таблице, которое будет ключом
            'ingredients', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%recipes}}');
    }
}
