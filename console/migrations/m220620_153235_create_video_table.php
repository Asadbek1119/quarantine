<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%video}}`.
 */
class m220620_153235_create_video_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%video}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(),
            'video_url' => $this->text(),
            'video_content' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'status' => $this->boolean()->defaultValue(false),
        ]);
        $this->createTable('{{%video_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'name' => $this->string(),
        ]);

        $this->addForeignKey('fk_video_video_lang_relation', '{{%video_lang}}', 'owner_id', '{{%video}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_video_video_lang_relation', '{{%video_lang}}');
        $this->dropTable('{{%video_lang}}');
        $this->dropTable('{{%video}}');
    }
}
