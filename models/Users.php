<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $user.id
 * @property string $user.name
 * @property string $user.pass
 * @property string $user.mail
 * @property string $user.reg.pass
 * @property integer $user.reg.time
 * @property integer $user.reg.ip
 * @property string $user.reg.mail
 * @property integer $user.log.time
 * @property integer $user.log.ip
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
            [['user.name', 'user.pass', 'user.mail', 'user.reg.pass', 'user.reg.time', 'user.reg.ip', 'user.reg.mail', 'user.log.time', 'user.log.ip'], 'required'],
            [['user.reg.time', 'user.reg.ip', 'user.log.time', 'user.log.ip'], 'integer'],
            [['user.name', 'user.pass', 'user.mail', 'user.reg.pass', 'user.reg.mail'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user.id' => 'User ID',
            'user.name' => 'User Name',
            'user.pass' => 'User Pass',
            'user.mail' => 'User Mail',
            'user.reg.pass' => 'User Reg Pass',
            'user.reg.time' => 'User Reg Time',
            'user.reg.ip' => 'User Reg Ip',
            'user.reg.mail' => 'User Reg Mail',
            'user.log.time' => 'User Log Time',
            'user.log.ip' => 'User Log Ip',
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
