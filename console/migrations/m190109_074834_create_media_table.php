<?php

use yii\db\Migration;

/**
 * Handles the creation of table `media`.
 */
class m190109_074834_create_media_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('media', [
            'id' => $this->primaryKey(),
            'type' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('media');
    }
}
