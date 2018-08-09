<?php

use yii\db\Migration;

/**
 * Class m180809_200411_insert_usd_rate
 */
class m180809_200411_insert_usd_rate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%rates}}', [
            'currency' => 'USD',
            'rate' => 1,
            'rate_date' => '2018-08-01',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180809_200411_insert_usd_rate cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180809_200411_insert_usd_rate cannot be reverted.\n";

        return false;
    }
    */
}
