<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Prize;

class GameController extends Controller
{
    private $moneyToBonusConvertRate = 10;

    // random prize selection
    private function choosePrize() {
        $this->layout = 'empty';
        $won_prize = null;
        $prizes = Prize::find()->where(['>', 'cnt', 0])->all();
        if (sizeof($prizes)) {
            $prize_num = rand(0, sizeof($prizes) - 1);
            $won_prize = $prizes[$prize_num];
        }

        return $this->render('prize', ['prize' => $won_prize]);
    }

    // return Money to Bonus convert rate
    public function convertMoneyToBonus($id) {
        $prize = Prize::find()->where(['id' => $id])->one();

        $amount = $prize->amount * $this->moneyToBonusConvertRate;
        return $amount;
    }

    // Play button action
    public function actionPlay() {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->request->isAjax) {
                print $this->choosePrize();
                die();
            }

            $this->view->title = 'Play Game!';
            return $this->render('play');
        }
        else {
            Yii::$app->session->setFlash('error', 'Access denied.');
            return $this->goHome();
        }
    }

    // give Bonus to user
    public function actionBonus($id, $amount = 0) {
        $prize = Prize::find()->where(['id' => $id])->one();
        Prize::acceptPrize($prize);

        if (Yii::$app->request->isAjax) {
            $this->layout = 'empty';
        }

        $coins = $amount ? $amount : $prize->amount;

        $message = 'You recieved ' .$coins .' Bonus Coins.';
        $output = $this->render('message', ['message' => $message]);

        if (Yii::$app->request->isAjax) {
            print $output;
            die();
        }
        else {
            return $output;
        }
    }

    // convert money to
    public function actionConvert($id) {
        $this->actionBonus($id, $this->convertMoneyToBonus($id));
    }

    // pay money to user form
    public function actionMoney($id) {

    }
}