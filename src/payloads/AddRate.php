<?php

namespace app\payloads;

use app\validators\CurrencyValidator;
use yii\base\Model;

/**
 * Class AddRate
 * @package app\models
 */
class AddRate extends Model
{
    /** @var */
    public $currency;
    /** @var */
    public $rate;
    /** @var */
    public $rate_date;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['currency', 'filter', 'filter' => 'strtoupper'],
            [['currency', 'rate', 'rate_date'], 'required'],
            [['rate'], 'double'],
            [['rate', 'currency', 'rate_date'], 'safe'],
            [['currency'], 'string', 'max' => 3],
            ['currency', CurrencyValidator::class],
        ];
    }
}
