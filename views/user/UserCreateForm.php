<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
?>
<div class="UserCreateForm">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'user_name') ?>
        <?= $form->field($model, 'user_mail') ?>
        <?= $form->field($model, 'user_ip') ?>
        <?= $form->field($model, 'user_registration_time') ?>
        <?= $form->field($model, 'user_last_login') ?>
        <?= $form->field($model, 'user_role') ?>
        <?= $form->field($model, 'user_type') ?>
        <?= $form->field($model, 'user_key') ?>
        <?= $form->field($model, 'user_pwd') ?>
        <?= $form->field($model, 'user_pwd2') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- UserCreateForm -->
