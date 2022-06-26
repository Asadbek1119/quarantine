<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%region_leader}}`.
 */
class m220610_064157_create_region_leader_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%region_leader}}', [
            'id' => $this->primaryKey(),
            'img' => $this->string(),
            'name' => $this->string(),
            'phone' => $this->string(),
            'fax' => $this->string(),
            'email' => $this->string(),
            'region_id' => $this->integer(),
            'status' => $this->boolean()->defaultValue(false)
        ]);
        $this->createTable('{{%region_leader_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'title' => $this->string(),
            'work_day' => $this->string(),
        ]);

        $this->addForeignKey('fk_region_leader_region_id', '{{%region_leader}}', 'region_id', '{{%region}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_region_leader_region_lang_relation', '{{%region_leader_lang}}', 'owner_id', '{{%region_leader}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_region_leader_region_id', '{{%region_leader}}');
        $this->dropForeignKey('fk_region_leader_region_lang_relation', '{{%region_leader_lang}}');
        $this->dropTable('{{%region_leader_lang}}');
        $this->dropTable('{{%region_leader}}');
    }
}
