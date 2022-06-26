<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m220617_102346_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'img' => $this->string(),
            'slug' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'post_category_id' => $this->integer(),
            'status' => $this->boolean()->defaultValue(true),
        ]);
        $this->createTable('{{%post_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'title' => $this->string(),
            'content' => $this->text(),
        ]);

        $this->addForeignKey('fk_post_post_lang_relation', '{{%post_lang}}', 'owner_id', '{{%post}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_post_post_category_relation', '{{%post}}', 'post_category_id', '{{%post_category}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_post_post_category_relation', '{{%post}}');
        $this->dropForeignKey('fk_post_post_lang_relation', '{{%post_lang}}');
        $this->dropTable('{{%post_lang}}');
        $this->dropTable('{{%post}}');
    }
}
