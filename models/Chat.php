<?php

namespace app\models;

use Yii;
use app\classes\ChatClass;

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
     * 
     * @param unknown $game_id
     * @param unknown $time
     * @param number $limit
     */
    public static function getGameChatToArray($game_id, $time=null, $limit=10){
    	$returned = array();
    	foreach (self::getGameChat($game_id, $time, $limit) as $chat){
    		array_push($returned, new ChatClass($chat));
    	}
    	return $returned;
    }
    
   /**
    * 
    * @param unknown $time
    * @param number $limit
    */
    public static function getGlobalChatToArray($time=null, $limit=10){
    	$returned = array();
    	foreach (self::getGlobalChat($time, $limit) as $chat){
    		array_push($returned, new ChatClass($chat));
    	}
    	return $returned;
    }
    
    /**
     *
     * @param unknown $game_id
     * @param unknown $time
     * @param number $limit
     */
    public static function getGameUnReadChatToArray($game_id, $user_id, $time=null, $limit=10){
    	$returned = array();
    	foreach (self::getGameUnReadChat($game_id, $user_id, $time, $limit) as $chat){
    		array_push($returned, new ChatClass($chat));
    	}
    	return $returned;
    }
    
    /**
     * 
     * @param unknown $user_id
     * @param unknown $game_id
     * @param unknown $time
     */
    public static function countUserUnReadChat($game_id, $user_id, $time=null){
    	return count(self::getGameUnReadChat($game_id, $user_id, $time));
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $user_id
     * @param unknown $time
     * @param unknown $limit
     * @return \app\models\Chat[]
     */
    public static function getGameUnReadChat($game_id, $user_id, $time=null, $limit=null){
    	if($time === null) $time = ChatRead::getUserLastChatReadTimeInGame($game_id, $user_id);
    	return self::find()->where(['chat_game_id' => $game_id])->andWhere(['chat_user_id' => $user_id])->andWhere("chat_time >= ".$time)->orderBy(['chat_time' => SORT_ASC])->orderBy(['chat_time' => SORT_ASC])->all();
    }
    
    /**
     * 
     * @param number $limit
     * @param unknown $time
     * @return \app\models\Chat[]
     */
    public static function getGlobalChat($limit=10, $time=null){
    	if($time == null)
    		return self::find()->orderBy(['chat_time' => SORT_ASC])->limit($limit)->all();
    	else
    		return self::find()->where("chat_time >= ".$time)->orderBy(['chat_time' => SORT_ASC])->limit($limit)->all();
    }
    
    /**
     * 
     * @param unknown $game_id
     * @param unknown $time
     * @param number $limit
     * @return \app\models\Chat[]
     */
    public static function getGameChat($game_id, $time=null, $limit=10){
    	if($time == null)
    		return self::find()->where(['chat_game_id' => $game_id])->orderBy(['chat_time' => SORT_ASC])->limit($limit)->all();
    	else
    		return self::find()->where(['chat_game_id' => $game_id])->andWhere("chat_time >= ".$time)->orderBy(['chat_time' => SORT_ASC])->limit($limit)->all();
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
