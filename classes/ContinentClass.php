<?php

namespace app\classes;

/**
 * 
 * @author Paul
 *
 */
class ContinentClass{
	
	private $continent_id;
	private $continent_name;
	private $continent_bonus;
	private $continent_land_id_begin;
	private $continent_land_id_end;
	private $continent_hide;
	private $continent_map_id;
	
	/**
	 * 
	 */
	public function __construct($continentData) {
		// DB data
		$this->continent_id 			= $continentData['continent_id'];	
		$this->continent_name 			= $continentData['continent_name'];
		$this->continent_bonus 			= $continentData['continent_bonus'];
		$this->continent_land_id_begin 	= $continentData['continent_land_id_begin'];
		$this->continent_land_id_end 	= $continentData['continent_land_id_end'];
		$this->continent_hide 			= $continentData['continent_hide'];
		$this->continent_map_id 		= $continentData['continent_map_id'];
	}
	
	public function getContinentId(){
		return $this->continent_id;
	}
	
	public function getContinentName(){
		return $this->continent_name;
	}
}