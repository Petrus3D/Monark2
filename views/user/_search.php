<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user.id') ?>

    <?= $form->field($model, 'user.name') ?>

    <?= $form->field($model, 'user.pass') ?>

    <?= $form->field($model, 'user.mail') ?>

    <?= $form->field($model, 'user.reg.pass') ?>

    <?php // echo $form->field($model, 'user.reg.time') ?>

    <?php // echo $form->field($model, 'user.reg.ip') ?>

    <?php // echo $form->field($model, 'user.reg.mail') ?>

    <?php // echo $form->field($model, 'user.log.time') ?>

    <?php // echo $form->field($model, 'user.log.ip') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
