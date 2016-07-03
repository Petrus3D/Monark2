<?php

namespace app\models;

use Yii;
use app\queries\UserQuery;

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
 * @property string $user_pwd
 * @property string $user_pwd2
 */
class User extends \yii\db\ActiveRecord
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
            [['user_name', 'user_mail', 'user_ip', 'user_registration_time', 'user_last_login', 'user_role', 'user_type', 'user_key', 'user_pwd', 'user_pwd2'], 'required'],
            [['user_registration_time', 'user_last_login', 'user_role', 'user_type'], 'integer'],
            [['user_name', 'user_key'], 'string', 'max' => 256],
            [['user_mail'], 'string', 'max' => 128],
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
            'user_pwd' => 'User Pwd',
            'user_pwd2' => 'User Pwd2',
        ];
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
