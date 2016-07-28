<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use app\assets\AppAsset;

/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Game_Chat');

// Set JS var
$this->registerJs($this->context->getJSConfig(), View::POS_HEAD);
$this->registerJsFile("@web/js/game/game.js", ['depends' => [AppAsset::className()]]);
$this->registerJsFile("@web/js/game/ajax.js", ['depends' => [AppAsset::className()]]);
?>

<div class="game-chat">
	<h1><?= Html::encode($this->title) ?></h1>
</div>
