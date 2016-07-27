<?php

namespace app\models;

use Yii;
use app\classes\ResourceClass;

/**
 * This is the model class for table "resource".
 *
 * @property string $resource_id
 * @property string $resource_name
 * @property integer $resource_freq
 * @property string $resource_img
 * @property integer $resource_building_id
 * @property string $resource_description
 */
class Resource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'resource';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['resource_name', 'resource_freq', 'resource_img', 'resource_building_id', 'resource_description'], 'required'],
            [['resource_freq', 'resource_building_id'], 'integer'],
            [['resource_name', 'resource_img'], 'string', 'max' => 128],
            [['resource_description'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'resource_id' => 'resource ID',
            'resource_name' => 'resource Name',
            'resource_freq' => 'resource Freq',
            'resource_img' => 'resource Img',
            'resource_building_id' => 'resource Building ID',
            'resource_description' => 'resource Description',
        ];
    }
 
    /**
     * 
     * @return \app\models\resource[]
     */
    public static function findAllResources(){
    	return self::find()->all();
    }
    
    /**
     * 
     * @return \app\classes\resourceClass[]
     */
    public static function findAllResourcesToArray(){
    	$returned = array(); 
    	foreach (self::findAllResources() as $resource)
    		$returned[$resource['resource_id']] = new ResourceClass($resource);
    	return $returned;
    }
    
    /**
     * 
     * @param unknown $lands_count
     * @return number[]|unknown[]|\app\models\resource[]
     */
    public static function assignResourcesToArray($landData, $resourceData)
    {
    	$assignedResourcesArray = array();
    
    	foreach ($landData as $land){
    		// 100%
    		$resourceRand = rand(1, 100);
    		
    		$assignedResourcesArray[$land->getLandId()] = 0;
    		
    		foreach ($resourceData as $res) {
    			// If percent correspond
    			if($resourceRand <= $res['resource_freq']){
    				
    				// If resource already defined 
    				if($assignedResourcesArray[$land->getLandId()] != 0){
    					
    					// If best percent
    					if($res['resource_freq'] <= $resourceData[$assignedResourcesArray[$land->getLandId()]]['resource_freq']){
    						$assignedResourcesArray[$land->getLandId()] = $res['resource_id'];
    					}
    					
    				// If resource not already defined 
    				}else{
    					$assignedResourcesArray[$land->getLandId()] = $res['resource_id'];
    				}
    			}
    		}
    	}
    
    	return $assignedResourcesArray;
    }
    
    /**
     * @inheritdoc
     * @return \app\queries\resourceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\ResourceQuery(get_called_class());
    }
}
