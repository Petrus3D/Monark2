<?php

namespace app\classes;
use app\models\GameData;
use app\models\GamePlayer;

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
	private $gameMaxPlayer;
	private $gameCreateTime;
	private $gameStatut;
	private $gameMapId;
	private $gameMapCont;
	private $gameModId;
	private $gameTurnTime;
	private $gameDifficultyId;
	private $gameWonUserId;
	private $gameWonTime;
	private $gameData;
	private $gamePlayer;
	
	/**
	 * 
	 */
	public function __construct($gameData) {
		// DB data
		$this->gameId 			= $gameData['game_id'];	
		$this->gameName 		= $gameData['game_name'];
		$this->gamePassword 	= $gameData['game_pwd'];
		$this->gameOwnerID 		= $gameData['game_owner_id'];
		$this->gameKey 			= $gameData['game_key'];
		$this->gameMaxPlayer 	= $gameData['game_max_player'];
		$this->gameCreateTime 	= $gameData['game_create_time'];
		$this->gameStatut 		= $gameData['game_statut'];
		$this->gameMapId 		= $gameData['game_map_id'];
		$this->gameMapCont 		= $gameData['game_map_cont'];
		$this->gameModId 		= $gameData['game_mod_id'];
		$this->gameTurnTime 	= $gameData['game_turn_time'];
		$this->gameDifficultyId = $gameData['game_difficulty_id'];
		$this->gameWonUserId 	= $gameData['game_won_user_id'];
		$this->gameWonTime 		= $gameData['game_won_time'];
		
		// Player
		$this->gamePlayerArray	= new GamePlayer();
		
		// Data
		$this->gameDataArray	= new GameData();
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
	
	public function getGameKey(){
		return $this->gameKey;
	}
}

?>