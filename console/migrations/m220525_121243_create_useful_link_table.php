<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%useful_link}}`.
 */
class m220525_121243_create_useful_link_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%useful_link}}', [
            'id' => $this->primaryKey(),
            'url_name' => $this->string(255),
            'status' => $this->boolean()->defaultValue(false),
        ]);

        $this->createTable('{{%useful_link_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'name' => $this->string(),
        ]);

        $this->addForeignKey(
            'fk-useful_link_lang-owner_id',
            '{{%useful_link_lang}}',
            'owner_id',
            '{{%useful_link}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-useful_link_lang-owner_id', '{{%useful_link_lang}}');
        $this->dropTable('{{%useful_link_lang}}');
        $this->dropTable('{{%useful_link}}');
    }
}
