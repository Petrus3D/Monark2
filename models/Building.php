<?php

namespace app\models;

use Yii;
use app\classes\BuildingClass;

/**
 * This is the model class for table "building".
 *
 * @property string $building_id
 * @property string $building_name
 * @property integer $building_cost
 * @property integer $building_id_need
 * @property integer $building_gold_income
 * @property integer $building_petrol_income
 * @property string $building_description
 * @property string $building_img
 */
class Building extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'building';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['building_name', 'building_cost', 'building_id_need', 'building_gold_income', 'building_petrol_income', 'building_description'], 'required'],
            [['building_cost', 'building_id_need', 'building_gold_income', 'building_petrol_income'], 'integer'],
            [['building_name', 'building_img'], 'string', 'max' => 128],
            [['building_description'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'building_id' => 'Building ID',
            'building_name' => 'Building Name',
            'building_cost' => 'Building Cost',
            'building_id_need' => 'Building Id Need',
            'building_gold_income' => 'Building Gold Income',
            'building_petrol_income' => 'Building Petrol Income',
            'building_description' => 'Building Description',
        	'building_img'	=> 'Building Img',
        ];
    }

    /**
     * 
     * @param unknown $existantBuildingsId
     * @param unknown $landRessourceId
     * @param unknown $buildingData
     */
    public static function getBuildingsToBuild($existantBuildingsId, $landRessourceId, $buildingData){
    	$returned = array();
    	foreach ($buildingData as $building) {
			
			// If building answer the ressource needs
    		if($building->getBuildingNeed() == $landRessourceId || $building->getBuildingNeed() == 0){
    	
    			// If not already build
    			if (!in_array($building->getBuildingId(), $existantBuildingsId)) {
    				array_push($returned, $building);
    			}
    		}
    	}
    	
    	return $returned;
    }
    
    /**
     *
     * @param unknown $continent_id
     * @return \app\classes\ContinentClass
     */
    public static function findBuildingById($building_id){
    	return new BuildingClass(self::find()->where(['building_id' => $building_id])->one());
    }
    
    /**
     *
     * @param unknown $map_id
     * @return NULL|\app\classes\ContinentClass
     */
    public static function findAllBuildingToArray($buildingData=null){
    	if($buildingData == null)
    		$buildingData = self::findAllBuilding();
    	$array = null;
    	foreach ($buildingData as $key => $building){
    		$array[$building['building_id']] = new BuildingClass($building);
    	}
    	return $array;
    }
    
    /**
     *
     * @param unknown $map_id
     * @return \app\models\Continent[]
     */
    public static function findAllBuilding(){
    	return self::find()->all();
    }
    
    /**
     * @inheritdoc
     * @return \app\queries\BuildingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\BuildingQuery(get_called_class());
    }
}
