<?php

namespace app\controllers;

use yii\rest\ActiveController;

/**
 * Class PaymentController
 * @package app\controllers
 */
class PaymentController extends ActiveController
{
    public $modelClass = 'app\models\Transfer';
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

    /**
     * Renders the start page.
     *
     * @return string
     */
    public function actionCreate()
    {
        die('create');
    }

    /**
     * Renders the start page.
     *
     * @return string
     */
    public function actionIndex()
    {
        die('12321');

        return $this->render('index');
    }
}
