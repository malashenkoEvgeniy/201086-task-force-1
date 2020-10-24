<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%locations}}`.
 */
class m200816_172611_create_locations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%locations}}', [
          'id' => $this->primaryKey(),
          'city' => $this->string(128)->notNull()->unique(),
          'lat' => $this->string(128)->notNull(),
          'long' => $this->string(128)->notNull(),
        ]);

        $this->insert('locations', ['city' => 'test', 'lat' => 0, 'long' => 0]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%locations}}');
    }
}
