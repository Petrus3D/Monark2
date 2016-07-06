<?php

namespace app\models;

use Yii;
use app\queries\GamePlayerQuery;

/**
 * This is the model class for table "game_player".
 *
 * @property string $game_player_id
 * @property integer $game_player_region_id
 * @property integer $game_player_difficulty_id
 * @property integer $game_player_statut
 * @property integer $game_player_game_id
 * @property integer $game_player_user_id
 * @property integer $game_player_color_id
 * @property integer $game_player_enter_time
 * @property integer $game_player_order
 * @property integer $game_player_bot
 * @property integer $game_player_spec
 * @property integer $game_player_quit
 */
class GamePlayer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_player';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_player_region_id', 'game_player_game_id', 'game_player_user_id', 'game_player_color_id', 'game_player_enter_time', 'game_player_order', 'game_player_bot', 'game_player_spec', 'game_player_quit'], 'required'],
            [['game_player_region_id', 'game_player_difficulty_id', 'game_player_statut', 'game_player_game_id', 'game_player_user_id', 'game_player_color_id', 'game_player_enter_time', 'game_player_order', 'game_player_bot', 'game_player_spec', 'game_player_quit'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'game_player_id' => 'Game Player ID',
            'game_player_region_id' => 'Game Player Region ID',
            'game_player_difficulty_id' => 'Game Player Difficulty ID',
            'game_player_statut' => 'Game Player Statut',
            'game_player_game_id' => 'Game Player Game ID',
            'game_player_user_id' => 'Game Player User ID',
            'game_player_color_id' => 'Game Player Color ID',
            'game_player_enter_time' => 'Game Player Enter Time',
            'game_player_order' => 'Game Player Order',
            'game_player_bot' => 'Game Player Bot',
            'game_player_spec' => 'Game Player Spec',
            'game_player_quit' => 'Game Player Quit',
        ];
    }

    /**
     *
     * @param unknown $gameId
     * @return \app\classes\GameClass
     */
    public static function userJoinGame($game, $userSpec=0){
    	// set Session Var
    	Yii::$app->session['Game'] = $game;
    	
    	// Insert in BD
    	self::userInsertJoinGame($game->getGameId(), $userSpec);
    }
    
    /**
     *
     * @param unknown $gameId
     * @return \app\classes\GameClass
     */
    public static function userInsertJoinGame($gameId, $userSpec){
    	Yii::$app->db->createCommand()->insert("game_player",[
    			'game_player_region_id' => 1,
    			'game_player_difficulty_id' => 1,
    			'game_player_statut' => 0,
    			'game_player_game_id' => $gameId,
    			'game_player_user_id' => Yii::$app->session['User']->getId(),
    			'game_player_color_id' => 1,
    			'game_player_enter_time' => time(),
    			'game_player_spec'      => $userSpec,
    	])->execute();
    }
    
    /**
     * @inheritdoc
     * @return GamePlayerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GamePlayerQuery(get_called_class());
    }
}
