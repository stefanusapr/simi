<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m191208_130420_create_table_kirim_pesan
 */
class m191208_130420_create_table_kirim_pesan extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('kirim_pesan', [
            'id' => $this->primaryKey(),
            'id_vendor' => $this->integer()->notNull(),
            'judul' => $this->text()->notNull(),
            'isi_pesan' => $this->text(),
            'waktu_kirim' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('kirim_pesan');
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m191208_130420_create_table_kirim_pesan cannot be reverted.\n";

      return false;
      }
     */
}
