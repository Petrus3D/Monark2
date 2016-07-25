<?php

use yii\helpers\Html;
use app\models\Land;
use app\models\Frontier;

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */
$this->registerCssFile("@web/css/ajax.css");
?>
<div class="landinfo-view-ajax">
	<?php $land 		= $Land[$land_id]; ?>
	<?php $visible 		= Frontier::userHaveFrontierLand($UserFrontierData, $land_id);?>
	<?php $userTurn 	= $CurrentTurnData->getTurnUserId() == $User->getId();?>
	<?php $userLand 	= $GameData[$land_id_array]->getGameDataUserId() == $User->getId(); ?>
	<?php $landFrontier = Frontier::landHaveFrontierLandArray($FrontierData, $land_id) ?>
	<div id='details' style='display:block;'>
		<table class="table-no-style" style="width:100%;table-layout:fixed;">
			<tr style="width:60%;">
				<td>
					<table class="table table-bordered table-hover">
			        <tbody>
			        	<!-- region info -->
						<tr>
							<td style="padding: 4px;text-align:center;"><font size='3' color="black">
							<?php if($GameData[$land_id_array]->getGameDataCapital() > 0): ?> 
								<?= Html::tag('span', "<img src='img/star.png' height='20px' width='20px'>", [
			                        'title'=>"Capitale du joueur. ",
			                        'data-toggle'=>'tooltip',
			                        'data-placement' => 'auto',
			                        'style'=>'text-decoration: none; cursor:pointer;'
			                    ]); ?>
			                <?php endif; ?>
			                <?= $Land[$land_id]->getLandName() ?> ( <?= Yii::t('continent', $Continent[$Land[$land_id]->getLandContinentId()]->getContinentName()) ?> )
							</font></td>
							<!--<td style="padding: 4px;"><?= Html::a("informations", ['/land/show', 'i' => $land_id], ['class'=>'btn btn-info']); ?></td>-->
						</tr>
						<!-- units info -->
						<?php if($visible): ?>
						<tr>
							<td style="padding: 4px;text-align:center;"><font size='3' color="black">
							<?php $land_units = Land::LandCountUnitsToArray($GameData[$land_id_array]->getGameDataUnits());?>
		                     <?php for($i=1; $i <= $land_units['canon']; $i++): ?>
		                       	<img src='img/canon.png' class='land_canon' style=<?= "'left:".$i."px;'"; ?>>
		                   	<?php endfor; ?>
		                    <?php for($i=1; $i <= $land_units['horseman']; $i++): ?>
		                       	<img src='img/horseman.png' class='land_horseman' style=<?= "'left:".$i."px;'"; ?>>
		                    <?php endfor; ?>
		                    <?php for($i=1; $i <= $land_units['soldier']; $i++): ?>
		                    	<img src='img/soldier.png' class='land_soldier' style=<?= "'left:".$i."px;'"; ?>>
		                  	<?php endfor; ?>
							</font></td>
						</tr>
						<?php endif; ?>
						<!-- owner info -->
						<tr>
							<td style="padding: 4px;text-align:center;"><font size='3' color="#<?= $Color[$GamePlayer[$GameData[$land_id_array]->getGameDataUserId()]->getGamePlayerColorId()]->getColorCSS(); ?>">
								<?= $UsersData[$GameData[$land_id_array]->getGameDataUserId()]->getUserName(); ?>
							</font></td>
						</tr>
						<!-- ressource info -->
						<tr>
							<td style="padding: 4px;text-align:center;"><font size='3' color="black">
							 <?php if($GameData[$land_id_array]->getGameDataRessourceId() > 0 && $Ressource[$GameData[$land_id_array]->getGameDataRessourceId()]->getRessourceImage() != ""): ?>
		                         <?= "<img src='".$Ressource[$GameData[$land_id_array]->getGameDataRessourceId()]->getRessourceImageUrl()."' height='20px' width='20px'>".$Ressource[$GameData[$land_id_array]->getGameDataRessourceId()]->getRessourceName(); ?>
		                    <?php else: ?>
		                    	<?= Yii::t('ajax', 'Text_Land_No_Ressource'); ?>
		                    <?php endif; ?>
							</font></td>
						</tr>
						<!-- building info -->
						<?php if($visible): ?>
						<tr>
							<td style="padding: 4px;text-align:center;"><font size='3' color="black">
							<?php $i = 0; ?>
							<?php foreach($GameData[$land_id_array]->getGameDataBuildings() as $building): ?>
								<?php if($building != null && $BuildingData[$building]->getBuildingId() > 0): ?>
									<i class="<?= $BuildingData[$building]->getBuildingImg() ?>"></i>
									<?= Html::tag('span', $BuildingData[$building]->getBuildingName(), [
						                          'title'=> $BuildingData[$building]->getBuildingDescription(),
						                          'data-toggle'=>'tooltip',
						                          'data-placement' => 'auto',
						                          'style'=>'text-decoration: none; cursor:pointer;'
						            ]); ?>
						            <?php $i++; ?>
					            <?php endif; ?>
					        <?php endforeach; ?>
				            <?php if($i == 0): ?>
		                    	<?= Yii::t('ajax', 'Text_Land_No_Building'); ?>
		                    <?php endif; ?>
							</font></td>
						</tr>
						<?php endif; ?>
						<!-- frontiere info -->
						<tr>
							<td style="padding: 4px;text-align:center;"><font size='3'>
								<?php foreach($landFrontier as $frontierLandId): ?>
									<font size='3' color="#<?= $Color[$GamePlayer[$GameData[$frontierLandId - 1]->getGameDataUserId()]->getGamePlayerColorId()]->getColorCSS(); ?>">
										<?= $Land[$frontierLandId]->getLandName(); ?>
									</font>
								<?php endforeach; ?>
							</font></td>
						</tr>
					</tbody>
					</table>
				</td>
				<td>
					<div class="div-center">
						<img src=<?= "'".$land->getLandImageTempUrl($Color[$GamePlayer[$User->getUserID()]->getGamePlayerColorId()]->getColorName2())."'"; ?> i=<?= "'".$land->getLandId()."'"; ?> alt=<?= '"'.$land->getLandName().'"'; ?> 
	                    style=""> 
					</div>
				</td>
			</tr>
		</table>
	</div>

	<div id="buttons" class="div-center">
		<!--<span id='onclick' class='btn btn-info'>Détails</span>-->
		<!-- Bottom buttons -->	
		<table>
			<tr>
				<?php if($userTurn && $userLand): ?>
				<td>
					<?= Html::tag('span', "&nbsp;<a href='#Buy' class='buy_link' i='".$land_id."' style='text-decoration:none;'><span class='btn btn-success'><i class='fa fa-usd'></i> ".Yii::t('ajax', 'Button_Land_Buy')." </span></a>", [
	                    'title'=>"Acheter des troupes pour cette région.",
	                    'data-toggle'=>'tooltip',
	                    'data-placement' => 'bottom',
	                    'style'=>'text-decoration: none; cursor:pointer;'
	                ]); ?>
	            </td><td>
	                <?= Html::tag('span', "&nbsp;<a href='#Build' class='build_link' i='".$land_id."' style='text-decoration:none;'><span class='btn btn-info'><i class='fa fa-gavel'></i> ".Yii::t('ajax', 'Button_Land_Build')." </span></a>", [
	                    'title'=>"Construire des bâtiments sur la région : fort, camp, mines. ",
	                    'data-toggle'=>'tooltip',
	                    'data-placement' => 'bottom',
	                    'style'=>'text-decoration: none; cursor:pointer;'
	                ]); ?>
	            </td><td>
	                <?= Html::tag('span', "&nbsp;<a href='#Build' class='move_link' i='".$land_id."' style='text-decoration:none;'><span class='btn btn-warning'><i class='fa fa-gavel'></i> ".Yii::t('ajax', 'Button_Land_Move')." </span></a>", [
	                    'title'=>"Deplacer des troupes vers une autre région. ",
	                    'data-toggle'=>'tooltip',
	                    'data-placement' => 'bottom',
	                    'style'=>'text-decoration: none; cursor:pointer;'
	                ]); ?>
		        </td>      
		        <?php elseif(!$userLand && $visible): ?>
		        <td>
		        	<?= Html::tag('span', "&nbsp;<a href='#Buy' class='atk_link' i='".$land_id."' style='text-decoration:none;'><span class='btn btn-danger'><i class='fa fa-usd'></i> ".Yii::t('ajax', 'Button_Land_Atk')." </span></a>", [
		                    'title'=>"Attaquer cette région.",
		                    'data-toggle'=>'tooltip',
		                    'data-placement' => 'bottom',
		                    'style'=>'text-decoration: none; cursor:pointer;'
		                ]); ?>
		        </td>
				<?php elseif($visible): ?>
				<td>
					<?= Yii::t('ajax', 'Text_Land_Not_User_Turn'); ?>
				</td>
				<?php endif; ?>
			</tr>
		</table>
	</div>	
</div>
