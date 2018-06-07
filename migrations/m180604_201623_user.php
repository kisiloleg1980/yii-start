<?php

use yii\db\Migration;

/**
 * Class m180604_201623_user
 */
class m180604_201623_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username'=>$this->string(30)->notNull(),
            'email'=>$this->string(30)->notNull()->unique(),
            'password'=>$this->string(255),
            'status'=>$this->integer(),
            'active_hex'=>$this->string(255)

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180604_201623_user cannot be reverted.\n";

        return false;
    }
    */
}
