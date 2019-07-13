<?php

use yii\db\Migration;

/**
 * Class m190713_163808_create_table_max_items
 */
class m190713_163808_create_table_max_items extends Migration
{
    public function safeUp()
    {
        $this->createTable('max_items', [
            'title' => $this->text()->notNull(),
            'max_id' => $this->integer()->notNull()
        ]);

        $this->insert('max_items', [
            'title' => 'projects',
            'max_id' => 0,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('max_items');
    }
}
