<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "map".
 *
 * @property string $map_id
 * @property string $map_name
 * @property string $map_music
 * @property integer $map_leftmenutop_top
 * @property integer $map_leftmenutop_left
 * @property integer $map_rightmenutop_top
 * @property integer $map_rightmenutop_left
 * @property integer $map_continent
 * @property integer $map_land_id_begin
 * @property integer $map_land_id_end
 */
class Map extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'map';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['map_name', 'map_music', 'map_leftmenutop_top', 'map_leftmenutop_left', 'map_rightmenutop_top', 'map_rightmenutop_left', 'map_continent', 'map_land_id_begin', 'map_land_id_end'], 'required'],
            [['map_leftmenutop_top', 'map_leftmenutop_left', 'map_rightmenutop_top', 'map_rightmenutop_left', 'map_continent', 'map_land_id_begin', 'map_land_id_end'], 'integer'],
            [['map_name', 'map_music'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'map_id' => 'Map ID',
            'map_name' => 'Map Name',
            'map_music' => 'Map Music',
            'map_leftmenutop_top' => 'Map Leftmenutop Top',
            'map_leftmenutop_left' => 'Map Leftmenutop Left',
            'map_rightmenutop_top' => 'Map Rightmenutop Top',
            'map_rightmenutop_left' => 'Map Rightmenutop Left',
            'map_continent' => 'Map Continent',
            'map_land_id_begin' => 'Map Land Id Begin',
            'map_land_id_end' => 'Map Land Id End',
        ];
    }

    /**
     * 
     * @param unknown $map_id
     * @return \app\models\Map|NULL
     */
    public static function findMapById($map_id){
    	return self::find()->where(['map_id' => $map_id])->one();
    }
    
    /**
     *  
     * @return \app\models\Map[]
     */
    public static function findAllMap(){
    	return self::find()->all();
    }
    
    /**
     * @inheritdoc
     * @return \app\queries\MapQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\MapQuery(get_called_class());
    }
}
