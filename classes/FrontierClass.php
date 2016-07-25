<?php

namespace app\classes;

/**
 * 
 * @author Paul
 *
 */
class FrontierClass{
	 
	 private $frontierId;
	 private $frontierLandIdOne;
	 private $frontierLandIdTwo;
	 private $frontierMapId;
	
	/**
	 * 
	 */
	public function __construct($frontierData) {
		// DB data
		$this->frontierId 				= $frontierData['frontier_id'];	
		$this->frontierLandIdOne 		= $frontierData['frontier_land_id_one'];
		$this->frontierLandIdTwo 		= $frontierData['frontier_land_id_two'];
		$this->frontierMapId 			= $frontierData['frontier_map_id'];
	}
	
	public function getFrontierId(){
		return $this->frontierId;
	}
	
	public function getFrontierLandIdOne(){
		return $this->frontierLandIdOne;
	}
	
	public function getFrontierLandIdTwo(){
		return $this->frontierLandIdTwo;
	}
}