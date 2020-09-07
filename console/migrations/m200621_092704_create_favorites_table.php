<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%favorites}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m200621_092704_create_favorites_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%favorites}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'favorites_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-favorites-user_id}}',
            '{{%favorites}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-favorites-user_id}}',
            '{{%favorites}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // creates index for column `favorites_id`
        $this->createIndex(
            '{{%idx-favorites-favorites_id}}',
            '{{%favorites}}',
            'favorites_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-favorites-favorites_id}}',
            '{{%favorites}}',
            'favorites_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-favorites-user_id}}',
            '{{%favorites}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-favorites-user_id}}',
            '{{%favorites}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-favorites-favorites_id}}',
            '{{%favorites}}'
        );

        // drops index for column `favorites_id`
        $this->dropIndex(
            '{{%idx-favorites-favorites_id}}',
            '{{%favorites}}'
        );

        $this->dropTable('{{%favorites}}');
    }
}
