<?php

namespace app\controllers;

use app\enums\TransferTypeEnum;
use app\models\Account;
use app\models\Rates;
use app\models\Transfer;
use app\models\User;
use app\payloads\Payment;
use app\responses\BaseResponse;

/**
 * Class PaymentController
 * @package app\controllers
 */
class PaymentController extends BaseController
{
    /** @var string */
    public $modelClass = \app\models\Transfer::class;

    /**
     * @return string
     */
    public function actionCreate()
    {
        $response = new BaseResponse();
        $payload = new Payment();
        $transaction = \Yii::$app->db->beginTransaction();
        $payload->setAttributes(\Yii::$app->getRequest()->post());
        try {
            if ($payload->validate()) {
                $sender_account = Account::find()->with('user')->where(['id' => $payload->sender_account_id])->one();
                $receiver_account = Account::find()->with('user')->where(['id' => $payload->receiver_account_id])->one();
                if ($sender_account instanceof Account && $sender_account->user instanceof User) {
                    if ($receiver_account instanceof Account && $receiver_account->user instanceof User) {
                        $rates_array = [$payload->currency, $sender_account->currency, $receiver_account->currency];
                        $rates_array = array_unique($rates_array);
                        $rates = Rates::find()->innerJoin('(
    SELECT max(rate_date) AS maxDate, currency
    FROM rates
    		WHERE rates.rate_date <= now()
    GROUP BY currency
) AS max
    ON (max.currency = rates.currency
        AND max.maxDate = rates.rate_date
       AND rates.currency IN (\'' . implode("','", $rates_array) . '\')
    )')->indexBy('currency')->orderBy(['rate_date' => SORT_DESC])->all();
                        //получили курсы. проверяем возможность снятия денег со счета
                        if ($rates[$payload->currency] instanceof Rates) {
                            $payload_rate = $rates[$payload->currency];
                            //сумма перевода в USD
                            $payload_transfer_sum_in_usd = $payload->sum / $payload_rate->rate;
                            //провереяем наличие курса для отправителя
                            if (!$rates[$sender_account->currency] instanceof Rates) {
                                throw new  \Exception('Rate for sender account currency is not exist');
                            }
                            //проверка остатка на счете отправителя
                            $sender_account_currency_rate = $rates[$sender_account->currency];
                            $sender_sum_in_usd = $sender_account->sum / $sender_account_currency_rate->rate;
                            if ($sender_sum_in_usd < $payload_transfer_sum_in_usd) {
                                throw new \Exception('Insufficient funds in this account');
                            }
                            $transfer = new Transfer();
                            $transfer->sender_id = $sender_account->user->id;
                            $transfer->receiver_id = $receiver_account->user->id;
                            $transfer->transfer_currency = $payload->currency;
                            //calculating refill summ
                            $transfer->transfer_sum = $payload->sum;
                            if ($payload->currency === $receiver_account->currency) {
                                $refill_sum_in_receivers_currency = round($payload->sum, 4);
                            } else {
                                if (!$rates[$receiver_account->currency] instanceof Rates) {
                                    throw new  \Exception('Rate for receiver account currency is not exist');
                                }
                                $receiver_account_currency_rate = $rates[$receiver_account->currency];
                                $refill_sum_in_receivers_currency = round($payload_transfer_sum_in_usd * $receiver_account_currency_rate->rate,
                                    2);
                            }
                            $sum_sender = round($payload_transfer_sum_in_usd * $sender_account_currency_rate->rate, 4);
                            $sum_receiver = round($refill_sum_in_receivers_currency, 4);
                            $transfer->sum_sender = $sum_sender;
                            $transfer->sum_receiver = $payload_transfer_sum_in_usd;
                            $transfer->sum_usd = $sum_receiver;
                            $transfer->transfer_type = TransferTypeEnum::TRANSFER;
                            $transfer->created_at = \Yii::$app->formatter->asDatetime('now');
                            $transfer->sender_id = $sender_account->user->id;
                            $transfer->receiver_id = $receiver_account->user->id;
                            $transfer->transfer_currency = $payload->currency;
                            //calculate accounts
                            $sender_account->sum -= $sum_sender;
                            $receiver_account->sum += $sum_receiver;
                            if ($transfer->save() && $sender_account->save() && $receiver_account->save()) {
                                $transaction->commit();
                                $response->setStatusCode(200);
                            } else {
                                $transaction->rollBack();
                                $response->setStatusCode(500);
                                $response->setBody('Error: transfer:' . json_encode($transfer->getErrors())
                                    . '; sender_account:' . json_encode($sender_account->getErrors())
                                    . '; receiver_account:' . json_encode($receiver_account->getErrors()));
                            }
                        } else {
                            throw new \Exception('Rate for transfer currency is not exist');
                        }

                    } else {
                        throw new \Exception('Sender account or sender user is not exist');
                    }
                } else {
                    throw new \Exception('Receiver account or sender user is not exist');
                }
            } else {
                throw new \Exception('Error during validating CreateAccount with message: ' . json_encode($payload->getErrors()));
            }
        } catch (\Exception $e) {
            $response->setStatusCode(500);
            $response->setBody($e->getMessage());
        }


        return $response->toJson();
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $response = new BaseResponse();
        $response->setStatusCode(501);

        return $response->toJson();
    }
}
