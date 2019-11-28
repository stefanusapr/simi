<?php

use yii\db\Migration;

/**
 * Class m191128_134937_alter_tabel_transaksi_keluar_detail
 */
class m191128_134937_alter_tabel_transaksi_keluar_detail extends Migration
{
    /**
     * {@inheritdoc}
     */
     public function safeUp()
    {
        $this->addColumn('transaksi_keluar_detail', 'tgl_kembali', $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tgl_kembali');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191128_134937_alter_tabel_transaksi_keluar_detail cannot be reverted.\n";

        return false;
    }
    */
}
