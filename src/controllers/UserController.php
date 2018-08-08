<?php

namespace app\controllers;

use app\models\Account;
use app\models\User;
use app\payloads\CreateUser;
use app\payloads\ViewUser;
use app\responses\BaseResponse;
use yii\rest\ActiveController;

/**
 * Class UserController
 * @package app\controllers
 */
class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';

    /**
     * @return array
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
     * @return string
     */
    public function actionCreate()
    {
        $payload = new CreateUser($_POST);
        $response = new BaseResponse();

        if ($payload->validate()) {
            $user = new User();
            $user->username = $payload->username;
            $user->country = $payload->country;
            $user->city = $payload->city;
            if ($user->save()) {
                $account = new Account();
                $account->user_id = $user->id;
                $account->currency = $payload->wallet_currency;
                $account->sum = 0;
                if ($account->save()) {
                    $response->setStatusCode(201);
                    $response->setBody(
                        ['user_id' => $user->id],
                        ['account_id' => $account->id]
                    );
                } else {
                    //TODO: Сейчас валидация на уровне формы но нужно что-нить сделать по логике когда user создан, wallet не создан
                    $response->setStatusCode(500);
                    $response->setBody('Error during creating Account with message: ' . json_encode($account->getErrors()));
                    //TODO: log here
                }
            } else {
                $response->setStatusCode(500);
                $response->setBody('Error during creating User with message: ' . json_encode($user->getErrors()));
                //TODO: log here
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
     * @return string
     */
    public function actionView($id)
    {
        $payload = new ViewUser(['id' => $id]);
        $response = new BaseResponse();
        if ($payload->validate()) {
            $user = User::find()->joinWith(['account'])->where(['id' => $id])->all();
            var_dump($user);
            die;
            if ($user instanceof User) {
                var_dump($user->getAccounts());
                die;
            }
        } else {
            $response->setStatusCode(400);
            $response->setBody('Error during validating CreateAccount with message: ' . json_encode($payload->getErrors()));
        }


        return $this->render('index');
    }
}
