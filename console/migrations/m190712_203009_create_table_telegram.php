<?php

use yii\db\Migration;

/**
 * Class m190712_203009_create_table_telegram
 */
class m190712_203009_create_table_telegram extends Migration
{
    public function safeUp()
    {
        $this->createTable('telegram', [
            'id' => $this->integer(),
            'timestamp_offset' => $this->timestamp()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('telegram');
    }
}
