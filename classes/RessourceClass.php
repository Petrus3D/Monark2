<?php

namespace app\classes;

/**
 * 
 * @author Paul
 *
 */
class RessourceClass{
	
	private $ressource_id;
	private $ressource_name;
	private $ressource_freq;
	private $ressource_img;
	private $ressource_building_id;
	private $ressource_description;
	
	/**
	 *
	 */
	public function __construct($ressourceData) {
		$this->ressourceId 				= $ressourceData['ressource_id'];
		$this->ressourceName 			= $ressourceData['ressource_name'];
		$this->ressourceFreq 			= $ressourceData['ressource_freq'];
		$this->ressourceImage 			= $ressourceData['ressource_img'];
		$this->ressourceBuildingId 		= $ressourceData['ressource_building_id'];
		$this->ressourceDescription 	= $ressourceData['ressource_description'];
	}
	
	public function getRessourceId(){
		return $this->ressourceId;
	}
	
	public function getRessourceName(){
		return $this->ressourceName;
	}
	
	public function getRessourceFreq(){
		return $this->ressourceFreq;
	}

	public function getRessourceImage(){
		return $this->ressourceImage;
	}
	
	public function getressourceImageUrl(){
		return 'img/game/'.$this->getRessourceImage().'.png';
	}
	
}