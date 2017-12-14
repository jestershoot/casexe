<?php

namespace console\controllers;

use yii\console\Controller;
use frontend\models\Card;

class PaymentsController extends Controller
{
    public function actionIndex()
    {
        $total = Card::find()->where(['=', 'status', '0'])->count();
        echo 'Waiting for payment: ' .$total ."\n";

        return 0;
    }

    public function actionPay($count) {
        $payments = Card::find()->where(['=', 'status', '0'])->orderBy(['id' => SORT_ASC])->limit($count)->all();
        if (sizeof($payments)) {
            foreach ($payments as $p) {
                Card::paymentDone($p->id);
                print Card::cardType($p->cardType) .': ' .$p->cardNumber .' - paid $' .$p->amount ."\n";
            }
        }
        else {
            echo 'All payments done.' ."\n";
        }
        return 0;
    }
}