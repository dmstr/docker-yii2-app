<?php

namespace app\controllers;

use app\payloads\AddRate;
use app\responses\BaseResponse;
use yii\rest\ActiveController;

/**
 * Class RatesController
 * @package app\controllers
 */
class RatesController extends ActiveController
{
    public $modelClass = 'app\models\Rates';

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
     *
     */
    public function actionCreate()
    {

        die('create');
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $response = new BaseResponse();
        $payload = new AddRate(\Yii::$app->getRequest()->post());
        if($payload->validate())
        $response->setStatusCode(501);

        return $response->toJson();
    }

    /**
     * Renders the start page.
     *
     * @return string
     */
    public function actionView()
    {
        $response = new BaseResponse();
        $response->setStatusCode(501);

        return $response->toJson();
    }
}
