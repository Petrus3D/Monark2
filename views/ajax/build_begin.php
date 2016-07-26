<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */
$this->registerCssFile("@web/css/ajax.css");
?>
<div class="build-view-ajax">
	<?php $userTurn 	= $CurrentTurnData->getTurnUserId() == $User->getId();?>
	<?php $toBuildArray = $GameData[$land_id_array]->getGameDataBuildingsToBuild($GameData[$land_id_array]->getGameDataRessourceId(), $BuildingData); ?>
	<?php if($userTurn): ?>
		<?php if($CurrentTurnData->getTurnGold() > 0): ?>
			<table style="width:100%;table-layout:fixed;">
				<tr>
					<td style="padding: 4px;text-align:center;"><font size='4'><?= Yii::t('ajax', 'Text_Ressource_In_Land'); ?> <?= $Land[$land_id]->getLandName() ?> : </font>
					<font size='3' color="black">
						 <?php if($GameData[$land_id_array]->getGameDataRessourceId() > 0 && $Ressource[$GameData[$land_id_array]->getGameDataRessourceId()]->getRessourceImage() != ""): ?>
	                         <?= "<img src='".$Ressource[$GameData[$land_id_array]->getGameDataRessourceId()]->getRessourceImageUrl()."' height='20px' width='20px'>".$Ressource[$GameData[$land_id_array]->getGameDataRessourceId()]->getRessourceName(); ?>
	                    <?php else: ?>
	                    	<?= Yii::t('ajax', 'Text_Land_No_Ressource'); ?>
	                    <?php endif; ?>
					</font></td>
				</tr>
				<tr>
					<td>
						<div class="div-center"><table style="width:100%;table-layout:fixed;">
							<tr>
								<td style="padding: 4px;text-align:center;"><font size='4'><?= Yii::t('ajax', 'Text_Build_In_Land'); ?> <?= $Land[$land_id]->getLandName() ?> : </font></td>
								<?php $i = 0; ?>
								<?php foreach($GameData[$land_id_array]->getGameDataBuildings() as $building): ?>
									<?php if($building != null && $BuildingData[$building]->getBuildingId() > 0): ?>
										<td style="padding: 4px;"><font size='3' color="black">
												<i class="<?= $BuildingData[$building]->getBuildingImg() ?>"></i>
												<?= Html::tag('span', $BuildingData[$building]->getBuildingName(), [
									                          'title'=> $BuildingData[$building]->getBuildingDescription(),
									                          'data-toggle'=>'tooltip',
									                          'data-placement' => 'auto',
									                          'style'=>'text-decoration: none; cursor:pointer;'
									            ]); ?>
							            <?php $i++; ?>
							            </font></td>
						            <?php endif; ?>
						        <?php endforeach; ?>
					            <?php if($i == 0): ?>
			                    	<td style="padding: 4px;text-align:center;"><font size='3' color="black"><?= Yii::t('ajax', 'Text_Land_No_Building'); ?></font></td>
			                    <?php endif; ?>
			              </tr>
					</table></div>
				</tr>
				<tr>
					<td>
					<div class="div-center"><table style="width:100%;table-layout:fixed;">
							<tr>
								<td style="padding: 4px;text-align:center;"><font size='4'><?= Yii::t('ajax', 'Text_Build_Able_Land'); ?> <?= $Land[$land_id]->getLandName() ?> : </font></td>
							</tr>
							<?php $i = 0; ?>
							<?php foreach($toBuildArray as $building): ?>
								<?php if($building->getBuildingId() > 0): ?>
									<tr><td style="width:100%;"><font size='3' color="black">
											<i class="<?= $building->getBuildingImg() ?>"></i>
											<?= Html::tag('span', $building->getBuildingName(), [
								                          'title'=> $building->getBuildingDescription(),
								                          'data-toggle'=>'tooltip',
								                          'data-placement' => 'auto',
								                          'style'=>'text-decoration: none; cursor:pointer;'
								            ]); ?>
									            <?= "<a href='#StartBuild' class='buy_action_link btn btn-success' i='".$land_id."' building='".$building->getBuildingName()."' style='text-decoration:none;'>
												<i class='fa fa-gavel'></i> ".Yii::t('ajax', 'Button_Land_Build')." ".$building->getBuildingName()."</a>"; ?>
							            <?php $i++; ?>    
							       	</font></td></tr>
					            <?php endif; ?>
				        	<?php endforeach; ?>
				            <?php if($i == 0): ?>
		                    	<tr><td style="padding: 4px;text-align:center;"><font size='3' color="black"><?= Yii::t('ajax', 'Text_Land_Nothing_To_Build'); ?></font></td></tr>
		                    <?php endif; ?>
					</table></div>
				</tr>
			</table>
		<?php else: ?>
			<div class="alert alert-danger" style="text-align:center;">
				<font size='3'>
					<?= Yii::t('ajax', 'Text_No_More_Money'); ?>
				</font>
			</div>
		<?php endif; ?>
	<?php else: ?>
		<div class="alert alert-danger" style="text-align:center;">
			<font size='3'>
				<?= Yii::t('ajax', 'Text_Not_User_Turn'); ?>
			</font>
		</div>
	<?php endif; ?>
</div>