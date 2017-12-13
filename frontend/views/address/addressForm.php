<?php

use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use yii\helpers\Html;

?>

<h1><?= $this->title ?></h1>


<?php $form = ActiveForm::begin(['options' => ['id' => 'addressForm']]); ?>
<?= $form->field($model, 'reciever'); ?>
<?= $form->field($model, 'country'); ?>
<?= $form->field($model, 'zip'); ?>
<?= $form->field($model, 'state'); ?>
<?= $form->field($model, 'city'); ?>
<?= $form->field($model, 'address'); ?>
<?= HTML::submitButton('Save', ['class' => 'btn btn-success'])  ?>
<?php ActiveForm::end(); ?>
