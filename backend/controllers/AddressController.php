<?php
/**
 * Created by PhpStorm.
 * User: Aleksey
 * Date: 13.12.17
 * Time: 22:07
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Address;

class AddressController extends Controller
{
    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Access denied.');
            return $this->redirect('/admin/site/login');
        }

        $addresses = Address::find()->orderBy(['id' => SORT_DESC])->all();
        return $this->render('addresses', ['addresses' => $addresses]);
    }

    public function actionSend($id) {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Access denied.');
            return $this->redirect('/admin/site/login');
        }

        Address::prizeSent($id);
        Yii::$app->session->setFlash('success', 'Prize was sent successfully.');
        return $this->redirect('/admin/address/');
    }
}
