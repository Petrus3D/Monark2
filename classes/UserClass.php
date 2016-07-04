<?php

namespace app\classes;
use app\classes\Crypt;

/**
 * 
 * @author Paul
 *
 */
class UserClass{
	
	private $userID;
	private $userName;
	private $userNameCrypted;
	private $userMail;
	private $userPassword;
	private $userType;
	private $userKey;
	
	/**
	 * 
	 */
	public function __construct($userData) {
		$this->userId 			= $userData['user_id'];	
		$this->userNameCrypted 	= $userData['user_name'];
		$this->userPassword 	= $userData['user_pwd'];
		$this->userMail 		= $userData['user_mail'];
		$this->userType 		= $userData['user_type'];
		$this->userKey 			= $userData['user_key'];
	}
	
	public function getUserID(){
		return $this->userID;
	}
	
	public function getUserPassword(){
		return $this->userPassword;
	}
	
	public function getUserNameCrypted(){
		return $this->userNameCrypted;
	}
	
	public function getUserMail(){
		return $this->userMail;
	}
	
	public function getUserType(){
		return $this->userType;
	}
	
	public function getUserKey(){
		return $this->userKey;
	}
	
	public function getUserName(){
		return (new Crypt($this->userNameCrypted))->s_decrypt();
	}
}

?>