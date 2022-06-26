<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%social_network}}`.
 */
class m220525_134425_create_social_network_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%social_network}}', [
            'id' => $this->primaryKey(),
            'url_name' => $this->string(255),
            'icon_code' => $this->string(255),
            'status' => $this->boolean()->defaultValue(false),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%social_network}}');
    }
}
