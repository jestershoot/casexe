<?php
/**
 * Created by PhpStorm.
 * User: Aleksey
 * Date: 13.12.17
 * Time: 20:51
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Card;

class CardController extends Controller
{
    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Access denied.');
            return $this->redirect('/admin/site/login');
        }

        $payments = Card::find()->orderBy(['id' => SORT_DESC])->all();
        return $this->render('payments', ['payments' => $payments]);
    }

    public function actionPay($id) {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Access denied.');
            return $this->redirect('/admin/site/login');
        }

        Card::paymentDone($id);
        Yii::$app->session->setFlash('success', 'Money were sent to user\'s card');
        return $this->redirect('/admin/card/');
    }
}