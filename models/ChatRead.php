<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chat_read".
 *
 * @property string $chat_read_id
 * @property integer $chat_read_game_id
 * @property integer $chat_read_message_id
 * @property integer $chat_read_user_id
 */
class ChatRead extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chat_read';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chat_read_game_id', 'chat_read_message_id', 'chat_read_user_id'], 'required'],
            [['chat_read_game_id', 'chat_read_message_id', 'chat_read_user_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'chat_read_id' => 'Chat Read ID',
            'chat_read_game_id' => 'Chat Read Game ID',
            'chat_read_message_id' => 'Chat Read Message ID',
            'chat_read_user_id' => 'Chat Read User ID',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\queries\ChatReadyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\ChatReadyQuery(get_called_class());
    }
}
