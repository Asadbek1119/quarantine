<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%symbols}}`.
 */
class m220623_134256_create_symbols_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%symbols}}', [
            'id' => $this->primaryKey(),
            'img' => $this->string(),
            'music' => $this->string(),
            'slug' => $this->string(),
            'status' => $this->boolean()->defaultValue(false),
        ]);
        $this->createTable('{{%symbols_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'title' => $this->string(),
            'content' => $this->text(),
        ]);

        $this->addForeignKey('fk_symbols_symbols_lang_relation', '{{%symbols_lang}}', 'owner_id', '{{%symbols}}', 'id', 'CASCADE', 'CASCADE');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_symbols_symbols_lang_relation', '{{%symbols_lang}}');
        $this->dropTable('{{%symbols_lang}}');
        $this->dropTable('{{%symbols}}');
    }
}
