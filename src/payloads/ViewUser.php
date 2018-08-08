<?php

namespace app\payloads;

use yii\base\Model;

/**
 * Class ViewUser
 * @package app\payloads
 */
class ViewUser extends Model
{
    /** @var */
    public $id;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'number'],
        ];
    }
}
