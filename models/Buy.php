<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "buy".
 *
 * @property string $buy_id
 * @property integer $buy_user_id
 * @property integer $buy_turn_id
 * @property integer $buy_game_id
 * @property integer $buy_units_nb
 * @property integer $buy_build_id
 */
class Buy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'buy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['buy_user_id', 'buy_turn_id', 'buy_game_id', 'buy_units_nb', 'buy_build_id'], 'required'],
            [['buy_user_id', 'buy_turn_id', 'buy_game_id', 'buy_units_nb', 'buy_build_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'buy_id' => 'Buy ID',
            'buy_user_id' => 'Buy User ID',
            'buy_turn_id' => 'Buy Turn ID',
            'buy_game_id' => 'Buy Game ID',
            'buy_units_nb' => 'Buy Units Nb',
            'buy_build_id' => 'Buy Build ID',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\queries\BuyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\BuyQuery(get_called_class());
    }
}
