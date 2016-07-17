<?php 

namespace app\classes;

use Yii;

/**
* Class permettant de donner l'accès aux pages
*/

class Access
{
	
	/**
	 * 
	 * @return boolean
	 */
	public static function UserIsConnected(){
		if(Yii::$app->user->isGuest || Yii::$app->session['User'] == null)
			return false;
		else 
			return true;
	}
	
	/**
	 * 
	 * @return boolean
	 */
	public static function UserIsInGame(){
		if(self::UserIsConnected() && Yii::$app->session['Game'] != null)
			return true;
		else
			return false;
	}
	
	/**
	 *
	 * @return boolean
	 */
	public static function UserIsInNotStartedGame(){
		if(self::UserIsConnected() && Yii::$app->session['Game'] != null && Yii::$app->session['Game']->getGameStatut() < 50)
				return true;
			else
				return false;
	}
	
	/**
	 * 
	 * @return boolean
	 */
	public static function UserIsInStartedGame(){
		if(self::UserIsConnected() && Yii::$app->session['Game'] != null && Yii::$app->session['Game']->getGameStatut() == 50)
			return true;
		else
			return false;
	}
	
	/**
	 *
	 * @return boolean
	 */
	public static function UserIsInEndedGame(){
		if(self::UserIsConnected() && Yii::$app->session['Game'] != null && Yii::$app->session['Game']->getGameStatut() == 100)
			return true;
			else
				return false;
	}
	
}

?>