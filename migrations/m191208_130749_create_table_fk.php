<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m191208_130749_create_table_fk
 */
class m191208_130749_create_table_fk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk_8', 
            'kirim_pesan', 'id_vendor', 
            'vendor', 'id', 
            'restrict', 'cascade');
    
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_8', 'kirim_pesan');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191208_130749_create_table_fk cannot be reverted.\n";

        return false;
    }
    */
}
