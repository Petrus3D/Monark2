<?php

namespace app\classes;
use app\classes\Crypt;

/**
 * 
 * @author Paul
 *
 */
class GameClass{
	
	private $gameID;
	private $gameName;
	private $gameOwnerID;
	private $gamePassword;
	private $gameType;
	private $gameKey;
	
	/**
	 * 
	 */
	public function __construct($gameData) {
		$this->gameId 			= $gameData['game_id'];	
		$this->gameName 		= $gameData['game_name'];
		$this->gamePassword 	= $gameData['game_pwd'];
		$this->gameOwnerID 		= $gameData['game_owner_id'];
		$this->gameType 		= $gameData['game_type'];
		$this->gameKey 			= $gameData['game_key'];
	}
	
	public function getGameID(){
		return $this->gameID;
	}
	
	public function getGameName(){
		return $this->gameName;
	}
	
	public function getGamePassword(){
		return $this->gamePassword;
	}
	
	public function getGameNameCrypted(){
		return $this->gameNameCrypted;
	}
	
	public function getGameOwnerID(){
		return $this->gameOwnerID;
	}
	
	public function getGameType(){
		return $this->gameType;
	}
	
	public function getGameKey(){
		return $this->gameKey;
	}
}

?>