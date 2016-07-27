<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "difficulty".
 *
 * @property string $difficulty_id
 * @property string $difficulty_name
 * @property integer $difficulty_rate_bot_units
 * @property integer $difficulty_rate_resources
 * @property string $difficulty_rate_oper
 * @property integer $difficulty_rate_units_atk
 * @property integer $difficulty_rate_units_def
 * @property integer $difficulty_rate_atk_frt
 * @property integer $difficulty_rate_def_pc
 * @property integer $difficulty_rate_exec_atk
 * @property integer $difficulty_rate_exec_def
 * @property integer $difficulty_rate_exec_build
 * @property integer $difficulty_marge_frt
 * @property integer $difficulty_marge_pc
 * @property integer $difficulty_build_mine
 */
class Difficulty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'difficulty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['difficulty_name', 'difficulty_rate_bot_units', 'difficulty_rate_resources', 'difficulty_rate_oper', 'difficulty_rate_units_atk', 'difficulty_rate_units_def', 'difficulty_rate_atk_frt', 'difficulty_rate_def_pc', 'difficulty_rate_exec_atk', 'difficulty_rate_exec_def', 'difficulty_rate_exec_build', 'difficulty_marge_frt', 'difficulty_marge_pc', 'difficulty_build_mine'], 'required'],
            [['difficulty_rate_bot_units', 'difficulty_rate_resources', 'difficulty_rate_units_atk', 'difficulty_rate_units_def', 'difficulty_rate_atk_frt', 'difficulty_rate_def_pc', 'difficulty_rate_exec_atk', 'difficulty_rate_exec_def', 'difficulty_rate_exec_build', 'difficulty_marge_frt', 'difficulty_marge_pc', 'difficulty_build_mine'], 'integer'],
            [['difficulty_name'], 'string', 'max' => 256],
            [['difficulty_rate_oper'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'difficulty_id' => 'Difficulty ID',
            'difficulty_name' => 'Difficulty Name',
            'difficulty_rate_bot_units' => 'Difficulty Rate Bot Units',
            'difficulty_rate_resources' => 'Difficulty Rate Resources',
            'difficulty_rate_oper' => 'Difficulty Rate Oper',
            'difficulty_rate_units_atk' => 'Difficulty Rate Units Atk',
            'difficulty_rate_units_def' => 'Difficulty Rate Units Def',
            'difficulty_rate_atk_frt' => 'Difficulty Rate Atk Frt',
            'difficulty_rate_def_pc' => 'Difficulty Rate Def Pc',
            'difficulty_rate_exec_atk' => 'Difficulty Rate Exec Atk',
            'difficulty_rate_exec_def' => 'Difficulty Rate Exec Def',
            'difficulty_rate_exec_build' => 'Difficulty Rate Exec Build',
            'difficulty_marge_frt' => 'Difficulty Marge Frt',
            'difficulty_marge_pc' => 'Difficulty Marge Pc',
            'difficulty_build_mine' => 'Difficulty Build Mine',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\queries\DifficultyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\DifficultyQuery(get_called_class());
    }
}
