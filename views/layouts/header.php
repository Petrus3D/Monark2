<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">' . Yii::$app->name['short'] . '</span><span class="logo-lg">' . Yii::$app->name['name'] . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
				<?php if(!Yii::$app->user->isGuest): ?>
                	<?php if(isset(Yii::$app->session['Game']) && Yii::$app->session['Game']->getGameStatut() == 50): ?>
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
	                	<li id='turn'>
	                		<?php if(Yii::$app->session['MapData']['CurrentTurnData']->getTurnUserId() == Yii::$app->session['User']->getUserID()): ?>
					          		<a href='#EndTurn' id='end_of_turn_link' class="dropdown-toggle" data-toggle="dropdown" style='text-decoration:none;padding: 7px;'><div class='btn btn-success'><?= Yii::t('map', 'Button_Turn_Own') ?></div></a>
					        <?php else: ?>
						        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
						        	<font size='3'> Veuillez patienter, tour de </font>
	    							<font size='4' color='#<?=Yii::$app->session['Color'][Yii::$app->session['MapData']['GamePlayer'][Yii::$app->session['User']->getUserID()]->getGamePlayerColorId()]->getColorCss()?>'>
	            						<?=Yii::$app->session['MapData']['UserData'][Yii::$app->session['MapData']['GamePlayer'][Yii::$app->session['User']->getUserID()]->getGamePlayerUserId()]->getUserName()?>
	            					</font>
	            				</a>
					        <?php endif; ?>
	                	</li>
	                	<li id='current_gold'>
	                		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				          		<font size='3'>Or : <i class="fa fa-usd"> <?= Yii::$app->session['MapData']['LastTurnData']->getTurnGold() ?> </i></font>
				          	</a>
	                	</li>
	                	<li id='gold_per_turn'>
	                		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				           		<font size='3'> Revenu : <i class="fa fa-usd"> <?= $count_lands ?> / tr </i></font>
				           	</a>
	                	</li>
	                	<li id='count_region'>
	                		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				          		<font size='3'>Possessions : <?= $count_lands ?> </font>
				          	</a>
	                	</li>
	                	<li id='count_units'>
	                		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				          		<font size='3'>Unités : <?= $count_units ?> </font>
				          	</a>
	                	</li>
	                	<li class="dropdown messages-menu">
				            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				              <i class="fa fa-envelope-o"></i>
				              <span class="label label-success">4</span>
				            </a>
	                	</li>
	                	<li class="dropdown chat-menu">
				            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				              <i class="fa fa-weixin"></i>
				              <span class="label label-warning">4</span>
				            </a>
	                	</li>
	                	<li class="dropdown alert-menu">
				            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				              <i class="fa fa fa-flag-o"></i>
				              <span class="label label-danger">4</span>
				            </a>
	                	</li>
                	<?php endif; ?>
                	<li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <li class="dropdown user user-menu" style="background: #<?= Yii::$app->session['Color'][Yii::$app->session['MapData']['GamePlayer'][Yii::$app->session['User']->getUserID()]->getGamePlayerColorId()]->getColorCSS() ?>;">
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
