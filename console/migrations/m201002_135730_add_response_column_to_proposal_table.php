<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%proposal}}`.
 */
class m201002_135730_add_response_column_to_proposal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%proposal}}', 'response', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%proposal}}', 'response');
    }
}
