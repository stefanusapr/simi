<?php

use yii\db\Migration;

/**
 * Class m191129_043209_alter_tabel_barang_pengajuan
 */
class m191129_043209_alter_tabel_barang_pengajuan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pengajuan_barang', 'keterangan', $this->text());
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
        echo "m191129_043209_alter_tabel_barang_pengajuan cannot be reverted.\n";

        return false;
    }
    */
}
