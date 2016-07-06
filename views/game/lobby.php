<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title =  Yii::t('game_player', 'Title_Lobby_{params}', ['params' => Yii::$app->session['Game']->getGameName()]);
?>

<div class="game-lobby">

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
                'attribute' => Yii::t('game_player', 'Tab_User_Name'),
                'value'     => function ($model, $key, $index, $column) {
                    return $model->game_player_user_id;
                },
            ],
            [
                'attribute' => Yii::t('game_player', 'Tab_Color_Name'),
                'value'     => function ($model, $key, $index, $column) use ($colorList){
                    return $colorList[$model->game_player_color_id]->getColorName();
                },
            ],
            [
	            'filter' => false,
            	'format'    => 'raw',
	            'attribute' => Yii::t('game_player', 'Tab_Region_Player'),
	            'value'     => function ($model, $key, $index, $column) use ($continentList, $continentSQl){
	           		return Html::activeDropDownList($model, 'game_player_region_id',
           				ArrayHelper::map($continentSQl,
           					function($model, $defaultValue) {
           						return Yii::$app->urlManager->createUrl(['gameplayer/show', 'region' => $model->continent_id]);
           					},
           					function($model, $defaultValue) {
           						return Yii::t('continent_name', $model->continent_name);
           					}
           				),
           				[
           				'prompt'	=> Yii::t('continent_name', $continentList[$model->game_player_region_id]->getContinentName()),
           				'class'		=> 'selectpicker',
           				'onchange'	=> 'location = "'.Url::to().'&i='.$model->game_player_user_id.'";',
	           		]);
	            },
            ],
            [
	            'filter' => false,
	            'value'     => function ($model, $key, $index, $column) {
	            return $model->game_player_region_id;
	            },
            ],
            /*[
	            'filter' => false,
	            'attribute' => Yii::t('game_player', 'Tab_Create_Time'),
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
            ],*/
            /*[
            'filter' => false,
            'attribute' => Yii::t('game', 'Tab_Rejoin'),
            'format'    => 'raw',
            'value'     => function ($model, $key, $index, $column){
            	if($model->game_statut == 0){
            		if(!isset($player_exist_game) OR $player_exist_game['quit'] <= 1){
            			return "<center><table style='border-collapse: separate;border-spacing: 5px;'><tr>"
            			."<td>".Html::a(Yii::t('game', 'Button_Game_Enter')." <i class='fa fa-sign-in'></i>", ['/game/join', 'gid' => $model->game_id], ['class'=>'btn btn-success'])."</td>"
            			."<td>".Html::a(Yii::t('game', 'Button_Game_Spec')." <i class='fa fa-eye'></i>", ['/game/spec', 'gid' => $model->game_id], ['class'=>'btn btn-primary'])."</td>"
            			."</tr></table></center>";
            		/*}else{
            			return "<center><div class='btn btn-danger'>".Yii::t('game', 'Button_Game_Ban')."</div></center>";
            		}
            	}elseif($model->game_statut >= 25){
            		return "<center>".Html::a(Yii::t('game', 'Button_Game_Return'), ['/game/join', 'gid' => $model->id], ['class'=>'btn btn-success'])."</center>";
            	}elseif($model->game_statut >= 25){
            		return "<center>".Html::a(Yii::t('game', 'Button_Game_Spec'), ['/game/spec', 'gid' => $model->id], ['class'=>'btn btn-primary'])."</center>";
            	}elseif($model->game_statut > 99){
            		return "<center>".Yii::t('game', 'Button_Game_End')."</center>";
            	}
            },
            ],*/
        ],
    ]); ?>

</div>