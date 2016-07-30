<?php

namespace app\classes;

use Yii;

/**
 *
 * @author Paul
 *
 */
class ColorClass{

	 private $colorId;
	 private $colorName;
	 private $colorCodeHex;
	 private $colorCode;
	 private $colorCss;
	 private $colorFontChat;
	 private $colorFontNews;
	 private $colorFontOther;
	 private $colorHide;

	/**
	 *
	 */
	public function __construct($colorData) {
		$this->colorId 					= $colorData['color_id'];
		$this->colorName 				= $colorData['color_name'];
		$this->colorCodeHex 			= $colorData['color_codeHex'];
		$this->colorCode 				= $colorData['color_code'];
		$this->colorCss 				= $colorData['color_css'];
		$this->colorFontChat 			= $colorData['color_font_chat'];
		$this->colorFontNews 			= $colorData['color_font_news'];
		$this->colorFontOther 			= $colorData['color_font_other'];
		$this->colorHide 				= $colorData['color_hide'];
	}

	public function getColorId(){
		return $this->colorId;
	}

	public function getColorName(){
		return Yii::t('color', $this->colorName);
	}

	public function getColorName2(){
		return $this->colorName;
	}

	public function getColorCode(){
		return $this->colorCode;
	}

	public function getColorCSS(){
		return $this->colorCss;
	}

	public function getColorFontChat(){
		return $this->colorFontChat;
	}
	
	public function getColorFontOther(){
		return $this->colorFontOther;
	}
	
	public function getColorHide(){
		return $this->colorHide;
	}
}
