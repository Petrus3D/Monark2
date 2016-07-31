<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */
$this->registerCssFile("@web/css/ajax.css");
?>
<div class="atk-action-view-ajax">
	<?php if($error === true): ?>
		attaque terminée
		<br>engagé en attaque : <?= $atk_result['atk_engage_units'] ?>
		<br>engagé en defense : <?= $atk_result['def_engage_units'] ?>
		<br>résultat en attaque : <?= $atk_result['atk_result_units'] ?>
		<br>résultat en defense : <?= $atk_result['def_result_units'] ?>
		<br>dés attaquant : <?= $atk_result['thimble_atk'] ?>
		<br>dés attaquant : <?= $atk_result['thimble_def'] ?>
		<br>nb round : <?= $atk_result['fight_nb'] ?>
		<!--<div class="div-center">
			<?= "<a href='#Build' class='build_link' i='".$land_id."' style='text-decoration:none;'><span class='btn btn-success'><i class='fa fa-plus'></i> ".Yii::t('ajax', 'Text_Build_Other')." </span></a>"; ?>
		</div>-->
	<?php else: ?>
		<div class="alert alert-danger" style="text-align:center;">
			<font size='3'>
				<?= Yii::t('ajax', $error); ?>
			</font>
		</div>
		<div class="div-center">
			<?= "<a href='#Atk' class='atk_link' i='".$land_id."' style='text-decoration:none;'><span class='btn btn-success'><i class='fa fa-arrow-left'></i> ".Yii::t('ajax', 'Button_Return')." </span></a>"; ?>
		</div>
	<?php endif; ?>
</div>