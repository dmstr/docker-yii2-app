<?php

namespace app\controllers;

use app\enums\TransferTypeEnum;
use app\models\Account;
use app\models\Rates;
use app\models\Transfer;
use app\models\User;
use app\payloads\Refill;
use app\responses\BaseResponse;

/**
 * Class RefillController
 * @package app\controllers
 */
class RefillController extends BaseController
{
    /** @var string */
    public $modelClass = 'app\models\Payment';

    /**
     * @return string
     */
    public function actionCreate()
    {
        $response = new BaseResponse();
        $payload = new Refill();
        $transaction = \Yii::$app->db->beginTransaction();
        $payload->setAttributes(\Yii::$app->getRequest()->post());
        try {


            if ($payload->validate()) {
                $account = Account::find()->with('user')->where(['id' => $payload->account_id])->one();
                if ($account instanceof Account && $account->user instanceof User) {
                    //вычисляем сумму заполнения
                    $refill_sender_currency_rate = Rates::find()->where(['currency' => $payload->currency])->orderBy(['rate_date' => SORT_DESC])->one();
                    $refill_receiver_currency = Rates::find()->where(['currency' => $account->currency])->orderBy(['rate_date' => SORT_DESC])->one();
                    if ($refill_sender_currency_rate instanceof Rates && $refill_receiver_currency instanceof Rates) {
                        $sum_in_usd = round($payload->sum / $refill_sender_currency_rate->rate, 4);
                        $refill_summ = round($payload->sum / $refill_sender_currency_rate->rate * $refill_receiver_currency->rate,
                            4);
                        $transfer = new Transfer();
                        $transfer->sender_id = $account->user->id;
                        $transfer->receiver_id = $account->user->id;
                        $transfer->transfer_currency = $payload->currency;
                        $transfer->transfer_sum = $payload->sum;
                        $transfer->sum_receiver = $refill_summ;
                        $transfer->sum_usd = $sum_in_usd;
                        $transfer->transfer_type = TransferTypeEnum::FILL;
                        $transfer->created_at = \Yii::$app->formatter->asDatetime('now');
                        $account->sum += $refill_summ;
                        if ($transfer->save() && $account->save()) {
                            $transaction->commit();
                            $response->setStatusCode(200);
                        } else {
                            $transaction->rollBack();
                            throw new \Exception('Error: transfer:' . json_encode($transfer->getErrors()) . '; account:' . json_encode($account->getErrors()));
                        }
                    } else {
                        throw new \Exception('Currency rate for not found');
                    }
                } else {
                    throw new \Exception('User with this account id not found');
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
     * @return string
     */
    public function actionIndex()
    {
        $response = new BaseResponse();
        $response->setStatusCode(501);

        return $response->toJson();
    }
}
