<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m191120_160723_create_tabel_barang_pengajuan
 */
class m191120_160723_create_tabel_barang_pengajuan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pengajuan_barang', [
            'id' => $this->primaryKey(),
            'id_barang' => $this->integer()->notNull(),
            'id_pengajuan' => $this->integer()->notNull(),
            'jumlah' => $this->integer()->notNull(),
            'harga_satuan' => $this->integer()->notNull(),
            'status' => $this->boolean(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('pengajuan_barang');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191120_160723_create_tabel_barang_pengajuan cannot be reverted.\n";

        return false;
    }
    */
}
