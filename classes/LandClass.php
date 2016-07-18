<?php

namespace app\classes;

/**
 * 
 * @author Paul
 *
 */
class LandClass{
	
	private $landId;
	private $landName;
	private $landMapId;
	private $landAbv;
	private $landImage;
	private $landContinentId;
	private $landPositionTop;
	private $landPositionLeft;
	private $landBaseUnits;
	private $landHarbor;
	
	/**
	 *
	 */
	public function __construct($landData) {
		$this->landId 			= $landData['land_id'];
		$this->landName 		= $landData['land_name'];
		$this->landMapId 		= $landData['land_map_id'];
		$this->landAbv 			= $landData['land_abv'];
		$this->landImage 		= $landData['land_image'];
		$this->landContinentId 	= $landData['land_continent_id'];
		$this->landPositionTop 	= $landData['land_position_top'];
		$this->landPositionLeft = $landData['land_position_left'];
		$this->landBaseUnits 	= $landData['land_base_units'];
		$this->landHarbor 		= $landData['land_harbor'];
	}
	
	public function getLandId(){
		return $this->landId;
	}
	
	public function getLandBaseUnits(){
		return $this->landBaseUnits;
	}
	
	public function getLandName(){
		return $this->landName;
	}
	
	public function getLandAbv(){
		return $this->landAbv;
	}
	
	public function getLandContinentId(){
		return $this->landContinentId;
	}
	
	public function getLandPositionTop(){
		return $this->landPositionTop;
	}
	
	public function getLandPositionLeft(){
		return $this->landPositionLeft;
	}
	
	public function getLandHarbor(){
		return $this->landHarbor;
	}
	
	public function getLandImage(){
		if($this->landImage == null)
			return $this->landName;
		else
			return $this->landImage;
	}
	
	public function getLandImageUrl(){
		return 'img/land/'.$this->getLandImage().'.png';
	}
	
	public function getLandImageTempUrl($colorName){
		return 'img/land_temp/'.$this->getLandImage().'_'.$colorName.'.png';
	}
	
}