<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pact".
 *
 * @property string $pact_id
 * @property integer $pact_game_id
 * @property integer $pact_ask_user_id
 * @property integer $pact_accept_user_id
 * @property integer $pact_pact_type
 * @property integer $pact_time
 * @property integer $pact_nb_turn
 * @property integer $pact_create_turn
 * @property integer $pact_end_turn
 */
class Pact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pact_game_id', 'pact_ask_user_id', 'pact_accept_user_id', 'pact_pact_type', 'pact_time', 'pact_nb_turn', 'pact_create_turn', 'pact_end_turn'], 'required'],
            [['pact_game_id', 'pact_ask_user_id', 'pact_accept_user_id', 'pact_pact_type', 'pact_time', 'pact_nb_turn', 'pact_create_turn', 'pact_end_turn'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pact_id' => 'Pact ID',
            'pact_game_id' => 'Pact Game ID',
            'pact_ask_user_id' => 'Pact Ask User ID',
            'pact_accept_user_id' => 'Pact Accept User ID',
            'pact_pact_type' => 'Pact Pact Type',
            'pact_time' => 'Pact Time',
            'pact_nb_turn' => 'Pact Nb Turn',
            'pact_create_turn' => 'Pact Create Turn',
            'pact_end_turn' => 'Pact End Turn',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\queries\PactQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\PactQuery(get_called_class());
    }
}
