<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fight".
 *
 * @property string $fight_id
 * @property integer $fight_game_id
 * @property integer $fight_atk_user_id
 * @property integer $fight_def_user_id
 * @property integer $fight_atk_land_id
 * @property integer $fight_def_land_id
 * @property integer $fight_atk_lost_unit
 * @property integer $fight_def_lost_unit
 * @property string $fight_atk_units
 * @property string $fight_def_units
 * @property integer $fight_atk_nb_units
 * @property integer $fight_def_nb_units
 * @property string $fight_thimble_atk
 * @property string $fight_thimble_def
 * @property integer $fight_time
 * @property integer $fight_turn_id
 * @property integer $fight_conquest
 */
class Fight extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fight';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fight_game_id', 'fight_atk_user_id', 'fight_def_user_id', 'fight_atk_land_id', 'fight_def_land_id', 'fight_atk_lost_unit', 'fight_def_lost_unit', 'fight_atk_units', 'fight_def_units', 'fight_atk_nb_units', 'fight_def_nb_units', 'fight_thimble_atk', 'fight_thimble_def', 'fight_time', 'fight_turn_id', 'fight_conquest'], 'required'],
            [['fight_game_id', 'fight_atk_user_id', 'fight_def_user_id', 'fight_atk_land_id', 'fight_def_land_id', 'fight_atk_lost_unit', 'fight_def_lost_unit', 'fight_atk_nb_units', 'fight_def_nb_units', 'fight_time', 'fight_turn_id', 'fight_conquest'], 'integer'],
            [['fight_atk_units', 'fight_def_units', 'fight_thimble_atk', 'fight_thimble_def'], 'string', 'max' => 2048]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fight_id' => 'Fight ID',
            'fight_game_id' => 'Fight Game ID',
            'fight_atk_user_id' => 'Fight Atk User ID',
            'fight_def_user_id' => 'Fight Def User ID',
            'fight_atk_land_id' => 'Fight Atk Land ID',
            'fight_def_land_id' => 'Fight Def Land ID',
            'fight_atk_lost_unit' => 'Fight Atk Lost Unit',
            'fight_def_lost_unit' => 'Fight Def Lost Unit',
            'fight_atk_units' => 'Fight Atk Units',
            'fight_def_units' => 'Fight Def Units',
            'fight_atk_nb_units' => 'Fight Atk Nb Units',
            'fight_def_nb_units' => 'Fight Def Nb Units',
            'fight_thimble_atk' => 'Fight Thimble Atk',
            'fight_thimble_def' => 'Fight Thimble Def',
            'fight_time' => 'Fight Time',
            'fight_turn_id' => 'Fight Turn ID',
            'fight_conquest' => 'Fight Conquest',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\queries\FightQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\FightQuery(get_called_class());
    }
}
