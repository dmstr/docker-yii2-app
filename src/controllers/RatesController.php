<?php

namespace app\controllers;

use app\models\Rates;
use app\payloads\AddRate;
use app\responses\BaseResponse;

/**
 * Class RatesController
 * @package app\controllers
 */
class RatesController extends BaseController
{
    /** @var string */
    public $modelClass = \app\models\Rates::class;

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function actionCreate()
    {
        $response = new BaseResponse();
        $payload = new AddRate();
        $payload->setAttributes(\Yii::$app->getRequest()->post());
        if ($payload->validate()) {
            $rate = new Rates();
            $rate->rate = $payload->rate;
            $rate->currency = $payload->currency;
            $rate->rate_date = \Yii::$app->getFormatter()->asDate($payload->rate_date);
            if ($rate->save()) {
                $response->setStatusCode(200);
            } else {
                $response->setStatusCode(400);
                $response->setBody('Error during validating CreateAccount with message: ' . json_encode($rate->getErrors()));
            }
        } else {
            $response->setStatusCode(400);
            $response->setBody('Error during validating CreateAccount with message: ' . json_encode($payload->getErrors()));
            //TODO: log here
        }

        return $response->toJson();

    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $response = new BaseResponse();
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
