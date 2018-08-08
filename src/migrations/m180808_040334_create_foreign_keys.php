<?php

use yii\db\Migration;

/**
 * Class m180808_040334_create_foreign_keys
 */
class m180808_040334_create_foreign_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk_account_user_id',
            '{{%account}}',
            'user_id',
            '{{%user}}',
            'id'
        );
        $this->addForeignKey(
            'fk_account_currency_id',
            '{{%account}}',
            'currency_id',
            '{{%currency}}',
            'id'
        );
        $this->addForeignKey(
            'fk_transfer_sender_id',
            '{{%transfer}}',
            'sender_id',
            '{{%user}}',
            'id'
        );
        $this->addForeignKey(
            'fk_transfer_receiver_id',
            '{{%transfer}}',
            'receiver_id',
            '{{%user}}',
            'id'
        );
        $this->addForeignKey(
            'fk_transfer_transfer_currency_id',
            '{{%transfer}}',
            'transfer_currency_id',
            '{{%currency}}',
            'id'
        );
        $this->addForeignKey(
            'fk_rates_currency_id',
            '{{%rates}}',
            'currency_id',
            '{{%currency}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_account_user_id', '{{%account}}');
        $this->dropForeignKey('fk_account_currency_id', '{{%account}}');
        $this->dropForeignKey('fk_transfer_sender_id', '{{%transfer}}');
        $this->dropForeignKey('fk_transfer_receiver_id', '{{%transfer}}');
        $this->dropForeignKey('fk_transfer_sender_currency_id', '{{%transfer}}');
        $this->dropForeignKey('fk_transfer_transfer_currency_id', '{{%transfer}}');
        $this->dropForeignKey('fk_rates_currency_id', '{{%rates}}');

        echo "m180808_040334_create_foreign_keys cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180808_040334_create_foreign_keys cannot be reverted.\n";

        return false;
    }
    */
}
