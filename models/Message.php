<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property string $id
 * @property integer $game_id
 * @property integer $time
 * @property string $message
 * @property string $subject
 * @property integer $pact_id
 * @property integer $user_send_id
 * @property integer $user_receive_id
 * @property integer $del
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_id', 'time', 'message', 'subject', 'pact_id', 'user_send_id', 'user_receive_id', 'del'], 'required'],
            [['game_id', 'time', 'pact_id', 'user_send_id', 'user_receive_id', 'del'], 'integer'],
            [['message'], 'string', 'max' => 256],
            [['subject'], 'string', 'max' => 128]
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
            'time' => 'Time',
            'message' => 'Message',
            'subject' => 'Subject',
            'pact_id' => 'Pact ID',
            'user_send_id' => 'User Send ID',
            'user_receive_id' => 'User Receive ID',
            'del' => 'Del',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\queries\MessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\MessageQuery(get_called_class());
    }
}
