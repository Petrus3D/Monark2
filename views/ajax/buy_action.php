<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */
$this->registerCssFile("@web/css/ajax.css");
?>
<div class="buy-action-view-ajax">
	<?php if($error === true): ?>
		troupes achetées
	<?php else: ?>
		<div class="alert alert-danger" style="text-align:center;">
			<font size='3'>
				<?= Yii::t('ajax', $error); ?>
			</font>
		</div>
	<?php endif; ?>
</div>