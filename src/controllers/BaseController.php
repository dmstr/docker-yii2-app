<?php

namespace app\controllers;

use yii\rest\ActiveController;

/**
 * Class BaseController
 * @package app\controllers
 */
class BaseController extends ActiveController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}
