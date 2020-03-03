<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%email_settings}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users}}`
 */
class m200229_185041_create_email_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
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
			$this->alterColumn('{{%email_settings}}', 'id', $this->integer().' NOT NULL AUTO_INCREMENT');

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-email_settings-user_id}}',
            '{{%email_settings}}',
            'user_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-email_settings-user_id}}',
            '{{%email_settings}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        // drops foreign key for table `{{%users}}`
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
