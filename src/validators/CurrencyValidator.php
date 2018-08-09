<?php
/**
 * Created by PhpStorm.
 * User: Pavel Tsvetkov
 * Date: 09.08.2018
 * Time: 10:26
 */

namespace app\validators;

use Currency\Currency;
use Currency\Exception\InvalidCurrencyException;
use yii\validators\Validator;

class CurrencyValidator extends Validator
{
    /**
     * @param \yii\base\Model $model
     * @param string $attribute
     */
    public function validateAttribute($model, $attribute)
    {
        try {
            $currency = new Currency(strtoupper($model->$attribute));
        } catch (InvalidCurrencyException $e) {
            $this->addError($model, $attribute, $e->getMessage());
        }
    }
}
