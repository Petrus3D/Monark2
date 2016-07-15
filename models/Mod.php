<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mod".
 *
 * @property string $mod_id
 * @property string $mod_name
 * @property integer $mod_max_unit_atk
 * @property integer $mod_max_unit_def
 * @property integer $mod_win_condition_id
 */
class Mod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mod';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mod_name', 'mod_max_unit_atk', 'mod_max_unit_def', 'mod_win_condition_id'], 'required'],
            [['mod_max_unit_atk', 'mod_max_unit_def', 'mod_win_condition_id'], 'integer'],
            [['mod_name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mod_id' => 'Mod ID',
            'mod_name' => 'Mod Name',
            'mod_max_unit_atk' => 'Mod Max Unit Atk',
            'mod_max_unit_def' => 'Mod Max Unit Def',
            'mod_win_condition_id' => 'Mod Win Condition ID',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\queries\ModQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\ModQuery(get_called_class());
    }
}
