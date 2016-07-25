<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Game_Diplomacy');

// Set JS var
$this->registerJs($this->context->getJSConfig(), View::POS_HEAD);
$this->registerJsFile("@web/js/game/game.js", ['depends' => [dmstr\web\AdminLteAsset::className()]]);
$this->registerJsFile("@web/js/game/ajax.js", ['depends' => [dmstr\web\AdminLteAsset::className()]]);
?>

<div class="game-diplomacy">
	<h1><?= Html::encode($this->title) ?></h1>
</div>
