<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m191122_025917_create_table_jenis_barang
 */
class m191122_025917_create_table_jenis_barang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('jenis_barang', [
            'id' => $this->primaryKey(),
            'nama' => $this->string(),
        ]);

        // default data
    $this->insert('jenis_barang', [
        'id' => 1,
        'nama' => 'Barang Habis Pakai',
    ]);
    $this->insert('jenis_barang', [
        'id' => 2,
        'nama' => 'Barang Tidak Habis Pakai',
    ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('jenis_barang');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191122_025917_create_table_jenis_barang cannot be reverted.\n";

        return false;
    }
    */
}
