<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%locations}}`
 */
class m200229_183751_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'creation_time' => $this->dateTime()->defaultValue(0)->notNull(),
            'name' => $this->string(128)->notNull(),
            'email' => $this->string(128)->notNull(),
            'location_id' => $this->integer()->notNull(),
            'birthday' => $this->dateTime(),
            'info' => $this->text(),
            'password' => $this->string(128)->notNull(),
            'phone' => $this->string(128),
            'skype' => $this->string(128),
            'another_messenger' => $this->string(128),
            'avatar' => $this->string(128),
            'task_name' => $this->string(128),
            'show_contacts_for_customer' => $this->tinyInteger(),
            'hide_profile' => $this->tinyInteger(),
        ]);

        // creates index for column `location_id`
        $this->createIndex(
            '{{%idx-users-location_id}}',
            '{{%users}}',
            'location_id'
        );

        // add foreign key for table `{{%locations}}`
        $this->addForeignKey(
            '{{%fk-users-location_id}}',
            '{{%users}}',
            'location_id',
            '{{%locations}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        // drops foreign key for table `{{%locations}}`
        $this->dropForeignKey(
            '{{%fk-users-location_id}}',
            '{{%users}}'
        );

        // drops index for column `location_id`
        $this->dropIndex(
            '{{%idx-users-location_id}}',
            '{{%users}}'
        );

        $this->dropTable('{{%users}}');
    }
}
