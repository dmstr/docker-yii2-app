<?php

namespace app\payloads;

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
    public $wallet_currency;
    /** @var */
    public $city;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'country', 'city', 'wallet_currency'], 'required'],
            [['username', 'country', 'city'], 'string', 'max' => 50],
            [['wallet_currency'], 'string', 'max' => 3],
        ];
    }
}
