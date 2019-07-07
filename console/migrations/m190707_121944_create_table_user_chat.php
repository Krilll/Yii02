<?php

use yii\db\Migration;

/**
 * Class m190707_121944_create_table_user_chat
 */
class m190707_121944_create_table_user_chat extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('chat_user', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
            'time_date' => $this->dateTime()->null(),
        ]);

        // add foreign key for field `task_id`
        $this->addForeignKey(
            'task_task_id=task_id',
            'chat_user',
            'task_id',
            'task',
            'id'
        );
        // add foreign key for field `user_id`
        $this->addForeignKey(
            'task_user_id=user_id',
            'chat_user',
            'user_id',
            'user',
            'id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('chat_user');

        $this->dropForeignKey('task_task_id=task_id', 'chat_user');
        $this->dropForeignKey('task_user_id=user_id', 'chat_user');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190707_121944_create_table_user_chat cannot be reverted.\n";

        return false;
    }
    */
}
