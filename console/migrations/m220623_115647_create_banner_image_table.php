<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%banner_image}}`.
 */
class m220623_115647_create_banner_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%banner_image}}', [
            'id' => $this->primaryKey(),
            'img' => $this->string(),
            'status' => $this->boolean()->defaultValue(false)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%banner_image}}');
    }
}
