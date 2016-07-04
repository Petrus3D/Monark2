<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'lang'],
                'rules' => [
                    [
                        'allow' => true, // have access
                        'roles' => ['@'], // Connected
                    ],
                    [
                        'allow' => true, // No access
                        'roles'=>['?'], // Guests
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGame()
    {
        return $this->render('game');
    }
    
    public function actionLang()
    {
    	$urlparams = Yii::$app->request->queryParams;
    	$lang_ok   = array('fr', 'en');
    	if(array_key_exists('lang', $urlparams) AND in_array($urlparams['lang'], $lang_ok)){
    		Yii::$app->session['lang'] = $urlparams['lang'];
    		Yii::$app->session->setFlash('success', Yii::t('site', 'Success_Change_Lang'));
    	}
    	return $this->render('lang');
    }

}
