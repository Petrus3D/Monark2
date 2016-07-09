<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

// Forms
use app\models\forms\GamePlayer\GamePlayerForm;
use app\models\forms\Land\LandForm;

/**
 * AjaxController implements the CRUD actions for Ajax model.
 */
class AjaxController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles'=>['@'],
                    ],
                    [
                        'allow' => false, // No access
                        'roles'=>['?'], // Guests
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Game models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    
}
