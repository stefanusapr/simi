<?php

use yii\db\Migration;

/**
 * Class m191207_132443_alter_table_vendor
 */
class m191207_132443_alter_table_vendor extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('vendor', 'judul', $this->text());
        $this->addColumn('vendor', 'isi', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('judul');
        $this->dropColumn('isi');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191207_132443_alter_table_vendor cannot be reverted.\n";

        return false;
    }
    */
}
