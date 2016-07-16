<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Progress;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Map');
$refresh_time = $RefreshTime;


/* Reload map JS */
$this->registerJs('$(document).on("pjax:timeout", function(event) {
  // Prevent default timeout redirection behavior
  event.preventDefault()
});');

$this->registerJs(
		'$("document").ready(function(){
        setInterval(function(){
            if($("modal:hover").length == 0){
                $.pjax.reload({container:"#map_content"});
            }
        }, '.$refresh_time.'); //Reload map
    });'
		);
?>

<div class="map-show">
	<!-- Modals Js -->
    <?php
        Modal::begin(['id' => 'modal-view','header' => '<div class="modal-header-title"></div>',]);
        echo "<div id='modal-view-Content'></div>";
        Modal::end();
    ?>
    <!-- End Modal Js -->

	<?php Pjax::begin(['id' => 'map_content', 'timeout' => $refresh_time]); ?>
	<div id='map_content'>
		<?php $user_units = 0; ?>
		
		<?php foreach ($GameData as $data): ?>
			
			<?php $land = $Land[$data->getGameDataLandId()]; ?>    
			<div class="land_content" i=<?= "'".$land->getLandId()."'"; ?>>
	              <a href=<?= "'#".str_replace("'", "-", $land->getLandName())."'"; ?> class="link_land_img" style=<?= "'top:".$land->getLandPositionTop()."em;left:".$land->getLandPositionLeft()."em;text-decoration: none;'"; ?>>
	                    <img src=<?= "'".$land->getLandImageUrl($Color[$GamePlayer[$data->getGameDataUserId()]->getGamePlayerColorId()]->getColorName2())."'"; ?> i=<?= "'".$land->getLandId()."'"; ?> alt=<?= "'".$land->getLandName()."'"; ?> class="land_img" 
	                    style=<?= "'top:".$land->getLandPositionTop()."em;left:".$land->getLandPositionLeft()."em;'"; ?>> 
	                    <!--<div class="building" style=<?= "'position:absolute;top:".$land->getLandPositionTop()."em;left:".$land->getLandPositionLeft()."em;'"; ?>>
	                        <?php //if($value['land_harbor']): ?>
	                            <img src='img/harbor.png' height='20px' width='20px' style='position:relative;top:24px;left:10px;'>
	                        <?php //endif; ?>
	                    </div>-->
	                </a>
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
	                  <?php //if(isset($user_frontier_array[$value['land_id']])): ?>
	                     <?php if($data->getGameDataUserId() == $User->getUserID()){$user_units+=$data->getGameDataUnits();} ?><br>
	                    	<?php $nb_canon = (int)($data->getGameDataUnits()/10);$nb_horseman = (int)(fmod($data->getGameDataUnits(), 10)/5);$nb_soldier = (int)(fmod(fmod($data->getGameDataUnits(), 10), 5)); ?>
	                    	<?php for($i=1; $i <= $nb_canon; $i++): ?>
	                       		<img src='img/canon.png' class='land_canon' style=<?= "'left:".$i."px;'"; ?>>
	                   		<?php endfor; ?>
	                    	<?php for($i=1; $i <= $nb_horseman; $i++): ?>
	                        	<img src='img/horseman.png' class='land_horseman' style=<?= "'left:".$i."px;'"; ?>>
	                    	<?php endfor; ?>
	                    	<?php for($i=1; $i <= $nb_soldier; $i++): ?>
	                    		<img src='img/soldier.png' class='land_soldier' style=<?= "'left:".$i."px;'"; ?>>
	                  		<?php endfor; ?>
	                  <?php //endif; ?>
                  </div>
	        </div>
		<?php endforeach; ?>
	
	</div>
	<?php Pjax::end(); ?>
</div>
						