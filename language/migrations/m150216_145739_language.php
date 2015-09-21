<?php

use yii\db\Schema;
use yii\db\Migration;

class m150216_145739_language extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%language}}', [
            'id' => Schema::TYPE_PK,
            'url' => Schema::TYPE_STRING . '(255) NOT NULL',
            'local' => Schema::TYPE_STRING . '(255) NOT NULL',
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'default' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->batchInsert('{{%language}}', ['url', 'local', 'name', 'default', 'created_at', 'updated_at'], [
            ['en', 'en-EN', 'English', 1, time(), time()],
            ['ru', 'ru-RU', 'Русский', 0, time(), time()],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%language}}');
    }
}
