<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transfer".
 *
 * @property int $id
 * @property int $sender_id
 * @property int $receiver_id
 * @property string $transfer_currency
 * @property int $sum
 * @property int $transfer_type
 *
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
            [['sender_id', 'receiver_id', 'transfer_currency'], 'required'],
            [['sender_id', 'receiver_id', 'sum', 'transfer_type'], 'default', 'value' => null],
            [['sender_id', 'receiver_id', 'sum', 'transfer_type'], 'integer'],
            [['transfer_currency'], 'string', 'max' => 3],
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
            'transfer_currency' => 'Transfer Currency',
            'sum' => 'Sum',
            'transfer_type' => 'Transfer Type',
        ];
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
