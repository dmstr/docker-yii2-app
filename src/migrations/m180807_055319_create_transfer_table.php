<?php

use yii\db\Migration;

/**
 * Handles the creation of table `transfer`.
 */
class m180807_055319_create_transfer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transfer}}', [
            'id' => $this->primaryKey(),
            'sender_id' => $this->bigInteger()->null(),
            'receiver_id' => $this->bigInteger()->notNull(),
            'transfer_currency_id' => $this->bigInteger()->null(),
            'sum' => $this->bigInteger()->null(),
            'transfer_type' => $this->integer()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable('transfer');
    }
}
