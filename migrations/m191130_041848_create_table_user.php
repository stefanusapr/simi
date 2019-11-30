<?php

use yii\db\Migration;

/**
 * Class m191130_041848_create_table_user
 */
class m191130_041848_create_table_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up() {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'authKey' => $this->string(32)->notNull(),
            'password' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'accessToken' => $this->string(32)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191130_041848_create_table_user cannot be reverted.\n";

        return false;
    }
    */
}
