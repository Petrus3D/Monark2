<?php 

use app\models\Turn;


$turn = new Turn();
$new_turn = $turn->NewTurn(20, Yii::$app->session['User']->getUserID());



?>