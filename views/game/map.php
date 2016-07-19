<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Progress;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\web\View;
use app\models\Land;
use app\controllers\AjaxController;


/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Map');
$refresh_time = $RefreshTime;

// Set JS var
$config = array(
		'refresh_time' => $refresh_time,
		'text' => array(
				'turn_finished' 			=> Yii::t('map', 'Text_Turn_Finished'),
				'modal_loading_content'		=> '<center><font size=3>'.Yii::t('map', 'Modal_Loading').'...</font><br><img src=img/loading.gif></center>',
				'modal_error_content'		=> '<center><font size=3>'.Yii::t('map', 'Modal_Error').'</font></center>',
		),
		'url'	=> array(
				'ajax' => Yii::$app->urlManager->createUrl(['ajax'])
		),
		'ajax'	=> array(
				'error'	=> AjaxController::returnError(),
		)
);
$this->registerJs("var config = ".json_encode($config).";", View::POS_HEAD);

// Call files
$this->registerJsFile("@web/js/game/map.js", ['depends' => [dmstr\web\AdminLteAsset::className()]]);
$this->registerCssFile("@web/css/map.css");
?>

<div class="map-show">
	<!-- Modals Js -->
    <?php
        Modal::begin(['id' => 'modal-view','header' => '<div class="modal-header-title"></div>',]);
        echo "<div id='modal-view-Content'></div>";
        Modal::end();
    ?>
    <!-- End Modal Js -->

	<?php Pjax::begin(['id' => 'map_content']); ?>
	<div id='map_content'>
		<?php $user_units = 0; ?>
		
		<?php foreach ($GameData as $data): ?>
			
			<?php $land = $Land[$data->getGameDataLandId()]; ?>    
			<div class="land_content" i=<?= "'".$land->getLandId()."'"; ?>>
				  <!-- Image -->
	              <a href=<?= "'#".str_replace("'", "-", $land->getLandName())."'"; ?> class="link_land_img" style=<?= "'top:".$land->getLandPositionTop()."em;left:".$land->getLandPositionLeft()."em;text-decoration: none;'"; ?>>
	                    <img src=<?= "'".$land->getLandImageTempUrl($Color[$GamePlayer[$data->getGameDataUserId()]->getGamePlayerColorId()]->getColorName2())."'"; ?> i=<?= "'".$land->getLandId()."'"; ?> alt=<?= "'".$land->getLandName()."'"; ?> class="land_img" 
	                    style=<?= "'top:".$land->getLandPositionTop()."em;left:".$land->getLandPositionLeft()."em;'"; ?>> 
	                    <!--<div class="building" style=<?= "'position:absolute;top:".$land->getLandPositionTop()."em;left:".$land->getLandPositionLeft()."em;'"; ?>>
	                        <?php //if($value['land_harbor']): ?>
	                            <img src='img/harbor.png' height='20px' width='20px' style='position:relative;top:24px;left:10px;'>
	                        <?php //endif; ?>
	                    </div>-->
	                </a>
	               <!-- Title -->
	               <div class="land_title" style=<?= "'top:".$land->getLandPositionTop()."em;left:".$land->getLandPositionLeft()."em;'"; ?>>
                        <font color=<?= "'".$Color[$GamePlayer[$data->getGameDataUserId()]->getGamePlayerColorId()]->getColorName()."'"; ?>>
                            <?= $land->getLandName(); ?>
                            <?php //if(isset($user_frontier_array[$value['land_id']])){echo "(".$data->getGameDataUnits().")";} ?>
                            <?php if($data->getGameDataCapital() >= 1): ?>
                                <?= "<img src='img/star.png' height='20px' width='20px'>"; ?>
                            <?php endif; ?>
                            <?php if($data->getGameDataRessourceId() > 0 && $Ressource[$data->getGameDataRessourceId()]->getRessourceImage() != ""): ?>
                                <?= "<img src='".$Ressource[$data->getGameDataRessourceId()]->getRessourceImageUrl()."' height='20px' width='20px'>"; ?>
                            <?php endif; ?>
                        </font>
                        <!-- Units -->
	                  <?php //if(isset($user_frontier_array[$value['land_id']])): ?>
	                     	<?php $land_units = Land::LandCountUnitsToArray($data->getGameDataUnits());?>
	                     	<?php for($i=1; $i <= $land_units['canon']; $i++): ?>
	                       		<img src='img/canon.png' class='land_canon' style=<?= "'left:".$i."px;'"; ?>>
	                   		<?php endfor; ?>
	                    	<?php for($i=1; $i <= $land_units['horseman']; $i++): ?>
	                        	<img src='img/horseman.png' class='land_horseman' style=<?= "'left:".$i."px;'"; ?>>
	                    	<?php endfor; ?>
	                    	<?php for($i=1; $i <= $land_units['soldier']; $i++): ?>
	                    		<img src='img/soldier.png' class='land_soldier' style=<?= "'left:".$i."px;'"; ?>>
	                  		<?php endfor; ?>
	                  <?php //endif; ?>
                  </div>
	        </div>
		<?php endforeach; ?>
	
	</div>
	<?php Pjax::end(); ?>
</div>
						