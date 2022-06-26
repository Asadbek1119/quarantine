<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contact_data}}`.
 */
class m220527_102738_create_contact_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contact_data}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string(),
            'phone_first' => $this->string(),
            'phone_second' => $this->string(),
            'lunch_time' => $this->string(),
            'download' => $this->string(),
        ]);

        $this->createTable('{{%contact_data_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'language' => $this->string(6),
            'address' => $this->string(),
            'destination' => $this->string(),
            'work_time' => $this->string(),
            'bank_detail' => $this->text(),
        ]);

        $this->addForeignKey(
            'fk-contact_data_relation',
            '{{%contact_data_lang}}',
            'owner_id',
            '{{%contact_data}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-contact_data_relation', '{{%contact_data_lang}}');
        $this->dropTable('{{%contact_data_lang}}');
        $this->dropTable('{{%contact_data}}');
    }
}
