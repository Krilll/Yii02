<?php

use yii\db\Migration;

/**
 * Class m190628_102356_create_table_task
 */
class m190628_102356_create_table_task extends Migration
{
    /**
     * {@inheritdoc}
     */
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'active' => $this->boolean()->notNull()->defaultValue('0'),
            'creator_id' => $this->integer()->notNull(),
            'updater_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
        ]);


        // add foreign key for field `creator_id`
        $this->addForeignKey(
            't-task-creator_id=user-id',
            'task',
            'creator_id',
            'user',
            'id'
        );
        // add foreign key for field `updater_id`
        $this->addForeignKey(
            't-task-updater_id=user-id',
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

        $this->dropForeignKey('t-task-creator_id=user-id', 'task');
        $this->dropForeignKey('t-task-updater_id=user-id', 'task');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190628_102356_create_table_task cannot be reverted.\n";

        return false;
    }
    */
}
