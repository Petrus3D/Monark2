<?php

namespace app\forms\game;

use Yii;
use yii\base\Model;
use app\models\Game;

/**
 * LoginForm is the model behind the login form.
 */
class gameCreateForm extends Model
{
    public $game_name;
    public $game_pwd;
    public $game_max_player;

    private $_game;

	public function __construct(){
		$this->_game = new Game();
	}
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // gamename and password are both required
            [['game_name', 'game_pwd', 'game_max_player'], 'required'],
        	// password is validated by validatePassword()
        	['game_name', 'validateGameName'],
            // password is validated by validatePassword()
            ['game_pwd', 'validatePassword'],
        	// player_max is validated by validatePlayerMax()
        	['game_max_player', 'validatePlayerMax'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for gamename.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateGameName($attribute, $params)
    {
    	if (!$this->hasErrors()) {    
    	 if ($this->_game->existsGameName($this->game_name)) {
    	 	$this->addError($attribute, Yii::t('game', 'Error_Name_Already_Use'));
    	 }
    	}
    }
    
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        
    }
    
    /**
     * Validates the mail.
     * This method serves as the inline validation for player_max.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePlayerMax($attribute, $params)
    {
    	if (!$this->hasErrors()) {
    	 if ($this->game_max_player > 10) {
    	 	$this->addError($attribute, Yii::t('game', 'Error_Max_Player_Nb'));
    	 }
    	}
    }

    /**
     * Create a game using the provided gamename and password.
     * @return boolean whether the game is created in successfully
     */
    public function create()
    {
        $this->_game->createGame($this->game_name, $this->game_pwd, $this->game_max_player);
        return false;
    }
}

