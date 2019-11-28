<?php

use yii\db\Migration;
use yii\db\Schema;


/**
 * Class m191121_101045_create_tabel_vendor
 */
class m191121_101045_create_tabel_vendor extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('vendor', [
            'id' => $this->primaryKey(),
            'nama' => $this->string()->notNull(),
            'alamat' => $this->text(),
            'no_hp' => $this->string()->notNull(),
            'email' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('vendor');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191121_101045_create_tabel_vendor cannot be reverted.\n";

        return false;
    }
    */
}
