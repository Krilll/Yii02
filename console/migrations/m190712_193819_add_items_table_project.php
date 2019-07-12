<?php

use yii\db\Migration;

/**
 * Class m190712_193819_add_items_table_project
 */
class m190712_193819_add_items_table_project extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('project', [
            'title' => 'Fake',
            'description' => 'Curabitur euismod ultricies nibh, sit amet hendrerit libero.',
            'creator_id' => 1,
        ]);

        $this->insert('project', [
            'title' => 'Hello',
            'description' => 'Ut rhoncus magna nec faucibus finibus.',
            'creator_id' => 1,
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('project',['id' => '1']);
        $this->delete('project',['id' => '2']);

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190712_193819_add_items_table_project cannot be reverted.\n";

        return false;
    }
    */
}
