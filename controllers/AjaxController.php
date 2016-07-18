<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Turn;
use app\classes\Access;

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
										'actions' => ['newturn'],
										'allow' => Access::UserIsInStartedGame(), // Into a started game
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
								'logout' => ['post'],
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

    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     */
	public function actionNewturn($game_id=null, $user_id=null){
		if($game_id == null) $game_id = Yii::$app->session['Game']->getGameId();
		if($user_id == null) $user_id = Yii::$app->session['User']->getId();
		
		Turn::NewTurn($game_id, $user_id);
	}
    
}
