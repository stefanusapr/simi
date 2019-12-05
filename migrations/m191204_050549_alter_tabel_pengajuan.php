<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m191204_050549_alter_tabel_pengajuan
 */
class m191204_050549_alter_tabel_pengajuan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $this->renameColumn('pengajuan', 'setuju', 'status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         $this->dropColumn('pengajuan', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191204_050549_alter_tabel_pengajuan cannot be reverted.\n";

        return false;
    }
    */
}
