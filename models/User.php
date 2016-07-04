<?php

namespace app\models;
use app\models\Users;
use app\classes\Crypt;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
	public $user_id;
	public $user_name;
	public $user_mail;
	public $user_ip;
	public $user_registration_time;
	public $user_last_login;
	public $user_role;
	public $user_type;
	public $user_key;
	public $user_authKey;
	public $user_accessToken;
	public $user_pwd;
	public $user_pwd2;
	
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
    	$user = Users::find()->where(['user_id' => $id])->one();
        return isset($user) ? new static($user) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    	$user = Users::find()->where(['user_accessToken' => $token])->one();
        return isset($user) ? new static($user) : null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
    	
        $user = Users::find()->where(['user_name' => (new Crypt($username))->s_crypt()])->one();
        return isset($user) ? new static($user) : null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->user_authKey;
    }

    /**
     * @inheritdoc
     */
    public function getUsername(){
    	return (new Crypt($this->user_pwd))->decrypt();
    }
    
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->user_authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->getUsername() === $password;
    }
}
