<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m191206_103720_alter_table_barang
 */
class m191206_103720_alter_table_barang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('barang', 'keterangan', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('keterangan');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191206_103720_alter_table_barang cannot be reverted.\n";

        return false;
    }
    */
}
