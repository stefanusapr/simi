<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m191120_080955_create_table_barang
 */
class m191120_080955_create_table_barang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('barang', [
            'id' => $this->primaryKey(),
            'nama' => $this->string()->notNull(),
            'stok' => $this->integer()->notNull()->defaultValue(0),
            'merk' => $this->string()->notNull(),
            'jenis' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('barang');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191120_080955_create_table_barang cannot be reverted.\n";

        return false;
    }
    */
}
