<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chat_messages}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%tasks}}`
 * - `{{%users}}`
 */
class m200229_184313_create_chat_messages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%chat_messages}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'writer_id' => $this->integer()->notNull(),
            'comment' => $this->text(),
            'creation_time' => $this->dateTime()->defaultValue(0)->notNull(),
            'viewed' => $this->tinyInteger()->notNull(),
        ]);

        // creates index for column `task_id`
        $this->createIndex(
            '{{%idx-chat_messages-task_id}}',
            '{{%chat_messages}}',
            'task_id'
        );

        // add foreign key for table `{{%tasks}}`
        $this->addForeignKey(
            '{{%fk-chat_messages-task_id}}',
            '{{%chat_messages}}',
            'task_id',
            '{{%tasks}}',
            'id',
            'CASCADE'
        );

        // creates index for column `writer_id`
        $this->createIndex(
            '{{%idx-chat_messages-writer_id}}',
            '{{%chat_messages}}',
            'writer_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-chat_messages-writer_id}}',
            '{{%chat_messages}}',
            'writer_id',
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
        // drops foreign key for table `{{%tasks}}`
        $this->dropForeignKey(
            '{{%fk-chat_messages-task_id}}',
            '{{%chat_messages}}'
        );

        // drops index for column `task_id`
        $this->dropIndex(
            '{{%idx-chat_messages-task_id}}',
            '{{%chat_messages}}'
        );

        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-chat_messages-writer_id}}',
            '{{%chat_messages}}'
        );

        // drops index for column `writer_id`
        $this->dropIndex(
            '{{%idx-chat_messages-writer_id}}',
            '{{%chat_messages}}'
        );

        $this->dropTable('{{%chat_messages}}');
    }
}
