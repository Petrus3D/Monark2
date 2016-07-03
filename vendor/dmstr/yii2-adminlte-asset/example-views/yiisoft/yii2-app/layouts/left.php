<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <?php if(!Yii::$app->user->isGuest): ?>
        <div class="user-panel">
            <div class="pull-left image">
                <!--<img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>-->
                <br><br>
            </div>
            <div class="pull-left info">
                <p>User TEST</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <?php endif; ?>

        <!-- search form --><!--
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => Yii::t('menu', 'Title_Menu'), 'options' => ['class' => 'header']],
                    ['label' => Yii::t('menu', 'Title_Home'), 'icon' => 'fa fa-home', 'url' => ['/']],
                    

                    /* Guest */
                    ['label' => Yii::t('menu', 'Title_Game'), 'icon' => 'fa fa-gamepad', 'url' => ['site/game'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => Yii::t('menu', 'Title_Sign'), 'icon' => 'fa fa-sign-in', 'url' => ['site/sign'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => Yii::t('menu', 'Title_Login'), 'icon' => 'fa fa-unlock', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    
                    /* Connected */
                    ['label' => Yii::t('menu', 'Title_Compagny'), 'icon' => 'fa fa-suitcase', 'url' => '#', 'visible' => !Yii::$app->user->isGuest,
                        'items' => [
                            ['label' => Yii::t('menu', 'Title_GlobalDashboard'), 'icon' => 'fa fa-dashboard', 'url' => ['corp/globalboard'],],
                            ['label' => "Entreprise 1", 'icon' => 'fa fa-building', 'url' => '#',
                                'items' => [
                                    ['label' => Yii::t('menu', 'Title_Dashboard'), 'icon' => 'fa fa-dashboard', 'url' => ['corp/board', 'id' => 1],],
                                    ['label' => Yii::t('menu', 'Title_Finances'), 'icon' => 'fa fa-dollar', 'url' => ['corp/finances', 'id' => 1],],
                                    ['label' => Yii::t('menu', 'Title_Product'), 'icon' => 'fa fa-legal', 'url' => ['corp/product', 'id' => 1],],
                                    ['label' => Yii::t('menu', 'Title_Research'), 'icon' => 'fa fa-search', 'url' => ['corp/research', 'id' => 1],],
                                    ['label' => Yii::t('menu', 'Title_Employe'), 'icon' => 'fa fa-users', 'url' => ['corp/employe', 'id' => 1],],
                                ],
                            ],
                        ],
                    ],
                    ['label' => Yii::t('menu', 'Title_Investment'), 'icon' => 'fa fa-briefcase', 'url' => '#', 'visible' => !Yii::$app->user->isGuest,
                        'items' => [
                            ['label' => Yii::t('menu', 'Title_Money'), 'icon' => 'fa fa-money', 'url' => ['my/money'],],
                            ['label' => Yii::t('menu', 'Title_Create'), 'icon' => 'fa fa-plus', 'url' => ['corp/create'],],
                            ['label' => Yii::t('menu', 'Title_Trading'), 'icon' => 'glyphicon glyphicon-shopping-cart', 'url' => ['global/trading'],],
                        ],
                    ],
                    ['label' => Yii::t('menu', 'Title_World'), 'icon' => 'fa fa-globe', 'url' => '#', 'visible' => !Yii::$app->user->isGuest,
                        'items' => [
                            ['label' => Yii::t('menu', 'Title_Rank'), 'icon' => 'fa fa-star', 'url' => ['global/rank'],],
                            ['label' => Yii::t('menu', 'Title_Stats'), 'icon' => 'fa fa-line-chart', 'url' => ['stats/global'],],
                            ['label' => Yii::t('menu', 'Title_Cities'), 'icon' => 'glyphicon glyphicon-screenshot', 'url' => ['global/cities'],],
                        ],
                    ],

                    ['label' => Yii::t('menu', 'Title_Tutorial'), 'icon' => 'fa fa-question', 'url' => ['site/tutorial'], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => Yii::t('menu', 'Title_Logout'), 'icon' => 'fa fa-sign-out', 'url' => ['site/logout'], 'visible' => !Yii::$app->user->isGuest],
                ],
            ]
        ) ?>

    </section>

</aside>
