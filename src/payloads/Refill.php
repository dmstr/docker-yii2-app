<?php

namespace app\payloads;

use app\models\Account;
use app\validators\CurrencyValidator;
use yii\base\Model;

/**
 * Class Refill
 * @package app\payloads
 */
class Refill extends Model
{
    /** @var */
    public $account_id;
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
            [['currency', 'account_id', 'sum'], 'required'],
            [['sum'], 'default', 'value' => 0],
            [['account_id'], 'integer'],
            ['sum', 'double'],
            [['currency', 'account_id', 'sum'], 'safe'],
            [['currency'], 'string', 'max' => 3],
            ['currency', CurrencyValidator::class],
            [
                ['account_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Account::class,
                'targetAttribute' => ['account_id' => 'id']
            ],
        ];
    }
}
