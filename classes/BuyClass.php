<?php

namespace app\classes;
use Yii;
/**
 * 
 * @author Paul
 *
 */
class BuyClass{
	 
	private $buyId;
	private $buyUserId;
	private $buyTurnId;
	private $buyGameId;
	private $buyUnitsNb;
	private $buyBuildId;
	
	/**
	 * 
	 */
	public function __construct($buyData) {
		// DB data
		$this->buyId 				= $buildingData['buy_id'];	
		$this->buyUserId 			= $buildingData['buy_user_id'];
		$this->buyTurnId 			= $buildingData['buy_turn_id'];
		$this->buyGameId 			= $buildingData['buy_game_id'];
		$this->buyUnitsNb 			= $buildingData['buy_units_nb'];
		$this->buyBuildId 			= $buildingData['buy_build_id'];
	}
	
	public function getBuyId(){
		return $this->buyId;
	}
	
	public function getBuyUnitsNb(){
		return $this->buyUnitsNb;
	}
	
	public function getBuyBuildId(){
		return $this->buyBuildId;
	}
}