<?php

use yii\db\Migration;

class m240526_095704_create_table_ob_oauth_clients extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%ob_oauth_clients}}',
            [
                'id' => $this->primaryKey(),
                'client_id' => $this->string(32)->notNull(),
                'base_url' => $this->string()->notNull(),
                'client_secret' => $this->string(32),
                'grant_types' => $this->string(100),
                'scope' => $this->string(2000),
                'username' => $this->string(100),
                'password' => $this->string(2000),
                'add_on' => $this->json()->defaultExpression('(JSON_OBJECT())'),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%ob_oauth_clients}}');
    }
}
