<?php

namespace app\classes;

/**
 * 
 * @author Paul
 *
 */
class BuildingClass{
	 
	 private $buildingId;
	 private $buildingName;
	 private $buildingCost;
	 private $buildingIdNeed;
	 private $buildingGoldIncome;
	 private $buildingPetrolIncome;
	 private $buildingDescription;
	 private $buildingImg;
	
	/**
	 * 
	 */
	public function __construct($buildingData) {
		// DB data
		$this->buildingId 				= $buildingData['building_id'];	
		$this->buildingName 			= $buildingData['building_name'];
		$this->buildingCost 			= $buildingData['building_cost'];
		$this->buildingIdNeed 			= $buildingData['building_id_need'];
		$this->buildingGoldIncome 		= $buildingData['building_gold_income'];
		$this->buildingPetrolIncome 	= $buildingData['building_petrol_income'];
		$this->buildingDescription 		= $buildingData['building_description'];
		$this->buildingImg 				= $buildingData['building_img'];
	}
	
	public function getBuildingId(){
		return $this->buildingId;
	}
	
	public function getBuildingName(){
		//return Yii::t('building', $this->buildingName);
		return ucfirst($this->buildingName);
	}
	
	public function getBuildingNeed(){
		return $this->buildingIdNeed;
	}
	
	public function getBuildingDescription(){
		//return Yii::t('building', $this->buildingDescription);
		return $this->buildingDescription;
	}
	
	public function getBuildingImg(){
		return $this->buildingImg;
	}
}