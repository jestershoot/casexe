<?php
/**
 * Created by PhpStorm.
 * User: Aleksey
 * Date: 13.12.17
 * Time: 14:13
 */

namespace frontend\controllers;

use Yii;
use frontend\models\Card;
use backend\models\Prize;
use yii\web\Controller;

class CardController extends Controller
{
    public function actionShow($id) {

        $model = new Card();
        $prize = Prize::find()->where(['id' => $id])->one();

        $model->cardType = 1;
        $model->amount = $prize->amount;
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            $model->prize_id = $prize->id;
            $model->status = 0;


            if ($model->save()) {
                Prize::acceptPrize($prize);
                Yii::$app->session->setFlash('success', 'You will recieve money during 3 days.');
                return $this->redirect('/game/play/');
            }
            else {
                Yii::$app->session->setFlash('error', 'Check all fields.');
            }
        }

        $this->view->title = 'Get money to card';

        if (Yii::$app->request->isAjax) {
            $this->layout = 'empty';
            print $this->render('cardForm', compact('model'));
            die();
        }
        else {
            return $this->render('cardForm', compact('model'));
        }
    }
}