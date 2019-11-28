<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m191120_163040_create_tabel_fk
 */
class m191120_163040_create_tabel_fk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    $this->addForeignKey(
        'fk_1', 
        'transaksi_masuk_detail', 'id_barang', 
        'barang', 'id', 
        'restrict', 'cascade');

    $this->addForeignKey(
        'fk_2', 
        'transaksi_masuk_detail', 'id_transaksi_masuk', 
        'transaksi_masuk', 'id', 
        'restrict', 'cascade');

    $this->addForeignKey(
        'fk_3', 
        'transaksi_keluar_detail', 'id_barang', 
        'barang', 'id', 
        'restrict', 'cascade');

    $this->addForeignKey(
        'fk_4', 
        'transaksi_keluar_detail', 'id_transaksi_keluar', 
        'transaksi_keluar', 'id', 
        'restrict', 'cascade');

    $this->addForeignKey(
        'fk_5', 
        'pengajuan_barang', 'id_barang', 
        'barang', 'id', 
        'restrict', 'cascade');

    $this->addForeignKey(
        'fk_6', 
        'pengajuan_barang', 'id_pengajuan', 
        'pengajuan', 'id', 
        'restrict', 'cascade'); 
    
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191120_163040_create_tabel_fk cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191120_163040_create_tabel_fk cannot be reverted.\n";

        return false;
    }
    */
}
