<?php

use yii\db\Migration;

/**
 * Class m191122_044026_alter_table_barang
 */
class m191122_044026_alter_table_barang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('barang', 'kode_barang', $this->string()->notNull()->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('kode_barang');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191122_044026_alter_table_barang cannot be reverted.\n";

        return false;
    }
    */
}
