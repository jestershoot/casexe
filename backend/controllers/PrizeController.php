<?php
/**
 * Created by PhpStorm.
 * User: Aleksey
 * Date: 12.12.17
 * Time: 15:18
 */

namespace backend\controllers;

use Yii;
use backend\models\Prize;
use yii\web\Controller;

class PrizeController extends Controller
{
    public function actionIndex() {
        $prizes = Prize::find()->all();

        return $this->render('index', compact('prizes'));
    }

    public function actionManage($id = 0) {
        if ($id) {
            $model = Prize::find()->where(['id' => $id])->one();
        }
        else {
            $model = new Prize();
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {

                Yii::$app->session->setFlash('success', 'New prize was added.');
                return $this->redirect('/admin/prize/');
            }
            else {
                Yii::$app->session->setFlash('error', 'Check all fields.');
            }
        }

        $this->view->title = $id ? 'Edit prize "' .$model->name .'"' : 'Add new prize';

        return $this->render('manage', compact('model'));
    }

    public function actionDelete($id) {
        $message = '';
        if (is_numeric($id)) {
            $model = Prize::find()->where(['id' => $id])->one();
            if (!empty($model)) {
                $model->delete();
                Yii::$app->session->setFlash('success', 'Prize was deleted.');
            }
            else {
                Yii::$app->session->setFlash('error', 'Prize not found.');
            }
        }
        else {
            Yii::$app->session->setFlash('error', 'Prize not found.');
        }

        return $this->redirect('/admin/prize/');
    }
}