<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
$this->title = Yii::t('game', 'Title_Loby');
?>

<div class="game-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
       //'filterModel' => $searchModel,
    	'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => Yii::t('game', 'Tab_Game_Name'),
                'value'     => function ($model, $key, $index, $column) {
                    return $model->decryptGameName($model->game_name);
                },
            ],
            [
                'attribute' => Yii::t('game', 'Tab_Owner_Name'),
                'value'     => function ($model, $key, $index, $column) {
                    return $model->getUserOwner($model->game_owner_id)->getUserName();
                },
            ],
            [
	            'filter' => false,
	            'attribute' => Yii::t('game', 'Tab_Max_Player'),
	            'value'     => function ($model, $key, $index, $column) {
	           		return "X / ".$model->game_max_player;
	            },
            ],
            [
	            'filter' => false,
	            'attribute' => Yii::t('game', 'Tab_Create_Time'),
	            'value'     => function ($model, $key, $index, $column){
		            if(time() - $model->game_create_time <= 60){
		            	return Yii::t('game', 'Text_Second_{nb}', ['nb' => date('s', time() - $model->game_create_time)]);
		            }elseif(time() - $model->game_create_time <= 60*60){
		            	return Yii::t('game', 'Text_Min_{nb}', ['nb' => date('i', time() - $model->game_create_time)]);
		            }elseif(time() - $model->game_create_time <= 60*60*24){
		            	return Yii::t('game', 'Text_Hour_{nb}', ['nb' => date('H', time() - $model->game_create_time)]);
		            }elseif(time() - $model->game_create_time <= 60*60*24*2){
		            	return Yii::t('game', 'Text_Yesterday');
		            }elseif(time() - $model->game_create_time <= 60*60*24*7){
		            	return Yii::t('game', 'Text_Week');
		            }else{
		            	return time().date(Yii::t('game', 'Text_Date'), $model->game_create_time);
		            }
	            },
            ],
            [
            	'filter' => false,
            	'attribute' => Yii::t('game', 'Tab_Rejoin'),
            	'format'    => 'raw',
            	'value'     => function ($model, $key, $index, $column){
            	
            	},
            ],
        ],
    ]); ?>

</div>