<?php
/**
 * Created by PhpStorm.
 * User: Aleksey
 * Date: 13.12.17
 * Time: 14:13
 */

namespace frontend\controllers;

use Yii;
use frontend\models\Address;
use backend\models\Prize;
use yii\web\Controller;

class AddressController extends Controller
{
    public function actionShow($id) {

        $model = new Address();
        $prize = Prize::find()->where(['id' => $id])->one();
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            $model->prize_id = $prize->id;
            $model->status = 0;


            if ($model->save()) {
                Prize::acceptPrize($prize);
                Yii::$app->session->setFlash('success', "We'll send your prize as soon as possible.");
                return $this->redirect('/game/play/');
            }
            else {
                Yii::$app->session->setFlash('error', 'Check all fields.');
            }
        }

        $this->view->title = 'Input your address';

        if (Yii::$app->request->isAjax) {
            $this->layout = 'empty';
            print $this->render('addressForm', compact('model'));
            die();
        }
        else {
            return $this->render('addressForm', compact('model'));
        }
    }
}