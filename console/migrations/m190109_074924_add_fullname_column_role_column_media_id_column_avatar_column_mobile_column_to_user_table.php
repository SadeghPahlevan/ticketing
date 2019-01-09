<?php

use yii\db\Migration;

/**
 * Handles adding fullname_column_role_column_media_id_column_avatar_column_mobile to table `user`.
 * Has foreign keys to the tables:
 *
 * - `media`
 */
class m190109_074924_add_fullname_column_role_column_media_id_column_avatar_column_mobile_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'fullname', $this->string());
        $this->addColumn('user', 'role', $this->integer()->notNull()->defaultValue(3));
        $this->addColumn('user', 'media_id', $this->integer());
        $this->addColumn('user', 'avatar', $this->text());
        $this->addColumn('user', 'mobile', $this->integer(11));

        // creates index for column `media_id`
        $this->createIndex(
            'idx-user-media_id',
            'user',
            'media_id'
        );

        // add foreign key for table `media`
        $this->addForeignKey(
            'fk-user-media_id',
            'user',
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
        // drops foreign key for table `media`
        $this->dropForeignKey(
            'fk-user-media_id',
            'user'
        );

        // drops index for column `media_id`
        $this->dropIndex(
            'idx-user-media_id',
            'user'
        );

        $this->dropColumn('user', 'fullname');
        $this->dropColumn('user', 'role');
        $this->dropColumn('user', 'media_id');
        $this->dropColumn('user', 'avatar');
        $this->dropColumn('user', 'mobile');
    }
}
