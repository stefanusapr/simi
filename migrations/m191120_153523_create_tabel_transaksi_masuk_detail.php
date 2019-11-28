<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m191120_153523_create_tabel_transaksi_masuk_detail
 */
class m191120_153523_create_tabel_transaksi_masuk_detail extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('transaksi_masuk_detail', [
            'id' => $this->primaryKey(),
            'id_barang' => $this->integer()->notNull(),
            'id_transaksi_masuk' => $this->integer()->notNull(),
            'thn_produksi' => $this->string(),
            'jumlah' => $this->integer()->notNull(),
            'keterangan' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('transaksi_masuk_detail');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191120_153523_create_tabel_transaksi_masuk_detail cannot be reverted.\n";

        return false;
    }
    */
}
