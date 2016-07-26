<?php

namespace app\models;

use Yii;
use app\queries\ColorQuery;
use app\classes\ColorClass;

/**
 * This is the model class for table "color".
 *
 * @property string $color_id
 * @property string $color_name
 * @property string $color_codeHex
 * @property string $color_code
 * @property string $color_css
 * @property string $color_font_chat
 * @property string $color_font_news
 * @property string $color_font_other
 * @property integer $color_hide
 */
class Color extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'color';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['color_name', 'color_codeHex', 'color_code', 'color_css', 'color_font_chat', 'color_font_news', 'color_font_other', 'color_hide'], 'required'],
            [['color_hide'], 'integer'],
            [['color_name'], 'string', 'max' => 64],
            [['color_codeHex', 'color_code', 'color_css', 'color_font_chat', 'color_font_news', 'color_font_other'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'color_id' => 'Color ID',
            'color_name' => 'Color Name',
            'color_fr' => 'Color Fr',
            'color_codeHex' => 'Color Code Hex',
            'color_code' => 'Color Code',
            'color_css' => 'Color Css',
            'color_font_chat' => 'Color Font Chat',
            'color_font_news' => 'Color Font News',
            'color_font_other' => 'Color Font Other',
            'color_hide' => 'Color Hide',
        ];
    }

    /**
     * 
     * @param unknown $color_id
     * @return \app\classes\ColorClass
     */
    public static function findColorById($color_id){
    	return new ColorClass(self::find()->where(['color_id' => $color_id])->one());
    }
    
    /**
     * 
     * @param unknown $colorData
     * @return NULL|\app\classes\ColorClass
     */
    public static function findAllColorToArray($colorData=null, $hide=null){
    	if($colorData == null)
    		$colorData = self::findAllColor($hide);
    	$array = null;
    	foreach ($colorData as $key => $color){
    		$array[$color['color_id']] = new ColorClass($color);
    	}
    	return $array;
    }
    
    
	/**
	 * 
	 * @param unknown $hide
	 * @return \app\queries\Color[]
	 */
    public static function findAllColor($hide=null){
    	if($hide == null)
    			return self::find()->all();
    		else
    			return self::find()->where(['color_hide' => $hide])->all();
    }
    
    /**
     * @inheritdoc
     * @return ColorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ColorQuery(get_called_class());
    }
}
