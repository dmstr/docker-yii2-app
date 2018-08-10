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
            'sender_id' => $this->bigInteger()->notNull(),
            'receiver_id' => $this->bigInteger()->notNull(),
            'transfer_currency' => $this->string(3)->notNull(),
            'transfer_sum' => $this->float()->null(),
            'sum_receiver' => $this->float()->null(),
            'sum_sender' => $this->float()->null(),
            'sum_usd' => $this->float()->null(),
            'transfer_type' => $this->integer()->null(),
            'created_at' => $this->timestamp()->notNull()->defaultValue('NOW')
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
