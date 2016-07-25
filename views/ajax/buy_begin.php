<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */
$this->registerCssFile("@web/css/ajax.css");
?>
<div class="buy-view-ajax">
	<?php $userTurn = $CurrentTurnData->getTurnUserId() == $User->getId();?>
	<?php if($userTurn): ?>
		<?php if($CurrentTurnData->getTurnGold() > 0): ?>
			<table>
				<tr>
					<td style="padding: 4px;"><font size='3'>Pays d'arrivé : </font>
					<font size='4'></font></td>
				</tr>
				<tr>
				<tr>
					<td id='td-show-units-def' style="padding: 4px;"><font size='3'>Unités en <?= $Land[$land_id]->getLandName() ?> : </font><font size='4'><?= $GameData[$land_id_array]->getGameDataUnits() ?> unité(s) présente(s)</font></td>
				</tr>
				<tr>
					<td id="td-select_unit_number" style="padding: 4px;">
						<font size='3'>Troupes à acheter : </font>
						<input type="number" id="input_select_unit_number" name="input_select_unit_number" 
						value=<?= "'".$CurrentTurnData->getTurnGold()."'" ?> min="0" 
						max=<?= "'".$CurrentTurnData->getTurnGold()."'" ?> >
					</td>
				</tr>
			</table>
					<center>
					<?= "<a href='#StartBuy' class='start_buy_link' i='".$land_id."' style='text-decoration:none;'><div class='btn btn-success'>Acheter les troupes</div></a>"; ?>
					</center>
		<?php else: ?>
				</tr>
			</table>
			<br>
			<div class="alert alert-danger" style="text-align:center;">
				<font size='4'>
					<?= Yii::t('ajax', 'Text_Buy_Not_More_Money'); ?>
				</font>
			</div>
		<?php endif; ?>
	<?php else: ?>
		<?= Yii::t('ajax', 'Text_Not_User_Turn'); ?>
	<?php endif; ?>
</div>