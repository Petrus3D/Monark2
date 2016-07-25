<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */
$this->registerCssFile("@web/css/ajax.css");
?>
<div class="buy-action-view-ajax">
	<?php if($error): ?>
		troupes achetées
	<?php else: ?>
		<?= Yii::t('ajax', $error); ?>
	<?php endif; ?>
</div>