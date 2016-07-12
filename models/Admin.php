<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property string $admin_id
 * @property string $admin_user_key
 * @property string $admin_user_pwd
 * @property integer $admin_user_id
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_user_key', 'admin_user_pwd', 'admin_user_id'], 'required'],
            [['admin_user_id'], 'integer'],
            [['admin_user_key'], 'string', 'max' => 1024],
            [['admin_user_pwd'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'admin_id' => 'Admin ID',
            'admin_user_key' => 'Admin User Key',
            'admin_user_pwd' => 'Admin User Pwd',
            'admin_user_id' => 'Admin User ID',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\queries\AdminQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\AdminQuery(get_called_class());
    }
}
