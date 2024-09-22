<?php

use yii\db\Migration;

class m240623_110020_update_table_ob_request_log extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%ob_request_log}}', 'created_by', $this->integer());
    }

    public function safeDown()
    {
        $this->alterColumn('{{%ob_request_log}}', 'created_by', $this->integer()->notNull());
    }
}
