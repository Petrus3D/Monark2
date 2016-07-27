<?php

namespace app\classes;

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
	private $buyLandId;
	
	/**
	 * 
	 */
	public function __construct($buyData) {
		// DB data
		$this->buyId 				= $buyData['buy_id'];	
		$this->buyUserId 			= $buyData['buy_user_id'];
		$this->buyTurnId 			= $buyData['buy_turn_id'];
		$this->buyGameId 			= $buyData['buy_game_id'];
		$this->buyUnitsNb 			= $buyData['buy_units_nb'];
		$this->buyBuildId 			= $buyData['buy_build_id'];
		$this->buyLandId 			= $buyData['buy_land_id'];
	}
	
	public function getBuyId(){
		return $this->buyId;
	}
	
	public function getBuyLandId(){
		return $this->buyLandId;
	}
	
	public function getBuyUnitsNb(){
		return $this->buyUnitsNb;
	}
	
	public function getBuyBuildId(){
		return $this->buyBuildId;
	}
}