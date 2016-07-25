<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Progress;
use yii\web\View;
use yii\widgets\Pjax;
use app\assets\AppAsset;

/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Loading');

$progress_name 		= 'game_load';
$total_time			= 10000;

// Set JS var
$this->registerJs($this->context->getJSConfig(), View::POS_HEAD);
$this->registerJsFile("@web/js/game/game.js", ['depends' => [AppAsset::className()]]);
$this->registerJsFile("@web/js/game/start.js", ['depends' => [AppAsset::className()]]);
?>

<div class="game-start">
	<h1><?= Html::encode($this->title) ?></h1>

<?= Progress::widget([
	'id' => $progress_name,
	'percent' => 0,
	'label' => '0%',
	'barOptions' => ['class' => 'progress-bar'],
    'options' => ['class' => 'active progress-striped']
]); ?>
	<br>
	<div id="loading_details" style="text-align:center;"><h2><?= Yii::t('game', 'Text_Load_Title') ?></h2>
		<div id='create_map'><?= Yii::t('game', 'Txt_Map_Creation') ?><span>...</span><img src='img/site/ready.png' width='20px' height='20px' style="display: none;"></div>
		<div id='create_region'><?= Yii::t('game', 'Txt_Region_Creation') ?><span style="display: none;">...</span><img src='img/site/ready.png' width='20px' height='20px' style="display: none;"></div>
		<div id='create_players'><?= Yii::t('game', 'Txt_Player_Creation') ?><span style="display: none;">...</span><img src='img/site/ready.png' width='20px' height='20px' style="display: none;"></div>
		<div id='assign_lands'><?= Yii::t('game', 'Txt_Land_Assignation') ?><span style="display: none;">...</span><img src='img/site/ready.png' width='20px' height='20px' style="display: none;"></div>
		<div id='finalization'><?= Yii::t('game', 'Txt_Finalization') ?><span style="display: none;">...</span><img src='img/site/ready.png' width='20px' height='20px' style="display: none;"></div><br>
		<div id='enter_button' style="display: none;"><?= Html::a(Yii::t('game', 'Button_Enter_In_Game'), ['/game/map'], ['class'=>'btn btn-success']); ?></div>
	</div>
</div>