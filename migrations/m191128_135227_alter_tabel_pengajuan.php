<?php

use yii\db\Migration;

/**
 * Class m191128_135227_alter_tabel_pengajuan
 */
class m191128_135227_alter_tabel_pengajuan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pengajuan', 'keterangan', $this->text());
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
        echo "m191128_135227_alter_tabel_pengajuan cannot be reverted.\n";

        return false;
    }
    */
}
