<?php

namespace app\forms\user;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\Users;
use app\classes\Crypt;

/**
 * LoginForm is the model behind the login form.
 */
class UserCreateForm extends Model
{
    public $username;
    public $password;
    public $mail;

    private $_user = false;
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'mail'], 'required'],
        	// password is validated by validatePassword()
        	['username', 'validateUserName'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        	// mail is validated by validateMail()
        	['mail', 'validateMail'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for username.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateUserName($attribute, $params)
    { 
    	if ((new Users())->existsUserName($this->username)) {
    	 	$this->addError($attribute, Yii::t('user', 'Error_Name_Already_Used'));
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
     * This method serves as the inline validation for mail.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateMail($attribute, $params)
    {
    	if ((new Users())->existsUserMail($this->mail)) {
    		$this->addError($attribute, Yii::t('user', 'Error_Mail_Already_Used'));
    	}
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function sign()
    {
    	if ($this->validate()) {
	    	// Crypt
	    	// username
	    	$user_name = (new Crypt($this->username))->s_crypt();
	    	// password
	    	$user_pwd = (new Crypt($this->password))->crypt();
	    	
	    	// Create in db
	    	(new Users())->createUser($user_name, $user_pwd, $this->mail);
	    	return true;
	    }
	    return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}

