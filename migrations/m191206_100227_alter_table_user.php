<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m191206_100227_alter_table_user
 */
class m191206_100227_alter_table_user extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->addColumn('user', 'password_old', $this->string()->notNull());        
        $this->addColumn('user', 'password_new', $this->string()->notNull());               
        $this->addColumn('user', 'password_repeat', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropColumn('password_old');
        $this->dropColumn('password_new');
        $this->dropColumn('password_repeat');
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m191206_100227_alter_table_user cannot be reverted.\n";

      return false;
      }
     */
}
