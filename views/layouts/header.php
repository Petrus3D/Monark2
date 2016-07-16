<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
/* @var $this \yii\web\View */
/* @var $content string */
$refresh_time = Yii::$app->session['MapData']['RefreshTime'];
?>
<header class="main-header">

    <?= Html::a('<span class="logo-mini">' . Yii::$app->name['short'] . '</span><span class="logo-lg">' . Yii::$app->name['name'] . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        
        <div id='navbar-menu' class="navbar-custom-menu">
			
            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
				<?php if(!Yii::$app->user->isGuest): ?>
                	<?php if(isset(Yii::$app->session['Game']) && Yii::$app->session['Game']->getGameStatut() == 50 && Yii::$app->session['MapData'] != null): ?>
	                	<?php Pjax::begin(['id' => 'header_game_content']); ?>
	                	<?php 
	                		$count_lands = 0;
	                		$count_units = 0;
	                		foreach (Yii::$app->session['MapData']['GameData'] as $data){
	                			if($data->getGameDataUserId() == Yii::$app->session['User']->getUserID()){
	                				$count_units +=	$data->getGameDataUnits();
	                				$count_lands++;
	                			}
	                		}
	                	?> 
	                	<?php Pjax::end(); ?>               	
	                	<li id='turn' class="header_game_content">
	                		<?php Pjax::begin(['id' => 'header_game_content']); ?>
						        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="text-decoration:none;height:100%;">
	                		<?php if(Yii::$app->session['MapData']['CurrentTurnData']->getTurnUserId() == Yii::$app->session['User']->getUserID()): ?>
					          		<a href='#EndTurn' id='end_of_turn_link' class="btn btn-success" style='padding:15px;'>	
					          			<?= Yii::t('map', 'Button_Turn_Own') ?>
					          		</a>
					        <?php else: ?>
					        	<font size='3' color='white'> Veuillez patienter, tour de </font>
    							<font size='4' color='#<?=Yii::$app->session['Color'][Yii::$app->session['MapData']['GamePlayer'][Yii::$app->session['MapData']['CurrentTurnData']->getTurnUserId()]->getGamePlayerColorId()]->getColorCss()?>'>
            						<?=Yii::$app->session['MapData']['UserData'][Yii::$app->session['MapData']['GamePlayer'][Yii::$app->session['MapData']['CurrentTurnData']->getTurnUserId()]->getGamePlayerUserId()]->getUserName()?>
            					</font>
					        <?php endif; ?>
					        </a>
					        <?php Pjax::end(); ?>
	                	</li>
	                	<li id='current_gold'>
	                		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                			<?php Pjax::begin(['id' => 'header_game_content']); ?>
				          		<font size='3'>Or : <i class="fa fa-usd"> <?= Yii::$app->session['MapData']['LastTurnData']->getTurnGold() ?> </i></font>
				          		<?php Pjax::end(); ?>
				          	</a>
	                	</li>
	                	<li id='gold_per_turn' class="header_game_content">
	                		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                			<?php Pjax::begin(['id' => 'header_game_content']); ?>
				           		<font size='3'> Revenu : <i class="fa fa-usd"> <?= $count_lands ?> / tr </i></font>
				           		<?php Pjax::end(); ?>
				           	</a>
	                	</li>
	                	<li id='count_region' class="header_game_content">
	                		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                			<?php Pjax::begin(['id' => 'header_game_content']); ?>
				          		<font size='3'>Possessions : <?= $count_lands ?> </font>
				          		<?php Pjax::end(); ?>
				          	</a>
	                	</li>
	                	<li id='count_units' class="header_game_content">
	                		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                			<?php Pjax::begin(['id' => 'header_game_content']); ?>
				          		<font size='3'>Unités : <?= $count_units ?> </font>
				          		<?php Pjax::end(); ?>
				          	</a>
	                	</li>
	                	<li class="dropdown messages-menu">
				            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				            	<?php Pjax::begin(['id' => 'header_game_content']); ?>
					            <i class="fa fa-envelope-o"></i>
					            <span class="label label-success">4</span>
					            <?php Pjax::end(); ?>
				            </a>
	                	</li>
	                	<li class="dropdown chat-menu">
				            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
					            <?php Pjax::begin(['id' => 'header_game_content']); ?>
					            <i class="fa fa-weixin"></i>
					            <span class="label label-warning">4</span>
					            <?php Pjax::end(); ?>
				            </a>
	                	</li>
	                	<li class="dropdown alert-menu">
				            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				            	<?php Pjax::begin(['id' => 'header_game_content']); ?>
				              	<i class="fa fa fa-flag-o"></i>
				              	<span class="label label-danger">4</span>
				              	<?php Pjax::end(); ?>
				            </a>
	                	</li>
                	
                	<li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <li class="dropdown user user-menu" style="background: #<?= Yii::$app->session['Color'][Yii::$app->session['MapData']['GamePlayer'][Yii::$app->session['User']->getUserID()]->getGamePlayerColorId()]->getColorCSS() ?>;">
                    <?php else: ?>
                <li class="dropdown user user-menu">
                    <?php endif; ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><font size='3' color="black"><?php print(Yii::$app->session['User']->getUsername()); ?></font></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <p>
                                <?php print(Yii::$app->session['User']->getUsername()); ?>
                                <!--<small><?php print(Yii::$app->session['User']->getUsername()); ?></small>-->
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#"><?php print(Yii::t('header', 'Profile')); ?></a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#"><?php print(Yii::t('header', 'Stats')); ?></a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#"><?php print(Yii::t('header', 'Friends')); ?></a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a(
                                    Yii::t('header', 'Language'),
                                    ['/site/lang'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                            <!--<div class="pull-center">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>-->
                            <div class="pull-right">
                                <?= Html::a(
                                    Yii::t('header', 'Logout'),
                                    ['/user/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <?php endif; ?>
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-plus"></i></a>
                </li>
            </ul>            
        </div>
    </nav>
</header>
