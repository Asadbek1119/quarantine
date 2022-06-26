<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%leader}}`.
 */
class m220608_095228_create_leader_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%leader}}', [
            'id' => $this->primaryKey(),
            'img' => $this->string(),
            'name' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'leader_category_id' => $this->integer(),
            'status' => $this->boolean()->defaultValue(false)
        ]);
        $this->createTable('{{%leader_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'position' => $this->string(),
            'work_day' => $this->string(),
            'biography' => $this->text(),
        ]);

        $this->addForeignKey('fk_leader_leader_category_relation', '{{%leader}}', 'leader_category_id', '{{%leader_category}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_leader_leader_lang_relation', '{{%leader_lang}}', 'owner_id', '{{%leader}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_leader_leader_category_relation', '{{%leader}}');
        $this->dropColumn('{{%leader}}', 'leader_category_id');
        $this->dropForeignKey('fk_leader_leader_lang_relation', '{{%leader_lang}}');
        $this->dropTable('{{%leader_lang}}');
        $this->dropTable('{{%leader}}');
    }
}
