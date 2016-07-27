<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */
$this->registerCssFile("@web/css/ajax.css");
?>
<?php foreach($lastBuy as $buy): ?>
	<li>- <?= $buy->getBuyUnitsNb() ?> <i class="fa fa-usd"></i></li>
<?php endforeach; ?>