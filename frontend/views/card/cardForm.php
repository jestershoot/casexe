<?php

use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use yii\helpers\Html;

?>

<h1><?= $this->title ?></h1>


<?php $form = ActiveForm::begin(['options' => ['id' => 'cardForm']]); ?>
<label>Amount</label>: $<?= $model->amount ?>

<?= $form->field($model, 'cardType')->radioList($model->cardType()); ?>
<?= $form->field($model, 'cardNumber'); ?>
<?= HTML::submitButton('Save', ['class' => 'btn btn-success'])  ?>
<?php ActiveForm::end(); ?>
