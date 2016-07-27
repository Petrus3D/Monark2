<?php

namespace app\classes;

/**
 * 
 * @author Paul
 *
 */
class ResourceClass{
	
	private $resource_id;
	private $resource_name;
	private $resource_freq;
	private $resource_img;
	private $resource_building_id;
	private $resource_description;
	
	/**
	 *
	 */
	public function __construct($resourceData) {
		$this->resourceId 				= $resourceData['resource_id'];
		$this->resourceName 			= $resourceData['resource_name'];
		$this->resourceFreq 			= $resourceData['resource_freq'];
		$this->resourceImage 			= $resourceData['resource_img'];
		$this->resourceBuildingId 		= $resourceData['resource_building_id'];
		$this->resourceDescription 		= $resourceData['resource_description'];
	}
	
	public function getResourceId(){
		return $this->resourceId;
	}
	
	public function getResourceName(){
		return $this->resourceName;
	}
	
	public function getResourceFreq(){
		return $this->resourceFreq;
	}

	public function getResourceImage(){
		return $this->resourceImage;
	}
	
	public function getResourceImageUrl(){
		return 'img/game/'.$this->getResourceImage().'.png';
	}
	
}