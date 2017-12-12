<?php

use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use yii\helpers\Html;

?>

<h1><?= $this->title ?></h1>


<?php $form = ActiveForm::begin(['options' => ['id' => 'prizeForm']]); ?>
<?= $form->field($model, 'name'); ?>
<?= $form->field($model, 'type')->dropDownList($model->prizeType()) ?>
<?= $form->field($model, 'amount'); ?>
<?= $form->field($model, 'cnt'); ?>
<?= HTML::submitButton('Save', ['class' => 'btn btn-success'])  ?>
<?php ActiveForm::end(); ?>
