<?php

use yii\db\Migration;

class m240526_100020_create_table_ob_request_log extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%ob_request_log}}',
            [
                'id' => $this->primaryKey(),
                'client_id' => $this->integer()->notNull(),
                'slave_id' => $this->integer()->notNull(),
                'track_id' => $this->string(50),
                'service_type' => $this->integer()->notNull(),
                'status' => $this->integer()->notNull(),
                'message' => $this->string(100),
                'url' => $this->string()->notNull(),
                'method' => $this->string(5)->notNull(),
                'headers' => $this->json()->notNull()->defaultExpression('(JSON_OBJECT())'),
                'data' => $this->json()->notNull()->defaultExpression('(JSON_OBJECT())'),
                'response' => $this->json()->defaultExpression('(JSON_OBJECT())'),
                'created_at' => $this->integer()->notNull(),
                'created_by' => $this->integer()->notNull(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%ob_request_log}}');
    }
}
