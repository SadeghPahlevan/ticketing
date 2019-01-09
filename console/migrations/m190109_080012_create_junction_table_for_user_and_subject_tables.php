<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_subject`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `subject`
 */
class m190109_080012_create_junction_table_for_user_and_subject_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_subject', [
            'user_id' => $this->integer(),
            'subject_id' => $this->integer(),
            'created_at' => $this->dateTime(),
            'PRIMARY KEY(user_id, subject_id)',
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_subject-user_id',
            'user_subject',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user_subject-user_id',
            'user_subject',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `subject_id`
        $this->createIndex(
            'idx-user_subject-subject_id',
            'user_subject',
            'subject_id'
        );

        // add foreign key for table `subject`
        $this->addForeignKey(
            'fk-user_subject-subject_id',
            'user_subject',
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
            'fk-user_subject-user_id',
            'user_subject'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-user_subject-user_id',
            'user_subject'
        );

        // drops foreign key for table `subject`
        $this->dropForeignKey(
            'fk-user_subject-subject_id',
            'user_subject'
        );

        // drops index for column `subject_id`
        $this->dropIndex(
            'idx-user_subject-subject_id',
            'user_subject'
        );

        $this->dropTable('user_subject');
    }
}
