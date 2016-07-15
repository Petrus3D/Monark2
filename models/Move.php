<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "move".
 *
 * @property string $move_id
 * @property integer $move_game_id
 * @property integer $move_user_id
 * @property integer $move_time
 * @property integer $move_land_id_from
 * @property integer $move_land_id_arrive
 * @property integer $move_units
 */
class Move extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'move';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['move_game_id', 'move_user_id', 'move_time', 'move_land_id_from', 'move_land_id_arrive', 'move_units'], 'required'],
            [['move_game_id', 'move_user_id', 'move_time', 'move_land_id_from', 'move_land_id_arrive', 'move_units'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'move_id' => 'Move ID',
            'move_game_id' => 'Move Game ID',
            'move_user_id' => 'Move User ID',
            'move_time' => 'Move Time',
            'move_land_id_from' => 'Move Land Id From',
            'move_land_id_arrive' => 'Move Land Id Arrive',
            'move_units' => 'Move Units',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\queries\MoveQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\MoveQuery(get_called_class());
    }
}
