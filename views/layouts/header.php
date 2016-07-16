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
        
        <?php if(!Yii::$app->user->isGuest): ?>
        <div id='navbar-menu-global' class="navbar-custom-menu">
           		<ul class="nav navbar-nav">
           			<li class="dropdown user user-menu">
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
                
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-plus"></i></a>
                </li>
           	</ul>
        </div>
        	<?php if(isset(Yii::$app->session['Game']) && Yii::$app->session['Game']->getGameStatut() == 50 && Yii::$app->session['MapData'] != null): ?>           	        
        		<div id='navbar-menu-game' class="navbar-custom-menu">
            		<?php Pjax::begin(['id' => 'navbar-menu-game-data']); ?>
            		<ul class="nav navbar-nav">
	                	<!-- User Account: style can be found in dropdown.less -->
					 		<li id='turn' class="header_game_content">
							    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="text-decoration:none;">
		                		<?php if(Yii::$app->session['MapData']['CurrentTurnData']->getTurnUserId() == Yii::$app->session['User']->getUserID()): ?>
						          		<a href='#EndTurn' id='end_of_turn_link' class="btn btn-success" style='padding:7px;'>	
						          			<?= Yii::t('map', 'Button_Turn_Own') ?>
						          		</a>
						        <?php else: ?>
						        	<font size='3' color='white'> Veuillez patienter, tour de </font>
	    							<font size='4' color='#<?=Yii::$app->session['Color'][Yii::$app->session['MapData']['GamePlayer'][Yii::$app->session['MapData']['CurrentTurnData']->getTurnUserId()]->getGamePlayerColorId()]->getColorCss()?>'>
	            						<?=Yii::$app->session['MapData']['UserData'][Yii::$app->session['MapData']['GamePlayer'][Yii::$app->session['MapData']['CurrentTurnData']->getTurnUserId()]->getGamePlayerUserId()]->getUserName()?>
	            					</font>
						        <?php endif; ?>
						        </a>
		                	</li>
		                	<li id='current_gold'>
		                		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					          		<font size='3'>Or : <i class="fa fa-usd"> <?= Yii::$app->session['MapData']['LastTurnData']->getTurnGold() ?> </i></font>
					          	</a>
		                	</li>
		                	<li id='gold_per_turn' class="header_game_content">
		                		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					           		<font size='3'> Revenu : <i class="fa fa-usd"> <?= Yii::$app->session['MapData']['CountLands'] ?> / tr </i></font>
					           	</a>
		                	</li>
		                	<li id='count_region' class="header_game_content">
		                		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					          		<font size='3'>Possessions : <?= Yii::$app->session['MapData']['CountLands'] ?> </font>
					          	</a>
		                	</li>
		                	<li id='count_units' class="header_game_content">
		                		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					          		<font size='3'>Unités : <?= Yii::$app->session['MapData']['CountUnits'] ?> </font>
					          	</a>
		                	</li>
		                	<li id='header_messages' class="dropdown messages-menu">
					            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
						            <i class="fa fa-envelope-o"></i>
						            <span class="label label-success">4</span>
					            </a>
		                	</li>
		                	<li id='header_chat' class="dropdown chat-menu">
					            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
						            <i class="fa fa-weixin"></i>
						            <span class="label label-warning">4</span>
					            </a>
		                	</li>
		                	<li id='header_alert' class="dropdown alert-menu">
					            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
					              	<i class="fa fa fa-flag-o"></i>
					              	<span class="label label-danger">4</span>
					            </a>
		                	</li>
	                	
	                		<li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
                	</ul>
                	<?php Pjax::end(); ?>
                </div>
        <?php endif; ?>
      <?php endif; ?>
        <?php //<ul class="nav navbar-nav"><li class="dropdown user user-menu" style="background: #<?= Yii::$app->session['Color'][Yii::$app->session['MapData']['GamePlayer'][Yii::$app->session['User']->getUserID()]->getGamePlayerColorId()]->getColorCSS() ;">?>       
    </nav>
</header>
