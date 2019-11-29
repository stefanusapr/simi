<?php

use yii\db\Migration;

/**
 * Class m191129_013731_alter_tabel_transaksi_masuk_detail
 */
class m191129_013731_alter_tabel_transaksi_masuk_detail extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('transaksi_masuk_detail', 'harga_satuan', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('harga_satuan');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191129_013731_alter_tabel_transaksi_masuk_detail cannot be reverted.\n";

        return false;
    }
    */
}
