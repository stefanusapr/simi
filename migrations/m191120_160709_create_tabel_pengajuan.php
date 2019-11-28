<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m191120_160709_create_tabel_pengajuan
 */
class m191120_160709_create_tabel_pengajuan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pengajuan', [
            'id' => $this->primaryKey(),
            'tgl_pengajuan' => $this->date(),
            'tgl_spk' => $this->date(),
            'setuju' => $this->boolean(),
            'tgl_persetujuan' => $this->date(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('pengajuan');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191120_160709_create_tabel_pengajuan cannot be reverted.\n";

        return false;
    }
    */
}
