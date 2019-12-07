<?php

use yii\db\Migration;

/**
 * Class m191206_104621_alter_tabel_vendor
 */
class m191206_104621_alter_tabel_vendor extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('vendor', 'keterangan', $this->text());
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
        echo "m191206_104621_alter_tabel_vendor cannot be reverted.\n";

        return false;
    }
    */
}
