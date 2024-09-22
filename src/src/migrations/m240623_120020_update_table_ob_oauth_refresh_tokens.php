<?php

use yii\db\Migration;

class m240623_120020_update_table_ob_oauth_refresh_tokens extends Migration
{
    public function safeUp()
    {
//        $this->dropPrimaryKey('PRIMARY', '{{%ob_oauth_refresh_tokens}}');
//        $this->alterColumn('{{%ob_oauth_refresh_tokens}}', 'refresh_token', $this->string(2048));
//        $this->addColumn('{{%ob_oauth_refresh_tokens}}', 'id', $this->primaryKey()->unsigned()->after('refresh_token'));

    }

    public function safeDown()
    {
        $this->dropColumn('{{%ob_oauth_refresh_tokens}}', 'id');
        $this->alterColumn('{{%ob_oauth_refresh_tokens}}', 'refresh_token', $this->string(40)->append('PRIMARY KEY'));
    }
}
