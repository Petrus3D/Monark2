<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('user', 'Title_Sign');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-sign">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to register:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
        <?= $form->field($model, 'username')->label(Yii::t('user', 'Form_Create_User_Username')) ?>

        <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('user', 'Form_Create_User_Password')) ?>
        
        <?= $form->field($model, 'mail')->input('email')->label(Yii::t('user', 'Form_Create_User_Mail')) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton(Yii::t('user', 'Button_Form_Create_Reg'), ['class' => 'btn btn-primary', 'name' => 'sign-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?> 
</div>
