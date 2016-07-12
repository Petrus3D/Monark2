<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\search\GameSearch;
use app\search\GamePlayerSearch;
use app\forms\game\GameCreateForm;
use app\forms\game\GameJoinForm;
use app\models\Game;
use app\models\GamePlayer;
use app\models\Color;
use app\models\Continent;

class GameController extends \yii\web\Controller
{
public function behaviors()
	{
		return [
				'access' => [
						'class' => AccessControl::className(),
						'only' => ['index', 'join', 'create', 'spec', 'quit', 'lobby', 'start'],
						'rules' => [
								[
										'allow' => isset(Yii::$app->session['User']), // have access
										'roles' => ['@'], // Connected
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
	 * 
	 * {@inheritDoc}
	 * @see \yii\base\Controller::actions()
	 */
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
	
	/**
	 * 
	 * @return string
	 */
    public function actionIndex()
    {
        $searchModel = new GameSearch();
        $dataProvider = $searchModel->search(['query' => Yii::$app->request->queryParams,]);
        return $this->render('index', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
        ]);
    }
    
    /**
     * 
     * @return string
     */
    public function actionLobby(){
    	if(isset(Yii::$app->session['Game'])){
	    	// Continent
	    	$continents 		= new Continent();
	    	$continentsSQL		= $continents->findAllContinent(Yii::$app->session['Game']->getMapId(), 0);
	    	$continentsArray 	= $continents->findAllContinentToArray(Yii::$app->session['Game']->getMapId(), $continentsSQL);
	    	
	    	// Color
	    	$colors 		= new Color();
	    	$colorsSQL		= $colors->findAllColor(0);
	    	$colorsArray 	= $colors->findAllColorToArray($colorsSQL);
	    	
	    	// Users
	    	$gamePlayer 	= new GamePlayer();
	    	$usersArray		= $gamePlayer->findAllGamePlayerToListUserId(null, Yii::$app->session['Game']->getGameId());
	
	    	// Get url update
	    	$region_id = null;
	    	$statut = null;
	    	$color_id = null;
	    	if(array_key_exists('ui', Yii::$app->request->queryParams)){
		    	if(array_key_exists('ri', Yii::$app->request->queryParams)){
		    		if(!$gamePlayer->existRegionIdInGame(Yii::$app->request->queryParams['ri'], Yii::$app->session['Game']->getGameId(), Yii::$app->request->queryParams['ui']))
		    			$region_id = Yii::$app->request->queryParams['ri'];
		    		else
		    			Yii::$app->session->setFlash('warning', 'Region already choosed.');
		    	}elseif(array_key_exists('si', Yii::$app->request->queryParams)){
		    		$statut = Yii::$app->request->queryParams['si'];
		    	}elseif(array_key_exists('ci', Yii::$app->request->queryParams)){
		    		if(!$gamePlayer->existColorIdInGame(Yii::$app->request->queryParams['ci'], Yii::$app->session['Game']->getGameId(), Yii::$app->request->queryParams['ui']))
		    			$color_id = Yii::$app->request->queryParams['ci'];
		    		else
		    			Yii::$app->session->setFlash('warning', 'Color already choosed.');
		    	}  	
	    	}
	    	$gamePlayer->UpdateGamePlayerById(Yii::$app->session['User']->getId(), Yii::$app->session['Game']->getGameId(), $region_id, $color_id, $statut);
	    	
	    	$searchModel = new GamePlayerSearch();
	        $dataProvider = $searchModel->search(['query' => Yii::$app->request->queryParams,]);
	        return $this->render('lobby', [
	            'searchModel'   => $searchModel,
	            'dataProvider'  => $dataProvider,
	        	'userList'		=> $usersArray,
	        	'colorList'		=> $colorsArray,
	        	'colorSQl'		=> $colorsSQL,
	        	'continentList'	=> $continentsArray,
	        	'continentSQl'	=> $continentsSQL,
	        ]);
    	}else
    		return $this->actionIndex();
    }
    
    /**
     * 
     * @return string
     */
    public function actionQuit()
    {
    	// DB
    	(new GamePlayer())->gameExitPlayer(Yii::$app->session['User']->getId(), Yii::$app->session['Game']->getGameId());
    	
    	// Session
    	Yii::$app->session['Game'] = null;
    	Yii::$app->session->setFlash('info', Yii::t('game', 'Notice_Game_Quit'));

    	return $this->actionIndex();
    }
    
    /**
     * 
     * @return string
     */
    public function actionCreate()
    {

    	$model = new GameCreateForm();
    	if ($model->load(Yii::$app->request->post()) && $model->create()) {
    		// all inputs are valid
    		Yii::$app->session->setFlash('success', Yii::t('game', 'Success_Game_Created')); 
    		return $this->actionIndex();
    	}else{
    		// validation failed: $errors is an array containing error messages
    		$errors = $model->errors;
    		return $this->render('create', [
    				'model' => $model,
    		]);
    	}
    }
    
    /**
     * 
     * @return string
     */
    public function actionJoin()
    {
    	$urlparams = Yii::$app->request->queryParams;   		
    	if (array_key_exists('gid', $urlparams)) {
			// Game Data
			$gameData = (new Game())->getGameById($urlparams['gid']);
    		
			if($gameData != null){
				// Checks
				$game_player = new GamePlayer();
				
				// If already enter in this game
				if($game_player->findUserGameIdIfExited(Yii::$app->session['User']->getId(), $urlparams['gid']) != null){
					$game_player->updateEnterInGame(Yii::$app->session['User']->getId(), $urlparams['gid']);
					$game_player->userJoinGame($gameData, Yii::$app->session['User']->getId(), true);
					Yii::$app->session->setFlash('success', Yii::t('game', 'Success_Game_Join'));
					return $this->actionLobby();
					// If never joined in this game
				}else if($game_player->findUserGameId(Yii::$app->session['User']->getId()) == null){
					// all inputs are valid
					$model = new GameJoinForm($gameData);
					 
					// Confirm
					if($model->join())
						Yii::$app->session->setFlash('success', Yii::t('game', 'Success_Game_Join'));
						else
							Yii::$app->session->setFlash('error', Yii::t('game', 'Success_Game_Join'));
							return $this->actionLobby();
							// In another game
				}else{
					Yii::$app->session->setFlash('error', Yii::t('game', 'Error_User_Already_In_Game'));
					return $this->actionIndex();
				}
			}else 
				return $this->actionIndex();
    	}elseif(isset($model)){
    		// validation failed: $errors is an array containing error messages
    		Yii::$app->session->setFlash('error', Yii::t('game', 'Success_Game_Join'));
    		$errors = $model->errors;
    		return $this->actionIndex();
    	}else
    		return $this->actionIndex();
    }
    
    /**
     * 
     * @return string
     */
    public function actionSpec()
    {
    	$urlparams = Yii::$app->request->queryParams;
    	if(array_key_exists('gid', $urlparams))
    		$model = new GameJoinForm((new Game())->getGameById($urlparams['gid']));
    		if (isset($model) && $model->joinSpec()) {
    			// all inputs are valid
    			Yii::$app->session->setFlash('success', Yii::t('game', 'Success_Game_Join'));
    			return $this->actionLobby();
    		}elseif(isset($model)){
    			// validation failed: $errors is an array containing error messages
    			Yii::$app->session->setFlash('error', Yii::t('game', 'Success_Game_Join'));
    			$errors = $model->errors;
    			return $this->actionIndex();
    		}else
    			return $this->actionIndex();
    }
    
    /**
     * 
     * @return string
     */
    public function actionStart(){
    	$urlparams = Yii::$app->request->queryParams;
    	if (array_key_exists('gid', $urlparams)) {
    	
	    	// Game Data
	    	$gameData = (new Game())->getGameById($urlparams['gid']);
	    	
	    	if($gameData != null){
	    		// Checks
	    		$game_player = new GamePlayer();
	    		
	    		// check colors
	    		if($game_player->checkPlayerColor($gameData)){
	    			// Check ready
	    			if($game_player->checkPlayerReady($gameData)){
	    				//(new Game())->gameStart($urlparams['gid']);
	    				Yii::$app->session->setFlash('success', Yii::t('game', 'Error_Start_Not_Ready'));
	    				return $this->actionLobby();
	    			}else
	    				Yii::$app->session->setFlash('error', Yii::t('game', 'Error_Start_Not_Ready'));
	    		}else
	    			Yii::$app->session->setFlash('error', Yii::t('game', 'Error_Start_Multiple_Color'));
	    	}else 
	    		Yii::$app->session->setFlash('error', Yii::t('game', 'Error_Start_Stop'));
    	}
    	Yii::$app->session->setFlash('error', Yii::t('game', 'Error_Start_Stop'));
    	return $this->actionLobby();
    }

}
