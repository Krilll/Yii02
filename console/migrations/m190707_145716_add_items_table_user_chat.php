<?php

use yii\db\Migration;

/**
 * Class m190707_145716_add_items_table_user_chat
 */
class m190707_145716_add_items_table_user_chat extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('chat_user', [
            'task_id' => 1,
            'user_id' => 1,
            'text' => 'Integer ultricies mollis accumsan.',
        ]);

        $this->insert('chat_user', [
            'task_id' => 2,
            'user_id' => 1,
            'text' => 'Donec ut tristique orci.',
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('chat_user',['id' => '1']);
        $this->delete('chat_user',['id' => '2']);

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190707_145716_add_items_table_user_chat cannot be reverted.\n";

        return false;
    }
    */
}
