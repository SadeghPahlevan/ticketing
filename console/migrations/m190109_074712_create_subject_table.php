<?php

use yii\db\Migration;

/**
 * Handles the creation of table `subject`.
 */
class m190109_074712_create_subject_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('subject', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'status' => $this->boolean()->defaultValue(1)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('subject');
    }
}
