<?php

namespace app\models;

use Yii;
use app\queries\UserQuery;
use app\classes\Crypt;

/**
 * This is the model class for table "user".
 *
 * @property string $user_id
 * @property string $user_name
 * @property string $user_mail
 * @property string $user_ip
 * @property integer $user_registration_time
 * @property integer $user_last_login
 * @property integer $user_role
 * @property integer $user_type
 * @property string $user_key
 * @property string $user_authKey
 * @property string $user_accessToken
 * @property string $user_pwd
 * @property string $user_pwd2
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_name', 'user_mail', 'user_ip', 'user_registration_time', 'user_last_login', 'user_role', 'user_type', 'user_key', 'user_authKey', 'user_accessToken', 'user_pwd', 'user_pwd2'], 'required'],
            [['user_registration_time', 'user_last_login', 'user_role', 'user_type'], 'integer'],
            [['user_name', 'user_key'], 'string', 'max' => 256],
            [['user_mail', 'user_authKey', 'user_accessToken'], 'string', 'max' => 128],
            [['user_ip'], 'string', 'max' => 16],
            [['user_pwd', 'user_pwd2'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'user_mail' => 'User Mail',
            'user_ip' => 'User Ip',
            'user_registration_time' => 'User Registration Time',
            'user_last_login' => 'User Last Login',
            'user_role' => 'User Role',
            'user_type' => 'User Type',
            'user_key' => 'User Key',
            'user_authKey' => 'User Auth Key',
            'user_accessToken' => 'User Access Token',
            'user_pwd' => 'User Pwd',
            'user_pwd2' => 'User Pwd2',
        ];
    }
    
    /**
     *
     * @param unknown $gameName
     * @return boolean
     */
    public static function existsUserName($userName){
    	if(self::find()->where(['user_name' => (new Crypt($userName))->s_crypt()])->one() != null)
    		return true;
    	else
    		return false;
    }
    
    /**
     *
     * @param unknown $gameName
     * @return boolean
     */
    public static function existsUserMail($userMail){
    	if(self::find()->where(['user_mail' => $userMail])->one() != null)
    		return true;
    	else
    		return false;
    }
    
    /**
     * 
     * @param unknown $arrayUserId
     * @return \app\queries\User[]
     */
    public static function getListUserByListUserId($arrayUserId){
    	$query = self::find();
    	foreach($arrayUserId as $Id){
    		$query->orWhere(['like','user_id', $Id]);
    	}
    	return $query->all();
    }
    
    /**
     * 
     * @param unknown $mail
     * @param unknown $type
     * @param unknown $namecrypted
     * @param unknown $pwdcrypted
     * @param unknown $userkey
     */
	public static function CreateUser($user_name, $user_pwd, $user_mail, $user_type=0, $user_key="")
    {
        Yii::$app->db->createCommand()->insert("user", [
            'user_name' => $user_name,
            'user_pwd' => $user_pwd,
            'user_pwd2' => $user_pwd,
            'user_mail' => $user_mail,
            'user_registration_time' => time(),
            'user_last_login' => 0,
            'user_ip' => 0,
            'user_type' => $user_type,
            'user_key' => $user_key,
        ])->execute();
    }
    
    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
    	return new UserQuery(get_called_class());
    }
}
