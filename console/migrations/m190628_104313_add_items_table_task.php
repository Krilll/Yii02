<?php

use yii\db\Migration;

/**
 * Class m190628_104313_add_items_table_task
 */
class m190628_104313_add_items_table_task extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('task', [
            'title' => 'sleep',
            'description' => 'Lorem ipsum dolor sit amet.',
            'creator_id' => 1,
            'created_at' => 1010100118,
        ]);
        $this->insert('task', [
            'title' => 'nothing',
            'description' => 'Maecenas at metus velit.',
            'creator_id' => 1,
            'created_at' => 1010100118,
        ]);
        $this->insert('task', [
            'title' => 'walk',
            'description' => 'Vivamus rutrum diam dolor.',
            'creator_id' => 1,
            'created_at' => 1010100118,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('task',['title' => 'sleep']);
        $this->delete('task',['title' => 'nothing']);
        $this->delete('task',['title' => 'walk']);

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190628_104313_add_items_table_task cannot be reverted.\n";

        return false;
    }
    */
}
