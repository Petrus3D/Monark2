<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user.name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user.pass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user.mail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user.reg.pass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user.reg.time')->textInput() ?>

    <?= $form->field($model, 'user.reg.ip')->textInput() ?>

    <?= $form->field($model, 'user.reg.mail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user.log.time')->textInput() ?>

    <?= $form->field($model, 'user.log.ip')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
