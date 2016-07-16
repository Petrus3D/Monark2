<?php

namespace app\models;

use Yii;
use app\classes\TurnClass;

/**
 * This is the model class for table "turn".
 *
 * @property string $turn_id
 * @property integer $turn_game_id
 * @property integer $turn_user_id
 * @property integer $turn_time
 * @property integer $turn_time_begin
 * @property integer $turn_gold
 * @property integer $turn_gold_base
 * @property integer $turn_income
 */
class Turn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'turn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['turn_game_id', 'turn_user_id', 'turn_time', 'turn_time_begin', 'turn_gold', 'turn_gold_base', 'turn_income'], 'required'],
            [['turn_game_id', 'turn_user_id', 'turn_time', 'turn_time_begin', 'turn_gold', 'turn_gold_base', 'turn_income'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'turn_id' => 'Turn ID',
            'turn_game_id' => 'Turn Game ID',
            'turn_user_id' => 'Turn User ID',
            'turn_time' => 'Turn Time',
            'turn_time_begin' => 'Turn Time Begin',
            'turn_gold' => 'Turn Gold',
            'turn_gold_base' => 'Turn Gold Base',
            'turn_income' => 'Turn Income',
        ];
    }

    /**
     * 
     * @param unknown $game_id
     * @return \app\classes\TurnClass
     */
    public static function getLastTurnByGameId($game_id){
    	return new TurnClass(self::find()->where(['turn_game_id' => $game_id])->orderBy(['turn_id' => SORT_DESC])->one());
    }
    
    /**
     * 
     * @param unknown $user_id
     * @param unknown $game_id
     * @return \app\classes\TurnClass
     */
    public static function getLastTurnByUserId($user_id, $game_id){
    	return new TurnClass(self::find()->where(['turn_game_id' => $game_id])->andWhere(['turn_user_id' => $user_id])->orderBy(['turn_id' => SORT_DESC])->one());
    }
    
    /**
     * @inheritdoc
     * @return \app\queries\TurnQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\TurnQuery(get_called_class());
    }
}
