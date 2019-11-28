<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m191121_102647_create_table_fk
 */
class m191121_102647_create_table_fk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk_7', 
            'transaksi_masuk', 'id_vendor', 
            'vendor', 'id', 
            'restrict', 'cascade');
    
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_7', 'transaksi_masuk');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191121_102647_create_table_fk cannot be reverted.\n";

        return false;
    }
    */
}
