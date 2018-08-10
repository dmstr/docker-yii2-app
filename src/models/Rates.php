<?php

namespace app\models;

use app\validators\CurrencyValidator;

/**
 * This is the model class for table "rates".
 *
 * @property int $id
 * @property string $currency
 * @property int $rate
 * @property string $rate_date
 */
class Rates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['currency', 'rate', 'rate_date'], 'required'],
            [['rate'], 'double'],
            [['rate'], 'unique', 'targetAttribute' => ['rate', 'currency', 'rate_date']],
            [['rate', 'currency', 'rate_date'], 'safe'],
            [['currency'], 'string', 'max' => 3],
            ['currency', CurrencyValidator::class],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'currency' => 'Currency',
            'rate' => 'Rate',
            'rate_date' => 'Rate Date',
        ];
    }
}
