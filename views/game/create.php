<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Game */
/* @var $form ActiveForm */
$this->title = Yii::t('game', 'Title_Create');
?>

<div class="game-create">

    <h1><?= Html::encode($this->title) ?></h1>
	<br>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'game_name')->textInput() ?>
        <?= $form->field($model, 'game_max_player')->textInput() ?>
        <!--<? //$form->field($model, 'game_map_id') ?>
        <? //$form->field($model, 'game_mod_id') ?>
        <? //$form->field($model, 'game_difficulty_id') ?>-->
        <?= $form->field($model, 'game_pwd')->passwordInput() ?>
    
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div><!-- create -->
