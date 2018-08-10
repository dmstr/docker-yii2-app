<?php

namespace app\payloads;

use app\validators\CurrencyValidator;
use yii\base\Model;

/**
 * Class CreateUser
 * @package app\payloads
 */
class CreateUser extends Model
{
    /** @var */
    public $username;
    /** @var */
    public $country;
    /** @var */
    public $currency;
    /** @var */
    public $city;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['currency', 'filter', 'filter' => 'strtoupper'],
            [['username', 'country', 'city', 'currency'], 'required'],
            [['username', 'country', 'city'], 'string', 'max' => 50],
            [['currency'], 'string', 'max' => 3],
            ['currency', CurrencyValidator::class],
        ];
    }
}
