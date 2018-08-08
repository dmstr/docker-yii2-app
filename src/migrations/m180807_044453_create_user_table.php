<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180807_044453_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(50)->notNull(),
            'country' => $this->string(50)->notNull(),
            'city' => $this->string(50)->notNull(),
        ]);
        //$this->createIndex(
        //    'idx_unique_deployment_session_variables',
        //    '{{%deployment_session_variables}}',
        //    ['session_id', 'key'],
        //    true
        //);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
