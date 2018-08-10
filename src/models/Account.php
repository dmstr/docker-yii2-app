<?php

namespace app\models;

use app\validators\CurrencyValidator;

/**
 * This is the model class for table "account".
 *
 * @property int $id
 * @property int $user_id
 * @property string $currency
 * @property double $sum
 *
 * @property User $user
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'currency'], 'required'],
            [['user_id'], 'default', 'value' => null],
            [['user_id'], 'integer'],
            [['sum'], 'number'],
            [['currency'], 'string', 'max' => 3],
            ['currency', CurrencyValidator::class],
            [
                ['user_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['user_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'currency' => 'Currency',
            'sum' => 'Sum',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
