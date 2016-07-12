<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "harbor".
 *
 * @property string $harbor_id
 * @property integer $harbor_land_id_one
 * @property integer $harbor_land_id_two
 * @property integer $harbor_map_id
 */
class Harbor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'harbor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['harbor_land_id_one', 'harbor_land_id_two', 'harbor_map_id'], 'required'],
            [['harbor_land_id_one', 'harbor_land_id_two', 'harbor_map_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'harbor_id' => 'Harbor ID',
            'harbor_land_id_one' => 'Harbor Land Id One',
            'harbor_land_id_two' => 'Harbor Land Id Two',
            'harbor_map_id' => 'Harbor Map ID',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\queries\HarborQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\HarborQuery(get_called_class());
    }
}
