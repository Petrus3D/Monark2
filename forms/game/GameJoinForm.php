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

    private $_game = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // gamename and password are both required
            [['gamename', 'password', 'player_max'], 'required'],
        	// password is validated by validatePassword()
        	['gamename', 'validateGameName'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        	// player_max is validated by validatePlayerMax()
        	['player_max', 'validatePlayerMax'],
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
    	 $game = $this->getGame();
    
    	 if (!$game || !$game->validatePassword($this->password)) {
    	 $this->addError($attribute, 'Incorrect gamename or password.');
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
        /*if (!$this->hasErrors()) {
            $game = $this->getgame();

            if (!$game || !$game->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect gamename or password.');
            }
        }*/
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
    	/*if (!$this->hasErrors()) {
    	 $game = $this->getgame();
    
    	 if (!$game || !$game->validatePassword($this->password)) {
    	 $this->addError($attribute, 'Incorrect gamename or password.');
    	 }
    	 }*/
    }

    /**
     * Logs in a game using the provided gamename and password.
     * @return boolean whether the game is logged in successfully
     */
    public function create()
    {
        /*if ($this->validate()) {
            return Yii::$app->game->login($this->getgame(), $this->rememberMe ? 3600*24*30 : 0);
        }*/
        return false;
    }

    /**
     * Finds game by [[gamename]]
     *
     * @return game|null
     */
    public function getGame()
    {
        if ($this->_game === false) {
            $this->_game = Game::findByGameName($this->gameName);
        }

        return $this->_game;
    }
}

