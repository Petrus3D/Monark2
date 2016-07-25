<?php

namespace app\models;

use Yii;
use app\classes\FrontierClass;

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
     * 
     * @param unknown $userFrontierArray
     * @param unknown $land_focus_id
     * @return boolean
     */
    public static function userHaveFrontierLand($userFrontierArray, $land_focus_id){
    	if(in_array($land_focus_id, $userFrontierArray))
    		return true;
		return false;
    }
    
    /**
     * 
     * @param unknown $gameData
     * @param unknown $user_id
     * @param unknown $frontierData
     * @param unknown $map_id
     */
    public static function userHaveFrontierLandArray($gameData, $user_id, $frontierData=null, $owned=true, $map_id=null){
    	if($frontierData == null)
    		$frontierData = self::findAllFrontier($map_id);
    	$userFrontierArray = array();
    	foreach($gameData as $land){
    		if($land->getGameDataUserId() == $user_id){
    			// Himself
    			if(!in_array($land->getGameDataLandId(), $userFrontierArray) && $owned)
    				array_push($userFrontierArray, $land->getGameDataLandId());
    			
    			// Others
    			foreach (self::landHaveFrontierLandArray($frontierData, $land->getGameDataLandId()) as $landFrontier){
    				if(!in_array($landFrontier, $userFrontierArray))
    					array_push($userFrontierArray, $landFrontier);
    			}
    		}
    	}
    	return $userFrontierArray;
    }
    
    /**
     * 
     * @param unknown $frontierData
     * @param unknown $land_id
     */
    public static function landHaveFrontierLandArray($frontierData, $land_id){
    	$landFrontierArray = array();
    	foreach($frontierData as $frontier){
    		if($frontier['frontier_land_id_one'] == $land_id){
    			array_push($landFrontierArray, $frontier['frontier_land_id_two']);
    		}
    	}
    	return $landFrontierArray;
    }
    
    
    /**
     * 
     * @param unknown $land_focus_id
     * @param unknown $frontierData
     * @param unknown $map_id
     * @param unknown $land_id
     * @return boolean
     */
    public static function landsFrontierExists($land_focus_id, $frontierData=null, $map_id=null, $land_id=null){
    	if($frontierData == null)
    		$frontierData = self::findAllFrontier($map_id);
    	foreach ($frontierData as $key => $frontier){
    		/* ||
    			($frontier['frontier_land_id_two'] == $land_id 
    			&& $frontier['frontier_land_id_one'] == $land_focus_id)*/
    		if(($frontier['frontier_land_id_one'] == $land_id 
    			&& $frontier['frontier_land_id_two'] == $land_focus_id)){
    			return true;
    		}
    	}
    	return false;
    }
    
    /**
     *
     * @param unknown $continent_id
     * @return \app\classes\ContinentClass
     */
    public static function findAllFrontierById($land_id, $map_id){
    	return self::find()->where(['frontier_land_id_one' => $land_id])->andWhere(['frontier_map_id' => $map_id])->all();
    }
    
    /**
     *
     * @param unknown $map_id
     * @return \app\models\Frontier[]
     */
    public static function findAllFrontier($map_id){
    	return self::find()->where(['frontier_map_id' => $map_id])->all();
    }
    
    /**
     *
     * @param unknown $map_id
     * @return NULL|\app\classes\ContinentClass
     */
    public static function findAllFrontierToArray($frontierData=null, $map_id=null, $land_id=null){
    	if($frontierData == null)
    		$frontierData = self::findAllFrontier($map_id);
    	$array = null;
    	foreach ($frontierData as $key => $frontier){
    		$array[$frontier['frontier_land_id_one']] = new FrontierClass($frontier);
    	}
    	return $array;
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
