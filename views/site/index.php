<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name['name'];
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?php echo Yii::t('site', 'Home_Monark_Welcome') ?></h1>

        <p class="lead"><?php echo Yii::t('site', 'Home_Monark_Description') ?></p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2><?php echo Yii::t('site', 'Button_Registration') ?></h2>

                <p><?php echo Yii::t('site', 'Home_Registration_Description') ?></p>

                <p><a class="btn btn-default" href=""><?php echo Yii::t('site', 'Button_Registration') ?></a></p>
            </div>
            <div class="col-lg-4">
                <h2><?php echo Yii::t('site', 'Button_Login') ?></h2>

                <p><?php echo Yii::t('site', 'Home_Login_Description') ?></p>

                <p><a class="btn btn-default" href=""><?php echo Yii::t('site', 'Button_Login') ?></a></p>
            </div>
            <div class="col-lg-4">
                <h2><?php echo Yii::t('site', 'Button_Tutorial') ?></h2>

                <p><?php echo Yii::t('site', 'Home_Tutorial_Description') ?></p>

                <p><a class="btn btn-default" href=""><?php echo Yii::t('site', 'Button_Tutorial') ?></a></p>
            </div>
        </div>

    </div>
</div>
