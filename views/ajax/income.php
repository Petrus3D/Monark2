<?php

/* @var $this yii\web\View */
/* @var $model app\models\Ajax */
?>
<li><a href='#'>+ <?= ($incomeLand) ?> (<?= Yii::t('ajax', 'Text_Income_By_Lands') ?>)</a></li>
<li><a href='#'>+ <?= ($incomeBuilding) ?> (<?= Yii::t('ajax', 'Text_Income_By_Buildings') ?>)</a></li>
<li><a href='#'><?= Yii::t('ajax', 'Text_Total') ?> + <?= ($incomeLand + $incomeBuilding) ?> </a></li>