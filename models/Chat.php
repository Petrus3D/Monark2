<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property string $chat_id
 * @property integer $chat_game_id
 * @property integer $chat_user_id
 * @property string $chat_message
 * @property integer $chat_time
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chat_game_id', 'chat_user_id', 'chat_message', 'chat_time'], 'required'],
            [['chat_game_id', 'chat_user_id', 'chat_time'], 'integer'],
            [['chat_message'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'chat_id' => 'Chat ID',
            'chat_game_id' => 'Chat Game ID',
            'chat_user_id' => 'Chat User ID',
            'chat_message' => 'Chat Message',
            'chat_time' => 'Chat Time',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\queries\ChatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\ChatQuery(get_called_class());
    }
}
