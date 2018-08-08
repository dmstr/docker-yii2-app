<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transfer".
 *
 * @property int $id
 * @property int $sender_id
 * @property int $receiver_id
 * @property int $transfer_currency_id
 * @property int $sum
 * @property int $transfer_type
 *
 * @property Currency $transferCurrency
 * @property User $sender
 * @property User $receiver
 */
class Transfer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transfer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sender_id', 'receiver_id', 'transfer_currency_id', 'sum', 'transfer_type'], 'default', 'value' => null],
            [['sender_id', 'receiver_id', 'transfer_currency_id', 'sum', 'transfer_type'], 'integer'],
            [['receiver_id'], 'required'],
            [['transfer_currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['transfer_currency_id' => 'id']],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sender_id' => 'id']],
            [['receiver_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['receiver_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sender_id' => 'Sender ID',
            'receiver_id' => 'Receiver ID',
            'transfer_currency_id' => 'Transfer Currency ID',
            'sum' => 'Sum',
            'transfer_type' => 'Transfer Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransferCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'transfer_currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(User::className(), ['id' => 'sender_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver()
    {
        return $this->hasOne(User::className(), ['id' => 'receiver_id']);
    }
}
