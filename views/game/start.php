<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Progress;

/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Loading');

$progress_name 		= 'game_load';
$total_time			= 10000;
$progress_step 		= 1;
?>

<?php
$this->registerJs('
    // Update progress Bar
    function updateProgress(progress_name, i, percent){
    	var current = i * percent;
    	showProgressionDetails(current);
		$("#"+progress_name+" .progress-bar").attr("style", "width:"+current+"%");
		$("#"+progress_name+" .progress-bar").attr("aria-valuenow", current);
		$("#"+progress_name+" .progress-bar").html(current+"%");
		if(current + percent > 100)
			return 1;
		else
			return 0;
    }
		
	// show progression
	function showProgressionDetails(currentPercent){
		switch(currentPercent) {
    	case 20:
        	$("#create_map img").removeAttr("style");
			$("#create_map span").hide();
			$("#create_region span").removeAttr("style");
        	break;
    	case 40:
        	$("#create_region img").removeAttr("style");
			$("#create_region span").hide();
			$("#create_players span").removeAttr("style");
        	break;
		case 60:
        	$("#create_players img").removeAttr("style");
			$("#create_players span").hide();
			$("#assign_lands span").removeAttr("style");
        	break;
    	case 80:
        	$("#assign_lands img").removeAttr("style");
			$("#assign_lands span").hide();
			$("#finalization span").removeAttr("style");
        	break;
		case 99:
        	$("#finalization img").removeAttr("style");
			$("#finalization span").hide();
        	break;
		case 100:
			$("#enter_button").removeAttr("style");
        	break;
    	default:
        	break;
		} 	
	}

    // Start all functions
	$("document").ready(
		function(){
			// Informations 
	    	var i 						= 1;
    		var percent 				= '.$progress_step.';
    		var progress_name 			= "'.$progress_name.'";
    		alert(test);		
        	// Interval beginning
    		var IntervalId = setInterval(
    			function(){
    				if(updateProgress(progress_name, i, percent) == 0)
    					i++;
					else
						clearInterval(IntervalId);
    			}
                , 500); 
			}
		);
');?>

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