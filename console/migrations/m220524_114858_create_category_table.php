<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m220524_114858_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'status' => $this->boolean()->defaultValue(false),
        ]);

        $this->createTable('{{%category_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'name' => $this->string(),
        ]);

        $this->addForeignKey(
            'fk-category_lang-owner_id',
            '{{%category_lang}}',
            'owner_id',
            '{{%category}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-category_lang-owner_id', '{{%category_lang}}');
        $this->dropTable('{{%category_lang}}');
        $this->dropTable('{{%category}}');
    }
}
