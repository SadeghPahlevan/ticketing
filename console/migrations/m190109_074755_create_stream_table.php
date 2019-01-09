<?php

use yii\db\Migration;

/**
 * Handles the creation of table `stream`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `subject`
 */
class m190109_074755_create_stream_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('stream', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'subject_id' => $this->integer()->notNull(),
            'priority' => $this->integer()->notNull(),
            'status' => $this->integer()->defaultValue(1)->notNull(),
            'created_at' => $this->timestamp(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-stream-user_id',
            'stream',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-stream-user_id',
            'stream',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `subject_id`
        $this->createIndex(
            'idx-stream-subject_id',
            'stream',
            'subject_id'
        );

        // add foreign key for table `subject`
        $this->addForeignKey(
            'fk-stream-subject_id',
            'stream',
            'subject_id',
            'subject',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-stream-user_id',
            'stream'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-stream-user_id',
            'stream'
        );

        // drops foreign key for table `subject`
        $this->dropForeignKey(
            'fk-stream-subject_id',
            'stream'
        );

        // drops index for column `subject_id`
        $this->dropIndex(
            'idx-stream-subject_id',
            'stream'
        );

        $this->dropTable('stream');
    }
}
