<?php

namespace app\models;

use Yii;

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
            [['rate'], 'default', 'value' => null],
            [['rate'], 'integer'],
            [['rate_date'], 'safe'],
            [['currency'], 'string', 'max' => 3],
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
