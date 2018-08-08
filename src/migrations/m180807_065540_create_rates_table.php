<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rates`.
 */
class m180807_065540_create_rates_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rates}}', [
            'id' => $this->primaryKey(),
            'currency_id' => $this->bigInteger()->notNull(),
            'rate' => $this->integer()->notNull(),
            'rate_date' => $this->timestamp()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('rates');
    }
}
