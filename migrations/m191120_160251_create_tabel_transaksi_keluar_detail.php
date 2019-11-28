<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m191120_160251_create_tabel_transaksi_keluar_detail
 */
class m191120_160251_create_tabel_transaksi_keluar_detail extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('transaksi_keluar_detail', [
            'id' => $this->primaryKey(),
            'id_barang' => $this->integer()->notNull(),
            'id_transaksi_keluar' => $this->integer()->notNull(),
            'jumlah' => $this->integer()->notNull(),
            'keterangan' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('transaksi_keluar_detail');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191120_160251_create_tabel_transaksi_keluar_detail cannot be reverted.\n";

        return false;
    }
    */
}
