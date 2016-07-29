<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;


class TestController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['mdp', 'username', 'newturn', 'generateallcolors'],
                'rules' => [
                    [
                        'allow' => true, // have access (true to generateallcolors)
                        'roles' => ['@'], // Connected
                    ],
                    [
                        'allow' => true, // No access (true to generateallcolors)
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

    public function actionMdp()
    {
        return $this->render('mdp');
    }

    public function actionUsername()
    {
    	return $this->render('username');
    }

    public function actionNewturn()
    {
    	return $this->render('newturn');
    }

    public function actionGenerateallcolors()
    {
    	return $this->render('generateallcolors');
    }
}
