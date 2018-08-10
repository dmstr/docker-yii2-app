<?php

namespace app\payloads;

use app\models\User;
use yii\base\Model;

/**
 * Class ViewUser
 * @package app\payloads
 */
class ViewUser extends Model
{
    /** @var */
    public $id;
    /** @var */
    public $from;
    /** @var */
    public $to;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'number', 'min' => 1],
            [['from', 'to'], 'date', 'format' => 'php:Y-m-d'],
            [
                ['id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['id' => 'id']
            ],
        ];
    }
}
