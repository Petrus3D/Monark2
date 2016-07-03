<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "game".
 *
 * @property string $game_id
 * @property string $game_name
 * @property integer $game_owner_id
 * @property integer $game_max_player
 * @property integer $game_create_time
 * @property integer $game_statut
 * @property integer $game_map_id
 * @property integer $game_map_cont
 * @property integer $game_mod_id
 * @property integer $game_turn_time
 * @property integer $game_difficulty_id
 * @property integer $game_won_user_id
 * @property integer $game_won_time
 * @property string $game_pwd
 * @property string $game_key
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
            'game_name' => 'Game Name',
            'game_owner_id' => 'Game Owner ID',
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
     * @inheritdoc
     * @return User[]|array
     */
    public function all($db = null)
    {
    	return parent::all($db);
    }
    
    /**
     * @inheritdoc
     * @return User|array|null
     */
    public function one($db = null)
    {
    	return parent::one($db);
    }
}
