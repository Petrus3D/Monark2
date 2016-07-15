<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\search\GameSearch;
use app\search\GamePlayerSearch;
use app\forms\game\GameCreateForm;
use app\forms\game\GameJoinForm;
use app\models\Game;
use app\models\GamePlayer;
use app\models\Color;
use app\models\Continent;
use app\models\Land;
use app\models\Ressource;
use app\models\GameData;
use app\models\Map;

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
	 * @return boolean
	 */
	public function checkOwner()
	{
		if(Yii::$app->session['Game']->getGameOwnerID() == Yii::$app->session['User']->getId())
			return true;
		else{
			//Yii::t('game', 'Error_Not_Owner');
			return false;
		}
		
	}
	
	/**
	 * 
	 * @param unknown $game_id
	 * @return boolean
	 */
	public function checkStarted($game_id)
	{
		if((new Game)->getGameById($game_id)->getGameStatut() >= 50)
			return true;
		else
			return false;
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
     * @return \app\models\GamePlayer|NULL
     */
    public function updateUserLobby(){
    	// Users
    	$gamePlayer 	= new GamePlayer();

    	// Get url update
    	$region_id = null;
    	$statut = null;
    	$color_id = null;
    	if(array_key_exists('ui', Yii::$app->request->queryParams)){
    		if(array_key_exists('ri', Yii::$app->request->queryParams)){
    			$region_id = Yii::$app->request->queryParams['ri'];
    		}elseif(array_key_exists('si', Yii::$app->request->queryParams)){
    			$statut = Yii::$app->request->queryParams['si'];
    		}elseif(array_key_exists('ci', Yii::$app->request->queryParams)){
    			$color_id = Yii::$app->request->queryParams['ci'];
    		}
    	}
    	
    	// Update in bd
    	$gamePlayer->updateGamePlayerById(Yii::$app->session['User']->getId(), Yii::$app->session['Game']->getGameId(), $region_id, $color_id, $statut); 
    	
    	// Clear url & go to lobby
    	return $this->redirect(Url::to(['game/lobby']),302);
    }
    
    /**
     * 
     * @return string
     */
    public function actionLobby(){
    	if(isset(Yii::$app->session['Game'])){
    		if(!$this->checkStarted(Yii::$app->session['Game']->getGameId())){
		    	// Continent
		    	$continents 		= new Continent();
		    	$continentsSQL		= $continents->findAllContinent(Yii::$app->session['Game']->getMapId(), 0);
		    	$continentsArray 	= $continents->findAllContinentToArray(Yii::$app->session['Game']->getMapId(), $continentsSQL);
		    	
		    	// Color
		    	$colors 			= new Color();
		    	$colorsSQL			= $colors->findAllColor(0);
		    	$colorsArray 		= $colors->findAllColorToArray($colorsSQL);
	    	
		    	// Users
		    	$gamePlayer 		= new GamePlayer();
		    	$usersArray			= $gamePlayer->findAllGamePlayerToListUserId(null, Yii::$app->session['Game']->getGameId());
		    	
		    	// Update data
		    	if(array_key_exists('ui', Yii::$app->request->queryParams))
		    		$this->updateUserLobby();
		    	
		    	$searchModel = new GamePlayerSearch(Yii::$app->session['Game']->getGameId());
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
    			return $this->actionStart();
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
					// Max player
					if($gameData->getGamePlayerMax() < (new Game())->getGameCountPlayer($urlparams['gid'])+1){
						Yii::$app->session->setFlash('error', Yii::t('game', 'Error_Game_Full'));
						return $this->actionLobby();
					}else{
						// all inputs are valid
						$model = new GameJoinForm($gameData);
						 
						// Confirm
						if($model->join())
							Yii::$app->session->setFlash('success', Yii::t('game', 'Success_Game_Join'));
							else
								Yii::$app->session->setFlash('error', Yii::t('game', 'Success_Game_Join'));
								return $this->actionLobby();
					}
				// In another game
				}else{
					Yii::$app->session->setFlash('error', Yii::t('game', 'Error_User_Already_In_Game'));
					return $this->redirect(Url::to(['game/index']),302);
				}
			}else 
				return $this->actionIndex();
    	}elseif(isset($model)){
    		// validation failed: $errors is an array containing error messages
    		Yii::$app->session->setFlash('error', Yii::t('game', 'Success_Game_Join'));
    		$errors = $model->errors;
    		return $this->redirect(Url::to(['game/index']),302);
    	}else
    		return $this->redirect(Url::to(['game/index']),302);
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
    	// The game as started
    	$started = $this->checkStarted(Yii::$app->session['Game']->getGameId());
    	if($started){
    		
    		// if the owner push the start button
    		if($this->checkOwner() && !$started){
		    	$urlparams = Yii::$app->request->queryParams;
		    	if (array_key_exists('gid', $urlparams)) {
		    	
			    	// Initialization
		    		$game_player 	= new GamePlayer();
		    		$game_current 	= (new Game())->getGameById($urlparams['gid']);
		    		$land		 	= new Land();
		    		$res		 	= new Ressource();
		    		$game_data		= new GameData();
		    		$continentData	= (new Continent())->findAllContinent($game_current->getMapId());
		    		$mapData		= (new Map())->findMapById($game_current->getMapId());
		    		
		    		// Datas
		    		$ressourceData 	= $res->findAllRessources();
		    		$landData		= $land->findAllLands($game_current->getMapId());
			    	$gamePlayerData = $game_player->findAllGamePlayer($game_current->getGameId());
			    	
			    	// Checks
			    	if($gamePlayerData != null){
			    		// check colors
			    		if($game_player->checkPlayerColor($gamePlayerData)){
			    			// Check ready
			    			if($game_player->checkPlayerReady($gamePlayerData)){ 
			    				// Assign Lands
			    				$assignedLands 		= $land->assignLandsToArray($gamePlayerData, $game_current, $continentData, $mapData);
		
			    				// Assign Ressources
			    				$assignedRessources = $res->assignRessourcesToArray($landData, $ressourceData);
			    				
			    				// Create Game Data
			    				$game_data->createGameData($assignedLands, $assignedRessources, $landData, $game_current);
			    				
						    	// Create turn order
						    	
						    	// Create 1rst turn
						    	
						    	// Update Game statut
						    	(new Game())->updateGameStatut($game_current->getGameId(), 50);
		
			    				return $this->render('start');
			    			}else
			    				Yii::$app->session->setFlash('error', Yii::t('game', 'Error_Start_Not_Ready'));
			    		}else
			    			Yii::$app->session->setFlash('error', Yii::t('game', 'Error_Start_Multiple_Color'));
			    	}else 
			    		Yii::$app->session->setFlash('error', Yii::t('game', 'Error_Start_Stop'));
		    	}else
		    		Yii::$app->session->setFlash('error', Yii::t('game', 'Error_Start_Stop'));
		    	
		    	return $this->redirect(Url::to(['game/lobby']),302);
	    	}
	    	return $this->render('start');
    	}else
    		return $this->actionLobby();
    }

}
