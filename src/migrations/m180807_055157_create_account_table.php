<?php

use yii\db\Migration;

/**
 * Handles the creation of table `account`.
 */
class m180807_055157_create_account_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%account}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->bigInteger()->notNull(),
            'currency' => $this->string(3)->notNull(),
            'sum' => $this->float(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('account');
    }
}
