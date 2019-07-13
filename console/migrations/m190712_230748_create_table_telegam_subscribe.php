<?php

use yii\db\Migration;

/**
 * Class m190712_230748_create_table_telegam_subscribe
 */
class m190712_230748_create_table_telegam_subscribe extends Migration
{
    public function safeUp()
    {
        $this->createTable('telegram_subscribe', [
            'id' => $this->primaryKey(),
            'thing' => "enum('tasks', 'projects', 'all')",
            'subs_telegram' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('telegram_subscribe');
    }
}
