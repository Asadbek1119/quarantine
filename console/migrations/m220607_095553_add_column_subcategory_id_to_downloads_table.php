<?php

use yii\db\Migration;

/**
 * Class m220607_095553_add_column_subcategory_id_to_downloads_table
 */
class m220607_095553_add_column_subcategory_id_to_downloads_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%downloads}}','subcategory_id', $this->integer());

        $this->addForeignKey('fk-downloads_subcategory_id','{{%downloads}}','subcategory_id','{{%subcategory}}','id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-downloads_subcategory_id','{{%downloads}}');
        $this->dropColumn('{{%downloads}}','subcategory_id');
    }
}
