<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m191208_131555_alter_table_kirim_pesan
 */
class m191208_131555_alter_table_kirim_pesan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //$this->addColumn('krim_pesan', 'id_vendor', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //$this->dropColumn('id_vendor');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191208_131555_alter_table_kirim_pesan cannot be reverted.\n";

        return false;
    }
    */
}
