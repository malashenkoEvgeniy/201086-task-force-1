<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%email_settings}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m200816_173208_create_email_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%email_settings}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'proposal' => $this->tinyInteger()->notNull(),
            'chat_message' => $this->tinyInteger()->notNull(),
            'refuse' => $this->tinyInteger()->notNull(),
            'start_task' => $this->tinyInteger()->notNull(),
            'completion_task' => $this->tinyInteger()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-email_settings-user_id}}',
            '{{%email_settings}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-email_settings-user_id}}',
            '{{%email_settings}}',
            'user_id',
            '{{%user}}',
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
            '{{%fk-email_settings-user_id}}',
            '{{%email_settings}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-email_settings-user_id}}',
            '{{%email_settings}}'
        );

        $this->dropTable('{{%email_settings}}');
    }
}
