<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reviews}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users}}`
 * - `{{%users}}`
 * - `{{%tasks}}`
 */
class m200229_184514_create_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%reviews}}', [
            'id' => $this->primaryKey(),
            'creation_time' => $this->dateTime()->defaultValue(0)->notNull(),
            'customer_id' => $this->integer(),
            'executor_id' => $this->integer(),
            'assessment' => $this->integer(),
            'task_id' => $this->integer(),
            'comment' => $this->text(),
        ]);

        // creates index for column `customer_id`
        $this->createIndex(
            '{{%idx-reviews-customer_id}}',
            '{{%reviews}}',
            'customer_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-reviews-customer_id}}',
            '{{%reviews}}',
            'customer_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // creates index for column `executor_id`
        $this->createIndex(
            '{{%idx-reviews-executor_id}}',
            '{{%reviews}}',
            'executor_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-reviews-executor_id}}',
            '{{%reviews}}',
            'executor_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // creates index for column `task_id`
        $this->createIndex(
            '{{%idx-reviews-task_id}}',
            '{{%reviews}}',
            'task_id'
        );

        // add foreign key for table `{{%tasks}}`
        $this->addForeignKey(
            '{{%fk-reviews-task_id}}',
            '{{%reviews}}',
            'task_id',
            '{{%tasks}}',
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
            '{{%fk-reviews-customer_id}}',
            '{{%reviews}}'
        );

        // drops index for column `customer_id`
        $this->dropIndex(
            '{{%idx-reviews-customer_id}}',
            '{{%reviews}}'
        );

        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-reviews-executor_id}}',
            '{{%reviews}}'
        );

        // drops index for column `executor_id`
        $this->dropIndex(
            '{{%idx-reviews-executor_id}}',
            '{{%reviews}}'
        );

        // drops foreign key for table `{{%tasks}}`
        $this->dropForeignKey(
            '{{%fk-reviews-task_id}}',
            '{{%reviews}}'
        );

        // drops index for column `task_id`
        $this->dropIndex(
            '{{%idx-reviews-task_id}}',
            '{{%reviews}}'
        );

        $this->dropTable('{{%reviews}}');
    }
}
