<?php

use yii\db\Migration;

class m200919_110200_add_created_at_column_to_proposal_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%proposal}}', 'created_at', $this->integer()->notNull());
    }

    public function down()
    {
        $this->dropColumn('{{%proposal}}', 'created_at');
    }
}
