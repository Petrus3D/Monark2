<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "frontier".
 *
 * @property integer $frontier_id
 * @property integer $frontier_land_id_one
 * @property integer $frontier_land_id_two
 * @property integer $frontier_map_id
 */
class Frontier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frontier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['frontier_land_id_one', 'frontier_land_id_two', 'frontier_map_id'], 'required'],
            [['frontier_land_id_one', 'frontier_land_id_two', 'frontier_map_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'frontier_id' => 'Frontier ID',
            'frontier_land_id_one' => 'Frontier Land Id One',
            'frontier_land_id_two' => 'Frontier Land Id Two',
            'frontier_map_id' => 'Frontier Map ID',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\queries\FrontierQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\FrontierQuery(get_called_class());
    }
}
