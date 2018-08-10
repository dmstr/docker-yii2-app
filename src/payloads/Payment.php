<?php

namespace app\payloads;

use app\models\Account;
use app\validators\CurrencyValidator;
use yii\base\Model;

/**
 * Class Refill
 * @package app\payloads
 */
class Payment extends Model
{
    /** @var */
    public $sender_account_id;
    /** @var */
    public $receiver_account_id;
    /** @var */
    public $sum;
    /** @var */
    public $currency;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['currency', 'filter', 'filter' => 'strtoupper'],
            [['currency', 'receiver_account_id', 'sender_account_id', 'sum'], 'required'],
            [['sum'], 'default', 'value' => 0],
            [['receiver_account_id', 'sender_account_id'], 'integer', 'min' => 1],
            ['sum', 'double'],
            [['currency', 'receiver_account_id', 'sender_account_id', 'sum'], 'safe'],
            [['currency'], 'string', 'max' => 3],
            ['currency', CurrencyValidator::class],
            [
                ['sender_account_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Account::class,
                'targetAttribute' => ['sender_account_id' => 'id']
            ],
            [
                ['receiver_account_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Account::class,
                'targetAttribute' => ['receiver_account_id' => 'id']
            ],
        ];
    }
}
