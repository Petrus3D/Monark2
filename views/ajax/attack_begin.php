<?php

use yii\helpers\Html;
use app\models\Land;

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */
$this->registerCssFile("@web/css/ajax.css");
?>
<div class="attack-view-ajax">
	<?php $userTurn 	= $CurrentTurnData->getTurnUserId() == $User->getId();?>
	<?php $land_units 	= Land::LandCountUnitsToArray($GameData[$land_id]->getGameDataUnits()); ?>
	<?php $landUser 	=  $GameData[$land_id]->getGameDataUserId() == $User->getId(); ?>
	<?php if(!$landUser): ?>
		<?php if($userTurn): ?>
			<table class="table-no-style" style="width:100%;table-layout: auto;">
				<tr>
					<td><font size='4'><?= Html::tag('span', Yii::t('ajax', 'Text_Units_In')." ".$Land[$land_id]->getLandName()." :", [
					                          'title'=> $GameData[$land_id]->getGameDataUnits()." ".Yii::t('ajax', 'Text_Units'),
					                          'data-toggle'=>'tooltip',
					                          'data-placement' => 'auto',
					                          'style'=>'text-decoration: none; cursor:pointer;'
					            ]); ?></font>
					<font size='3' color="black">
	                     <?php for($i=1; $i <= $land_units['canon']; $i++): ?>
	                       	<img src='img/game/canon.png' class='land_canon' style=<?= "'left:".$i."px;'"; ?>>
	                   	<?php endfor; ?>
	                    <?php for($i=1; $i <= $land_units['horseman']; $i++): ?>
	                       	<img src='img/game/horseman.png' class='land_horseman' style=<?= "'left:".$i."px;'"; ?>>
	                    <?php endfor; ?>
	                    <?php for($i=1; $i <= $land_units['soldier']; $i++): ?>
	                    	<img src='img/game/soldier.png' class='land_soldier' style=<?= "'left:".$i."px;'"; ?>>
	                  	<?php endfor; ?>
					</font></td>
				</tr>
				<tr>
					<td>
					<table class="list-spaced" style="text-align:center;">
							<tr>
								<td style="padding: 4px;"><font size='4'><?= Yii::t('ajax', 'Text_Atk_Able_Land'); ?></font></td>
								<td style="padding: 4px;"><font size='4'><?= Yii::t('ajax', 'Text_Atk_Units_NB'); ?></font></td>
							</tr>
							<?php $i = 0; ?>
							<?php foreach($frontierData as $frontier_land_id): ?>
								<?php if($frontier_land_id > 0 && $GameData[$frontier_land_id]->getGameDataUserId() == $User->getId() && $GameData[$frontier_land_id]->getGameDataUnits() > 1): ?>
									<tr>
										<td><font size='3' color="black">
											<?= $Land[$frontier_land_id]->getLandName() ?> (<?= $GameData[$frontier_land_id]->getGameDataUnits() ?>)</font>
										</td>
										<td id="td-select_unit_number">
											<input style="color: #C0C0C0;" type="number" id="input_select_unit_number" name="input_select_unit_number" 
											value=<?= "'".($GameData[$frontier_land_id]->getGameDataUnits() - 1)."'" ?> min="1" 
											max=<?= "'".($GameData[$frontier_land_id]->getGameDataUnits() - 1)."'" ?> >
										</td>
										<td><font size='3' color="black">
									       <?= "<a href='#StartAtk' class='atk_action_link btn btn-danger' i='".$land_id."' atk_i='".$frontier_land_id."' style='text-decoration:none;'>
											<i class='fa fa-bolt'></i> ".Yii::t('ajax', 'Button_Land_Atk_With')." ".$Land[$frontier_land_id]->getLandName()." </a>"; ?> 
							            </font>   
							       	</td></tr>
							    	<?php $i++; ?> 
					            <?php endif; ?>
				        	<?php endforeach; ?>
				            <?php if($i == 0): ?>
		                    <tr>
		                    	<td style="padding: 4px;text-align:center;"><font size='3' color="black">
		                    	<?= Yii::t('ajax', 'Text_Land_No_User_Frontier'); ?></font>
		                    	</td>
		                    </tr>
		                    <?php endif; ?>
					</table>
				</tr>
			</table>
		<?php else: ?>
			<div class="alert alert-danger" style="text-align:center;">
				<font size='3'>
					<?= Yii::t('ajax', 'Text_Not_User_Turn'); ?>
				</font>
			</div>
		<?php endif; ?>
	<?php else: ?>
		<div class="alert alert-danger" style="text-align:center;">
			<font size='3'>
				<?= Yii::t('ajax', 'Text_Are_Owner'); ?>
			</font>
		</div>
	<?php endif; ?>
</div>