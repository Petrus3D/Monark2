<?php

namespace app\models;

use Yii;
use app\queries\GameDataQuery;

/**
 * This is the model class for table "game_data".
 *
 * @property string $game_data_id
 * @property integer $game_data_game_id
 * @property integer $game_data_user_id
 * @property integer $game_data_user_id_base
 * @property integer $game_data_land_id
 * @property integer $game_data_units
 * @property integer $game_data_capital
 * @property integer $game_data_ressource_id
 * @property string $game_data_buildings
 */
class GameData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_data_game_id', 'game_data_user_id', 'game_data_user_id_base', 'game_data_land_id', 'game_data_units', 'game_data_capital', 'game_data_ressource_id', 'game_data_buildings'], 'required'],
            [['game_data_game_id', 'game_data_user_id', 'game_data_user_id_base', 'game_data_land_id', 'game_data_units', 'game_data_capital', 'game_data_ressource_id'], 'integer'],
            [['game_data_buildings'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'game_data_id' => 'Game Data ID',
            'game_data_game_id' => 'Game Data Game ID',
            'game_data_user_id' => 'Game Data User ID',
            'game_data_user_id_base' => 'Game Data User Id Base',
            'game_data_land_id' => 'Game Data Land ID',
            'game_data_units' => 'Game Data Units',
            'game_data_capital' => 'Game Data Capital',
            'game_data_ressource_id' => 'Game Data Ressource ID',
            'game_data_buildings' => 'Game Data Buildings',
        ];
    }

    /**
     * 
     * @param unknown $assignedLands
     * @param unknown $assignedRessources
     */
    public static function createGameData($assignedLands, $assignedRessources){
    	/*$i = 0;
    	 foreach ($landList as $key => $land) {
    	 if(!in_array($land['id'], $land_used)){
    	 $assignLand = array(
    	 'game_id'       => $gameid,
    	 'user_id'       => 0,
    	 'user_id_base'  => 0,
    	 'land_id'       => $land['id'],
    	 'units'         => $land['base_units'],
    	 'capital'       => 0,
    	 'ressource_id'  => $array_assign_ressources[$i],
    	 'buildings'     => '0',
    	 );
    	 }else{
    	 $i = array_search($land['id'], $land_used);
    	 $assignLand = array(
    	 'game_id'       => $gameid,
    	 'user_id'       => $land_used_user[$i]['user_id'],
    	 'user_id_base'  => $land_used_user[$i]['user_id'],
    	 'land_id'       => $land['id'],
    	 'units'         => $land['base_units'] + $default_units_user_add,
    	 'capital'       => $land_used_user[$i]['user_id'],
    	 'ressource_id'  => $array_assign_ressources[$i],
    	 'buildings'     => '1;',
    	 );
    	 }
    	 array_push($newGame, $assignLand);
    	 $i++;
    	 }
    	
    	 foreach ($newGame as $key => $gamedata) {
    	 Yii::$app->db->createCommand()->insert("game_data", [
    	 'game_id'       => $gamedata['game_id'],
    	 'user_id'       => $gamedata['user_id'],
    	 'user_id_base'  => $gamedata['user_id_base'],
    	 'land_id'       => $gamedata['land_id'],
    	 'units'         => $gamedata['units'],
    	 'capital'       => $gamedata['capital'],
    	 'ressource_id'  => $gamedata['ressource_id'],
    	 'buildings'     => $gamedata['buildings'],
    	 ])->execute();
    	 }*/
    }
    
    /**
     * @inheritdoc
     * @return GameDataQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GameDataQuery(get_called_class());
    }
}
