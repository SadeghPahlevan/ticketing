<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ticket`.
 * Has foreign keys to the tables:
 *
 * - `stream`
 * - `media`
 */
class m190109_074854_create_ticket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ticket', [
            'id' => $this->primaryKey(),
            'stream_id' => $this->integer()->notNull(),
            'media_id' => $this->integer(),
            'user_type' => $this->boolean()->notNull(),
            'response' => $this->text()->notNull(),
            'created_at' => $this->timestamp(),
        ]);

        // creates index for column `stream_id`
        $this->createIndex(
            'idx-ticket-stream_id',
            'ticket',
            'stream_id'
        );

        // add foreign key for table `stream`
        $this->addForeignKey(
            'fk-ticket-stream_id',
            'ticket',
            'stream_id',
            'stream',
            'id',
            'CASCADE'
        );

        // creates index for column `media_id`
        $this->createIndex(
            'idx-ticket-media_id',
            'ticket',
            'media_id'
        );

        // add foreign key for table `media`
        $this->addForeignKey(
            'fk-ticket-media_id',
            'ticket',
            'media_id',
            'media',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `stream`
        $this->dropForeignKey(
            'fk-ticket-stream_id',
            'ticket'
        );

        // drops index for column `stream_id`
        $this->dropIndex(
            'idx-ticket-stream_id',
            'ticket'
        );

        // drops foreign key for table `media`
        $this->dropForeignKey(
            'fk-ticket-media_id',
            'ticket'
        );

        // drops index for column `media_id`
        $this->dropIndex(
            'idx-ticket-media_id',
            'ticket'
        );

        $this->dropTable('ticket');
    }
}
