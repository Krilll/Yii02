<?php

use yii\db\Migration;

/**
 * Class m190702_095343_create_table_task
 */
class m190702_095343_create_table_task extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'project_id' => $this->integer()->null(),
            'executor_id' => $this->integer()->null(),
            'started_id' => $this->integer()->null(),
            'completed_id' => $this->integer()->null(),
            'creator_id' => $this->integer()->notNull(),
            'updater_id' => $this->integer()->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->null(),
        ]);

        // add foreign key for field `executor_id`
        $this->addForeignKey(
            'task_executor_id=user-id',
            'task',
            'executor_id',
            'user',
            'id'
        );
        // add foreign key for field `creator_id`
        $this->addForeignKey(
            'task_creator_id-user=id',
            'task',
            'creator_id',
            'user',
            'id'
        );
        // add foreign key for field `updater_id`
        $this->addForeignKey(
            'task_updater_id=user-id',
            'task',
            'updater_id',
            'user',
            'id'
        );

    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('task');

        $this->dropForeignKey('task_executor_id=user-id', 'task');
        $this->dropForeignKey('task_creator_id-user=id', 'task');
        $this->dropForeignKey('task_updater_id=user-id', 'task');

        return true;
    }
}
