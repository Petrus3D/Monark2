<?php

namespace app\models;

use Yii;
use app\queries\ContinentQuery;
use app\classes\ContinentClass;

/**
 * This is the model class for table "continent".
 *
 * @property integer $continent_id
 * @property string $continent_name
 * @property integer $continent_bonus
 * @property integer $continent_land_id_begin
 * @property integer $continent_land_id_end
 * @property integer $continent_hide
 * @property integer $continent_map_id
 */
class Continent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'continent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['continent_name', 'continent_bonus', 'continent_land_id_begin', 'continent_land_id_end', 'continent_hide', 'continent_map_id'], 'required'],
            [['continent_bonus', 'continent_land_id_begin', 'continent_land_id_end', 'continent_hide', 'continent_map_id'], 'integer'],
            [['continent_name'], 'string', 'max' => 126]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'continent_id' => 'Continent ID',
            'continent_name' => 'Continent Name',
            'continent_bonus' => 'Continent Bonus',
            'continent_land_id_begin' => 'Continent Land Id Begin',
            'continent_land_id_end' => 'Continent Land Id End',
            'continent_hide' => 'Continent Hide',
            'continent_map_id' => 'Continent Map ID',
        ];
    }

    /**
     * 
     * @param unknown $continent_id
     * @return \app\classes\ContinentClass
     */
    public static function findContinentById($continent_id){
    	return new ContinentClass(self::find()->where(['continent_id' => $continent_id])->one());
    }
    
	/**
	 * 
	 * @param unknown $map_id
	 * @return NULL|\app\classes\ContinentClass
	 */
    public static function findAllContinentToArray($map_id, $continentData=null){
    	if($continentData === null)
    		$continentData = self::findAllContinent($map_id);
    	$array = null;
    	foreach ($continentData as $key => $continent){
    		$array[$continent['continent_id']] = new ContinentClass($continent);
    	}
    	return $array;
    }
        
    /**
     * 
     * @param unknown $map_id
     * @return \app\models\Continent[]
     */
    public static function findAllContinent($map_id, $hide=null){
    	if($hide === null)
    		return self::find()->where(['continent_map_id' => $map_id])->all();
    	else
    		return self::find()->where(['continent_map_id' => $map_id])->andWhere(['continent_hide' => $hide])->all();
    }
    
    /**
     * @inheritdoc
     * @return \app\queries\ContinentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContinentQuery(get_called_class());
    }
}
