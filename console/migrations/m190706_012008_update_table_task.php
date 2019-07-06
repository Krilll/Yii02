<?php

use yii\db\Migration;

/**
 * Class m190706_012008_update_table_task
 */
class m190706_012008_update_table_task extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('task', 'deadline', $this->integer()->null());
        $this->addColumn('task', 'status', $this->text()->null());

        $this->dropColumn('task', 'started_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('task', 'deadline');
        $this->dropColumn('task', 'status');

        $this->addColumn('task', 'started_id', $this->integer()->null());

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    */
}
