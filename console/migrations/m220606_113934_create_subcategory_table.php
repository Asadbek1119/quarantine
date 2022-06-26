<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subcategory}}`.
 */
class m220606_113934_create_subcategory_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subcategory}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(),
            'category_id' => $this->integer(),
            'status' => $this->boolean()->defaultValue(false),
        ]);
        $this->createTable('{{%subcategory_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'name' => $this->string(),
        ]);
        $this->addForeignKey('fk_subcategory_category_id_relation', '{{%subcategory}}', 'category_id', '{{%category}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_subcategory_lang_subcategory', '{{%subcategory_lang}}', 'owner_id', '{{%subcategory}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_subcategory_category_id_relation', '{{%subcategory}}');
        $this->dropColumn('{{%subcategory}}', 'category_id');
        $this->dropForeignKey('fk_subcategory_lang_subcategory', '{{%subcategory_lang}}');
        $this->dropTable('{{%subcategory_lang}}');
        $this->dropTable('{{%subcategory}}');
    }
}
