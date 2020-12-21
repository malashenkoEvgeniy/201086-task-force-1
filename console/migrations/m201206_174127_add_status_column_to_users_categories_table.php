<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%users_categories}}`.
 */
class m201206_174127_add_status_column_to_users_categories_table extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $this->addColumn('{{%users_categories}}', 'status', $this->integer(2)->defaultValue(0));
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropColumn('{{%users_categories}}', 'status');
  }
}
