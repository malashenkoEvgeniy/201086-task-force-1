<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%review}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 * - `{{%task}}`
 */
class m200816_173105_create_review_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%review}}', [
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
            '{{%idx-review-customer_id}}',
            '{{%review}}',
            'customer_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-review-customer_id}}',
            '{{%review}}',
            'customer_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `executor_id`
        $this->createIndex(
            '{{%idx-review-executor_id}}',
            '{{%review}}',
            'executor_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-review-executor_id}}',
            '{{%review}}',
            'executor_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `task_id`
        $this->createIndex(
            '{{%idx-review-task_id}}',
            '{{%review}}',
            'task_id'
        );

        // add foreign key for table `{{%task}}`
        $this->addForeignKey(
            '{{%fk-review-task_id}}',
            '{{%review}}',
            'task_id',
            '{{%task}}',
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
            '{{%fk-review-customer_id}}',
            '{{%review}}'
        );

        // drops index for column `customer_id`
        $this->dropIndex(
            '{{%idx-review-customer_id}}',
            '{{%review}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-review-executor_id}}',
            '{{%review}}'
        );

        // drops index for column `executor_id`
        $this->dropIndex(
            '{{%idx-review-executor_id}}',
            '{{%review}}'
        );

        // drops foreign key for table `{{%task}}`
        $this->dropForeignKey(
            '{{%fk-review-task_id}}',
            '{{%review}}'
        );

        // drops index for column `task_id`
        $this->dropIndex(
            '{{%idx-review-task_id}}',
            '{{%review}}'
        );

        $this->dropTable('{{%review}}');
    }
}
