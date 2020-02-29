<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%locations}}`.
 */
class m200229_183343_create_locations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%locations}}', [
            'id' => $this->primaryKey(),
            'city' => $this->string(128)->notNull()->unique(),
            'lat' => $this->string(128)->notNull(),
            'long' => $this->string(128)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%locations}}');
    }
}
