<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m191120_153010_create_table_transaksi_masuk
 */
class m191120_153010_create_table_transaksi_masuk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('transaksi_masuk', [
            'id' => $this->primaryKey(),
            'tgl_spk' => $this->date(),
            'tgl_masuk' => $this->date()->notNull(),
            'id_vendor' => $this->integer()->notNull(),
            'no_faktur' => $this->string(),
            'tgl_faktur' => $this->date(),
            'no_berita_acara' => $this->string(),
            'tgl_berita_acara' => $this->date(),
            'no_pemeriksaan' => $this->string(),
            'tgl_pemeriksaan' => $this->date(),
            'keterangan' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('transaksi_masuk');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191120_153010_create_table_transaksi_masuk cannot be reverted.\n";

        return false;
    }
    */
}
