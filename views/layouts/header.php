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
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><?php print(Yii::$app->session['User']->getUsername()); ?></span>
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
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
