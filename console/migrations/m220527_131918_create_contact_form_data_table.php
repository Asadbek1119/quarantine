<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contact_form_data}}`.
 */
class m220527_131918_create_contact_form_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contact_form_data}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(50),
            'email' => $this->string(),
            'phone' => $this->string(50),
            'message' => $this->text(),
            'created_at' => $this->string(100),
            'status' => $this->boolean()->defaultValue(false)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contact_form_data}}');
    }
}
