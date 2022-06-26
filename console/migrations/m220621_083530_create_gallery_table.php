<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%gallery}}`.
 */
class m220621_083530_create_gallery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%gallery}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'status' => $this->boolean()->defaultValue(false),
        ]);
        $this->createTable('{{%gallery_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'title' => $this->string(),
        ]);
        $this->addForeignKey(
            'fk-gallery_lang-owner_id',
            'gallery_lang',
            'owner_id',
            'gallery',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-gallery_lang-owner_id', 'gallery_lang');
        $this->dropTable('{{%gallery_lang}}');
        $this->dropTable('{{%gallery}}');
    }
}
