<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m191120_155411_create_tabel_transaksi_keluar
 */
class m191120_155411_create_tabel_transaksi_keluar extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('transaksi_keluar', [
            'id' => $this->primaryKey(),
            'tgl_keluar' => $this->date()->notNull(),
            'tgl_surat' => $this->date(),
            'nama_penerima' => $this->string(),
            'keterangan' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('transaksi_keluar');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191120_155411_create_tabel_transaksi_keluar cannot be reverted.\n";

        return false;
    }
    */
}
