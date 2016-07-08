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
						'only' => ['index', 'join', 'create', 'spec', 'quit'],
						'rules' => [
								[
										'allow' => true, // have access
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
    	// Continent
    	$continents 		= new Continent();
    	$continentsSQL		= $continents->findAllContinent(Yii::$app->session['Game']->getMapId(), 0);
    	$continentsArray 	= $continents->findAllContinentToArray(Yii::$app->session['Game']->getMapId(), $continentsSQL);
    	
    	// Color
    	$colors 		= new Color();
    	$colorsSQL		= $colors->findAllColor();
    	$colorsArray 	= $colors->findAllColorToArray($colorsSQL);
    	
    	// Users
    	$usersArray		= (new GamePlayer())->findAllGamePlayerToListUserId(null, Yii::$app->session['Game']->getGameId());

    	// Get url update
    	$region_id 	= (array_key_exists('ri', Yii::$app->request->queryParams) ? Yii::$app->request->queryParams['ri'] : null);
    	$statut 	= (array_key_exists('si', Yii::$app->request->queryParams) ? Yii::$app->request->queryParams['si'] : null);
    	$color_id 	= (array_key_exists('ci', Yii::$app->request->queryParams) ? Yii::$app->request->queryParams['ci'] : null);    	
    	(new GamePlayer())->UpdateGamePlayerById(Yii::$app->session['User']->getId(), Yii::$app->session['Game']->getGameId(), $region_id, $color_id, $statut);
    	
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
    	if(array_key_exists('gid', $urlparams))
    		$model = new GameJoinForm((new Game())->getGameById($urlparams['gid']));
    	if (isset($model) && $model->join()) {
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

}
