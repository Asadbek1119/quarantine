<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%info}}`.
 */
class m220603_093402_create_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%info}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'status' => $this->boolean()->defaultValue(false),
        ]);

        $this->createTable('{{%info_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'title' => $this->string(),
            'content' => $this->text(),
        ]);

        $this->addForeignKey(
            'fk-info_lang-owner_id',
            '{{%info_lang}}',
            'owner_id',
            '{{%info}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-info_lang-owner_id', '{{%info_lang}}');
        $this->dropTable('{{%info_lang}}');
        $this->dropTable('{{%info}}');
    }
}
