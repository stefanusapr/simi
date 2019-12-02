<?php

use yii\db\Migration;

/**
 * Class m191202_061905_alter_table_user
 */
class m191202_061905_alter_table_user extends Migration
{
    /**
     * {@inheritdoc}
     */
     public function safeUp()
    {
        $this->addColumn('users', 'role', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('role');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191202_061905_alter_table_user cannot be reverted.\n";

        return false;
    }
    */
}
