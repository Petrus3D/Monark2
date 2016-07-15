<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "land".
 *
 * @property string $land_id
 * @property string $land_name
 * @property integer $land_map_id
 * @property string $land_abv
 * @property string $land_image
 * @property integer $land_continent_id
 * @property string $land_position_top
 * @property string $land_position_left
 * @property integer $land_base_units
 * @property integer $land_harbor
 */
class Land extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'land';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['land_name', 'land_map_id', 'land_abv', 'land_image', 'land_continent_id', 'land_position_top', 'land_position_left', 'land_base_units', 'land_harbor'], 'required'],
            [['land_map_id', 'land_continent_id', 'land_base_units', 'land_harbor'], 'integer'],
            [['land_name', 'land_abv', 'land_image'], 'string', 'max' => 128],
            [['land_position_top', 'land_position_left'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'land_id' => 'Land ID',
            'land_name' => 'Land Name',
            'land_map_id' => 'Land Map ID',
            'land_abv' => 'Land Abv',
            'land_image' => 'Land Image',
            'land_continent_id' => 'Land Continent ID',
            'land_position_top' => 'Land Position Top',
            'land_position_left' => 'Land Position Left',
            'land_base_units' => 'Land Base Units',
            'land_harbor' => 'Land Harbor',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\queries\LandQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\LandQuery(get_called_class());
    }
}
