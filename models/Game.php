<?php

namespace app\models;

use Yii;
use app\queries\GameQuery;
use app\models\User;
use app\classes\Crypt;
use app\classes\GameClass;
use app\models\GamePlayer;

/**
 * This is the model class for table "game".
 *
 public $game_id
 public $game_name
  public $game_owner_id
  public $game_max_player
  public $game_create_time
  public $game_statut
  public $game_map_id
  public $game_map_cont
  public $game_mod_id
  public $game_turn_time
  public $game_difficulty_id
  public $game_won_user_id
  public $game_won_time
 public $game_pwd
 public $game_key
 */
class Game extends \yii\db\ActiveRecord
{
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_name', 'game_owner_id', 'game_max_player', 'game_create_time', 'game_statut', 'game_map_id', 'game_map_cont', 'game_mod_id', 'game_turn_time', 'game_difficulty_id', 'game_won_user_id', 'game_won_time', 'game_pwd', 'game_key'], 'required'],
            [['game_owner_id', 'game_max_player', 'game_create_time', 'game_statut', 'game_map_id', 'game_map_cont', 'game_mod_id', 'game_turn_time', 'game_difficulty_id', 'game_won_user_id', 'game_won_time'], 'integer'],
            [['game_name', 'game_key'], 'string', 'max' => 256],
            [['game_pwd'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'game_id' => 'Game ID',
            'game_name' => Yii::t('game', 'Tab_Game_Name'),
            'game_owner_id' => Yii::t('game', 'Tab_Owner_Name'),
            'game_max_player' => 'Game Max Player',
            'game_create_time' => 'Game Create Time',
            'game_statut' => 'Game Statut',
            'game_map_id' => 'Game Map ID',
            'game_map_cont' => 'Game Map Cont',
            'game_mod_id' => 'Game Mod ID',
            'game_turn_time' => 'Game Turn Time',
            'game_difficulty_id' => 'Game Difficulty ID',
            'game_won_user_id' => 'Game Won User ID',
            'game_won_time' => 'Game Won Time',
            'game_pwd' => 'Game Pwd',
            'game_key' => 'Game Key',
        ];
    }

    /**
     * 
     * @param unknown $user_id
     * @return \app\models\User|NULL
     */
    public static function getUserOwner($user_id){
    	return User::findUserById($user_id);
    }
    
    /**
     * 
     * @param unknown $gameName
     * @return boolean
     */
    public static function existsGameName($gameName){
    	if(self::find()->where(['game_name' => (new Crypt($gameName))->s_crypt()])->one() != null)
    		return true;
    	else
    		return false;
    }
    
    /**
     *
     * @param unknown $gameName
     * @return boolean
     */
    public static function getGameByName($gameName){
    	return new GameClass(self::find()->where(['game_name' => (new Crypt($gameName))->s_decrypt()])->one());
    }
    
    /**
     * 
     * @param unknown $gameId
     * @return \app\classes\GameClass
     */
    public static function getGameById($game_Id){
    	return new GameClass(self::find()->where(['game_id' => $game_Id])->one());
    }
    
    /**
     * 
     * @param unknown $game_name
     */
    public static function decryptGameName($game_name){
    	return (new Crypt($game_name))->s_decrypt();
    }
    
    /**
     * 
     * @param unknown $game_Id
     * @return number
     */
    public static function getGameCountPlayer($game_Id){
    	return (new GamePlayer())->gameCountPlayer($game_Id);
    }
    
    /**
     * 
     * @param String $game_name
     * @param String $game_pwd
     * @param Integer $game_max_player
     */
    public static function createGame($game_name, $game_pwd, $game_max_player){
    	Yii::$app->db->createCommand()->insert("game", [
    			'game_name' => $game_name,
    			'game_pwd' => $game_pwd,
    			'game_owner_id' => Yii::$app->session['User']->getId(),
    			'game_max_player' => $game_max_player,
    			'game_create_time' => time(),
    			'game_statut' => 0,
    			'game_map_id' => 1,
    			'game_map_cont' => 0,
    			'game_mod_id' => 0,
    			'game_turn_time' => 0,
    			'game_difficulty_id' => 0,
    			'game_won_user_id' => 0,
    			'game_won_time' => 0,
    			'game_key' => 0,
    	])->execute();
    }
    
    /**
     * @inheritdoc
     * @return GameQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GameQuery(get_called_class());
    }
}
