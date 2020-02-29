<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tasks}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%categories}}`
 * - `{{%locations}}`
 * - `{{%users}}`
 * - `{{%users}}`
 */
class m200229_183931_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%tasks}}', [
            'id' => $this->primaryKey(),
            'creation_time' => $this->dateTime()->defaultValue(0)->notNull(),
            'name' => $this->string(128)->notNull(),
            'category_id' => $this->integer()->notNull(),
            'description' => $this->text(),
            'location_id' => $this->integer()->notNull(),
            'budget' => $this->integer(),
            'deadline' => $this->dateTime()->notNull(),
            'customer_id' => $this->integer()->notNull(),
            'executor_id' => $this->integer(),
            'status' => $this->string(128),
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            '{{%idx-tasks-category_id}}',
            '{{%tasks}}',
            'category_id'
        );

        // add foreign key for table `{{%categories}}`
        $this->addForeignKey(
            '{{%fk-tasks-category_id}}',
            '{{%tasks}}',
            'category_id',
            '{{%categories}}',
            'id',
            'CASCADE'
        );

        // creates index for column `location_id`
        $this->createIndex(
            '{{%idx-tasks-location_id}}',
            '{{%tasks}}',
            'location_id'
        );

        // add foreign key for table `{{%locations}}`
        $this->addForeignKey(
            '{{%fk-tasks-location_id}}',
            '{{%tasks}}',
            'location_id',
            '{{%locations}}',
            'id',
            'CASCADE'
        );

        // creates index for column `customer_id`
        $this->createIndex(
            '{{%idx-tasks-customer_id}}',
            '{{%tasks}}',
            'customer_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-tasks-customer_id}}',
            '{{%tasks}}',
            'customer_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // creates index for column `executor_id`
        $this->createIndex(
            '{{%idx-tasks-executor_id}}',
            '{{%tasks}}',
            'executor_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-tasks-executor_id}}',
            '{{%tasks}}',
            'executor_id',
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
        // drops foreign key for table `{{%categories}}`
        $this->dropForeignKey(
            '{{%fk-tasks-category_id}}',
            '{{%tasks}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            '{{%idx-tasks-category_id}}',
            '{{%tasks}}'
        );

        // drops foreign key for table `{{%locations}}`
        $this->dropForeignKey(
            '{{%fk-tasks-location_id}}',
            '{{%tasks}}'
        );

        // drops index for column `location_id`
        $this->dropIndex(
            '{{%idx-tasks-location_id}}',
            '{{%tasks}}'
        );

        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-tasks-customer_id}}',
            '{{%tasks}}'
        );

        // drops index for column `customer_id`
        $this->dropIndex(
            '{{%idx-tasks-customer_id}}',
            '{{%tasks}}'
        );

        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-tasks-executor_id}}',
            '{{%tasks}}'
        );

        // drops index for column `executor_id`
        $this->dropIndex(
            '{{%idx-tasks-executor_id}}',
            '{{%tasks}}'
        );

        $this->dropTable('{{%tasks}}');
    }
}
