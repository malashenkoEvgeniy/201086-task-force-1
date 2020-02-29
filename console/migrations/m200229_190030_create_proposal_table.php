<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%proposal}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%tasks}}`
 * - `{{%users}}`
 */
class m200229_190030_create_proposal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%proposal}}', [
            'id' => $this->primaryKey(),
            'comment' => $this->string(128)->notNull(),
            'task_id' => $this->integer()->notNull(),
            'budget' => $this->integer(),
            'user_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `task_id`
        $this->createIndex(
            '{{%idx-proposal-task_id}}',
            '{{%proposal}}',
            'task_id'
        );

        // add foreign key for table `{{%tasks}}`
        $this->addForeignKey(
            '{{%fk-proposal-task_id}}',
            '{{%proposal}}',
            'task_id',
            '{{%tasks}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-proposal-user_id}}',
            '{{%proposal}}',
            'user_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-proposal-user_id}}',
            '{{%proposal}}',
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
        // drops foreign key for table `{{%tasks}}`
        $this->dropForeignKey(
            '{{%fk-proposal-task_id}}',
            '{{%proposal}}'
        );

        // drops index for column `task_id`
        $this->dropIndex(
            '{{%idx-proposal-task_id}}',
            '{{%proposal}}'
        );

        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-proposal-user_id}}',
            '{{%proposal}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-proposal-user_id}}',
            '{{%proposal}}'
        );

        $this->dropTable('{{%proposal}}');
    }
}
