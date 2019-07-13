<?php

use yii\db\Migration;

/**
 * Class m190712_183151_create_table_project
 */
class m190712_183151_create_table_project extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('project', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'active' => $this->boolean()->notNull()->defaultValue('0'),
            'creator_id' => $this->integer()->notNull(),
            'updater_id' => $this->integer()->null(),
            'created_at' => $this->integer()->null(),
            'updated_at' => $this->integer()->null()
        ]);

        // add foreign key for field `creator_id`
        $this->addForeignKey(
            'project-creator_id=user-id',
            'project',
            'creator_id',
            'user',
            'id'
        );
        // add foreign key for field `updater_id`
        $this->addForeignKey(
            'project-updater_id=user-id',
            'project',
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
        $this->dropTable('project');

        $this->dropForeignKey('project-creator_id=user-id', 'project');
        $this->dropForeignKey('project-updater_id=user-id', 'project');

        return true;
    }
}
