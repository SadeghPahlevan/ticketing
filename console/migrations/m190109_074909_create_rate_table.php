<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rate`.
 * Has foreign keys to the tables:
 *
 * - `stream`
 */
class m190109_074909_create_rate_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('rate', [
            'id' => $this->primaryKey(),
            'stream_id' => $this->integer()->notNull(),
            'text' => $this->text(),
            'rate' => $this->integer()->notNull(),
        ]);

        // creates index for column `stream_id`
        $this->createIndex(
            'idx-rate-stream_id',
            'rate',
            'stream_id'
        );

        // add foreign key for table `stream`
        $this->addForeignKey(
            'fk-rate-stream_id',
            'rate',
            'stream_id',
            'stream',
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
            'fk-rate-stream_id',
            'rate'
        );

        // drops index for column `stream_id`
        $this->dropIndex(
            'idx-rate-stream_id',
            'rate'
        );

        $this->dropTable('rate');
    }
}
