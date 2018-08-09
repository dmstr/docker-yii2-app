<?php

namespace app\controllers;

use app\enums\TransferTypeEnum;
use app\models\Account;
use app\models\Transfer;
use app\models\User;
use app\payloads\CreateUser;
use app\payloads\ViewUser;
use app\responses\BaseResponse;

/**
 * Class UserController
 * @package app\controllers
 */
class UserController extends BaseController
{
    /** @var string */
    public $modelClass = \app\models\User::class;

    /**
     * @return string
     * @throws \yii\db\Exception
     */
    public function actionCreate()
    {
        $payload = new CreateUser();
        $payload->setAttributes(\Yii::$app->getRequest()->post());
        $response = new BaseResponse();
        if ($payload->validate()) {
            $transaction = \Yii::$app->db->beginTransaction();
            $user = new User();
            $user->username = $payload->username;
            $user->country = $payload->country;
            $user->city = $payload->city;
            if ($user->save()) {
                $account = new Account();
                $account->user_id = $user->id;
                $account->currency = $payload->currency;
                $account->sum = 0;
                if ($account->save()) {
                    $response->setStatusCode(201);
                    $response->setBody(
                        ['user_id' => $user->id, 'account_id' => $account->id]
                    );
                    $transaction->commit();
                } else {
                    $transaction->rollBack();
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
//        $users = User::find()->with('accounts')->all();
//var_dump($users);die;
//Collection
        return $response->toJson();
    }

    /**
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function actionView($id)
    {
        $payload = new ViewUser();
        $payload->setAttributes(\Yii::$app->getRequest()->get());
        $response = new BaseResponse();
        \Yii::$app->response->format = BaseResponse::FORMAT_XML;
        try {
            if ($payload->validate()) {
                $user = User::find()->joinWith(['accounts'])->where(['user.id' => $id])->one();
                if ($user instanceof User) {
                    $response_body['user'] = $user->toArray();
                    $transfers_query = Transfer::find()->andWhere([
                        'or',
                        ['sender_id' => $user->id],
                        ['receiver_id' => $user->id]
                    ]);
                    if ($payload->from) {
                        $transfers_query->andWhere([
                            '>=',
                            'created_at',
                            \Yii::$app->formatter->asDatetime($payload->from)
                        ]);
                    }
                    if ($payload->to) {
                        $transfers_query->andWhere([
                            '<=',
                            'created_at',
                            \Yii::$app->formatter->asDatetime(new \DateTime($payload->to . ' 1 day'))
                        ]);
                    }
                    $transfers = $transfers_query->orderBy('created_at')->all();
                    foreach ($transfers as $transfer) {
                        $response_body['transactions'][$transfer->id] = [
                            'id' => $transfer->id,
                            'date' => $transfer->created_at,
                            'transactiom_currency' => $transfer->transfer_currency,
                            'transactiom_sum' => $transfer->transfer_sum,
                            'sender_id' => $transfer->sender_id,
                            'receiver_id' => $transfer->receiver_id,
                            'sum_sender' => $transfer->sum_sender,
                            'sum_receiver' => $transfer->sum_receiver,
                            'sum_in_usd' => $transfer->sum_usd,
                            'type' => TransferTypeEnum::getTypeName($transfer->transfer_type),
                            'comment' => $transfer->sender_id === $user->id ? 'credit' : 'debit',
                        ];
                    }
                    $response->setBody($response_body);
                } else {
                    $response->setStatusCode(500);
                    throw new \Exception('User with ' . $id . ' not found');
                }

                //var_dump($transfers);
                //die;


            } else {
                $response->setStatusCode(400);
                throw new \Exception('Error during validating CreateAccount with message: ' . json_encode($payload->getErrors()));
            }
        } catch (\Exception $e) {
            $response->setStatusCode(500);
            throw new \Exception($e->getMessage());
        }


        return $response->toArray();
    }
}
