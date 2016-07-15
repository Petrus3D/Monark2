<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ressource".
 *
 * @property string $ressource_id
 * @property string $ressource_name
 * @property integer $ressource_freq
 * @property string $ressource_img
 * @property integer $ressource_building_id
 * @property string $ressource_description
 */
class Ressource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ressource';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ressource_name', 'ressource_freq', 'ressource_img', 'ressource_building_id', 'ressource_description'], 'required'],
            [['ressource_freq', 'ressource_building_id'], 'integer'],
            [['ressource_name', 'ressource_img'], 'string', 'max' => 128],
            [['ressource_description'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ressource_id' => 'Ressource ID',
            'ressource_name' => 'Ressource Name',
            'ressource_freq' => 'Ressource Freq',
            'ressource_img' => 'Ressource Img',
            'ressource_building_id' => 'Ressource Building ID',
            'ressource_description' => 'Ressource Description',
        ];
    }
 
    /**
     * 
     * @return \app\models\Ressource[]
     */
    public static function findAllRessources(){
    	return self::find()->all();
    }
    
    /**
     * 
     * @param unknown $lands_count
     * @return number[]|unknown[]|\app\models\Ressource[]
     */
    public static function assignRessourcesToArray($landData, $ressourceData)
    {
    	$assignedRessourcesArray = array();
    
    	foreach ($landData as $land){
    		// 100%
    		$ressourceRand = rand(1, 100);
    		
    		$assignedRessourcesArray[$land->getLandId()] = 0;
    		
    		foreach ($ressourceData as $res) {
    			// If percent correspond
    			if($ressourceRand <= $res['ressource_freq']){
    				
    				// If ressource already defined 
    				if($assignedRessourcesArray[$land->getLandId()] != 0){
    					
    					// If best percent
    					if($res['ressource_freq'] <= $ressourceData[$assignedRessourcesArray[$land->getLandId()]]['ressource_freq']){
    						$assignedRessourcesArray[$land->getLandId()] = $res['ressource_id'];
    					}
    					
    				// If ressource not already defined 
    				}else{
    					$assignedRessourcesArray[$land->getLandId()] = $res['ressource_id'];
    				}
    			}
    		}
    	}
    
    	return $assignedRessourcesArray;
    }
    
    /**
     * @inheritdoc
     * @return \app\queries\RessourceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\RessourceQuery(get_called_class());
    }
}
