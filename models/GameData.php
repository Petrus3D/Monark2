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
     * @inheritdoc
     * @return GameDataQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GameDataQuery(get_called_class());
    }
}
