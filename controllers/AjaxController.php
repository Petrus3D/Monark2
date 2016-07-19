<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Turn;
use app\classes\Access;
use app\models\Land;
use app\models\GameData;
use app\models\Color;
use app\models\Ressource;
use app\models\Continent;
use app\models\Game;
use app\models\User;
use app\models\GamePlayer;
use yii\helpers\Json;
use yii\web\Response;

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
										'actions' => ['newturn', 'landinfo'],
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
     * @return string
     */
    public static function returnError()
    {
    	return "AJAX_ERROR";
    }

    /**
     * 
     * @param unknown $dataList
     * @return \app\classes\GameClass[]|\app\models\User[]|NULL[]|\app\classes\RessourceClass[][]|\app\models\NULL[]|\app\classes\ColorClass[]|\app\models\Continent[][]|\app\models\Land[][]|\app\classes\TurnClass[]|\app\models\number[][]|Session[]
     */
    public function getData($dataList){
		$returned = array();
		
    	if($dataList['game_id'] === true){
    		$returned['game'] 				= Yii::$app->session['Game'];}else{
    		$returned['game'] 				= Game::getGameById($dataList['game_id']);}
    		
    	if($dataList['user_id'] === true){
    		$returned['user'] 				= Yii::$app->session['User'];}else{
    		$returned['user'] 				= User::findUserById($dataList['user_id']);}
    		
    	if(Yii::$app->session['Ressource'] == null && $dataList['Ressource'] != null){
    		$returned['ressource'] 			= Ressource::findAllRessourcesToArray();}else{
    		$returned['ressource'] 			= Yii::$app->session['Ressource'];}
    		
    	if(Yii::$app->session['Color'] == null && $dataList['Color'] != null){
    		$returned['color'] 				= Color::findAllColorToArray();}else{
    		$returned['color'] 				= Yii::$app->session['Color'];}
    		
    	if(Yii::$app->session['Contient'] == null && $dataList['Contient'] != null){
    		$returned['continent'] 			= Continent::findAllContinent($game->getMapId());}else{
    		$returned['continent'] 			= Yii::$app->session['Contient'];}
    		
    	if(Yii::$app->session['Land'] == null && $dataList['Land'] != null){
    		$returned['land'] 				= Land::findAllLandsToArray($game->getMapId());}else{
    		$returned['land']				= Yii::$app->session['Land'];}
    		
    	if(Yii::$app->session['Map'] == null && $dataList['Map'] != null){
    		$returned['map']				= Map::findMapById($game->getMapId());}else{
    		$returned['map']				= Yii::$app->session['Map'];}
    		
    	if($dataList['CurrentTurnData'] != null)
    		$returned['currentTurnData']	= Turn::getLastTurnByGameId($game->getGameId());
    	
    	if($dataList['LastUserTurnData'] != null)
    		$returned['lastUserTurnData']	= Turn::getLastTurnByUserId($user->getUserID(), $game->getGameId());
    	
    	if($dataList['GamePlayer'] != null){
    		$gamePlayerDataGlobal 			= GamePlayer::findAllGamePlayer($game_current->getGameId());
    		$gamePlayerData 				= GamePlayer::findAllGamePlayerToArrayWithData($gamePlayerDataGlobal);
    		$gamePlayerData[0]				= GamePlayer::findPlayerZero();
    		$returned['gamePlayer']			= $gamePlayerData;
    	}
    		 
    	if($dataList['GameData'] != null)
    		$returned['gameData']			= GameData::getGameDataByIdToArray($game_current->getGameId());
    	
    	if($dataList['UsersData'] != null)
    		$returned['usersData']			= GamePlayer::findAllGamePlayerToListUserId($gamePlayerDataGlobal);
    	
    	return $returned;
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
	
	
	/**
	 * 
	 * @param unknown $land_id
	 * @param unknown $game
	 * @param unknown $user
	 * @return NULL
	 */
	public function actionLandinfo($land_id=null, $game=null, $user=null){
		$urlparams = Yii::$app->request->queryParams;
		print json_decode($urlparams['args']);  
		//print Json::decode($urlparams['args'], true);
		if(array_key_exists('args', $urlparams)){ // && Json::decode($urlparams['args'], true) != null
			$urlparamsArray = array(); //Json::decode($urlparams['args'], true);
			//print " == ".$urlparamsArray;
			if(array_key_exists('land_id', $urlparamsArray) && $urlparamsArray['land_id'] != null){
		    	// Load data
		    	$data = $this->getData(array(
		    			'Game' => true,
		    			'User' => true,
		    			'Ressource' => true,
		    			'Color' => true,
		    			'Contient' => true,
		    			'Land' => true,
		    			'GameData' => true,
		    			'CurrentTurnData' => true,
		    	));
		    	
		    	return $this->render('landinfo', [
		    			'land_id' 			=> json_decode(Yii::$app->request->queryParams['args'])['land_id'],
		    			'Game'				=> $data['game'],
		    			'User'				=> $data['user'],
		    			'Ressource'			=> $data['ressource'],
		    			'Color'				=> $data['color'],
		    			'Contient'			=> $data['contient'],
		    			'Land'				=> $data['land'],
		    			'GameData'			=> $data['gameData'],
		    			'CurrentTurnData'	=> $data['currentTurnData'],
		    	]);
			}
		}
		
		return $this->returnError();
	}
    
}
