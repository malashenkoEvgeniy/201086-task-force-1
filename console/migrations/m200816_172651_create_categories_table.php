<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%categories}}`.
 */
class m200816_172651_create_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%categories}}', [
          'id' => $this->primaryKey(),
          'title' => $this->string(128)->notNull()->unique(),
          'title_en' => $this->string(128)->notNull(),
        ]);

        $this->batchInsert('categories', ['title', 'title_en'], [
          ['Курьерские услуги', 'translation'],
          ['Уборка', 'clean'],
          ['Переезды', 'cargo'],
          ['Компьютерная помощь', 'neo'],
          ['Ремонт квартирный', 'flat'],
          ['Ремонт техники', 'repair'],
          ['Красота', 'beauty'],
          ['Фото', 'photo'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%categories}}');
    }
}
