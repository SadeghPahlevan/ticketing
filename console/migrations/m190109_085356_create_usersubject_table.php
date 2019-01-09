<?php

use yii\db\Migration;

/**
 * Handles the creation of table `usersubject`.
 * Has foreign keys to the tables:
 *
 * - `subject`
 * - `user`
 */
class m190109_085356_create_usersubject_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('usersubject', [
            'id' => $this->primaryKey(),
            'subject_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `subject_id`
        $this->createIndex(
            'idx-usersubject-subject_id',
            'usersubject',
            'subject_id'
        );

        // add foreign key for table `subject`
        $this->addForeignKey(
            'fk-usersubject-subject_id',
            'usersubject',
            'subject_id',
            'subject',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-usersubject-user_id',
            'usersubject',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-usersubject-user_id',
            'usersubject',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `subject`
        $this->dropForeignKey(
            'fk-usersubject-subject_id',
            'usersubject'
        );

        // drops index for column `subject_id`
        $this->dropIndex(
            'idx-usersubject-subject_id',
            'usersubject'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-usersubject-user_id',
            'usersubject'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-usersubject-user_id',
            'usersubject'
        );

        $this->dropTable('usersubject');
    }
}
