<?php

use yii\db\Migration;

/**
 * Class m190702_095553_add_items_table_task
 */
class m190702_095553_add_items_table_task extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('task', [
            'title' => 'sleep',
            'description' => 'Lorem ipsum dolor sit amet.',
            'project_id' => 1,
            'creator_id' => 1,
            'created_at' => 1010100118,
        ]);
        $this->insert('task', [
            'title' => 'nothing',
            'description' => 'Maecenas at metus velit.',
            'project_id' => 1,
            'creator_id' => 1,
            'created_at' => 1010100118,
        ]);
        $this->insert('task', [
            'title' => 'walk',
            'description' => 'Vivamus rutrum diam dolor.',
            'project_id' => 1,
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
        echo "m190702_095048_add_items_table_task cannot be reverted.\n";

        return false;
    }
    */
}
