<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%leader_category}}`.
 */
class m220608_090907_create_leader_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%leader_category}}', [
                'id' => $this->primaryKey(),
                'slug' => $this->string(),
                'status' => $this->boolean()->defaultValue(false),
        ]);
        $this->createTable('{{%leader_category_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'name' => $this->string(),
        ]);

        $this->addForeignKey('fk_leader_category_lang_leader_category', '{{%leader_category_lang}}', 'owner_id', '{{%leader_category}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_leader_category_lang_leader_category', '{{%leader_category_lang}}');
        $this->dropTable('{{%leader_category_lang}}');
        $this->dropTable('{{%leader_category}}');
    }
}
