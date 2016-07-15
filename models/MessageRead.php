<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "message_read".
 *
 * @property string $id
 * @property integer $game_id
 * @property integer $message_id
 * @property integer $user_receive_id
 * @property integer $time
 */
class MessageRead extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message_read';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_id', 'message_id', 'user_receive_id', 'time'], 'required'],
            [['game_id', 'message_id', 'user_receive_id', 'time'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'game_id' => 'Game ID',
            'message_id' => 'Message ID',
            'user_receive_id' => 'User Receive ID',
            'time' => 'Time',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\queries\MessageReadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\MessageReadQuery(get_called_class());
    }
}
