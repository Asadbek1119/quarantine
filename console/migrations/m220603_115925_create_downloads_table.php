<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%downloads}}`.
 */
class m220603_115925_create_downloads_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%downloads}}', [
            'id' => $this->primaryKey(),
            'file_icon' => $this->string(),
            'file_download' => $this->string(),
            'status' => $this->boolean()->defaultValue(false),
        ]);
        $this->createTable('{{%downloads_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'file_name' => $this->string(255),
        ]);

        $this->addForeignKey(
            'fk_downloads_lang_downloads',
            '{{%downloads_lang}}',
            'owner_id',
            '{{%downloads}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_downloads_lang_downloads', '{{%downloads_lang}}');
        $this->dropTable('{{%downloads_lang}}');
        $this->dropTable('{{%downloads}}');
    }
}
