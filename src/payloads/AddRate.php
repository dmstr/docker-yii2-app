<?php

namespace app\payloads;

/**
 * Class AddRate
 * @package app\models
 */
class AddRate extends \yii\db\ActiveRecord
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['currency', 'filter', 'filter' => 'strtolower'],
            [['currency', 'rate', 'rate_date'], 'required'],
            [['rate'], 'default', 'value' => null],
            [['rate'], 'integer'],
            [['rate_date'], 'safe'],
            [['currency'], 'string', 'max' => 3],
        ];
    }
}
