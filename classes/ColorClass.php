<?php

namespace app\classes;

use Yii;

/**
 *
 * @author Paul
 *
 */
class ColorClass{

	 private $color_id;
	 private $color_name;
	 private $color_fr;
	 private $color_codeHex;
	 private $color_code;
	 private $color_css;
	 private $color_font_chat;
	 private $color_font_news;
	 private $color_font_other;
	 private $color_hide;

	/**
	 *
	 */
	public function __construct($colorData) {
		// DB data
		$this->color_id 					= $colorData['color_id'];
		$this->color_name 				= Yii::t('color', $colorData['color_name']);
		$this->color_fr 					= $colorData['color_fr'];
		$this->color_codeHex 			= $colorData['color_codeHex'];
		$this->color_code 				= $colorData['color_code'];
		$this->color_css 					= $colorData['color_css'];
		$this->color_font_chat 		= $colorData['color_font_chat'];
		$this->color_font_news 		= $colorData['color_font_news'];
		$this->color_font_other 	= $colorData['color_font_other'];
		$this->color_hide 				= $colorData['color_hide'];
	}

	public function getColorId(){
		return $this->color_id;
	}

	public function getColorName(){
		return ucfirst($this->color_name);
	}

	public function getColorName2(){
		return $this->color_name;
	}

	public function getColorCode(){
		return $this->color_code;
	}

	public function getColorCSS(){
		return $this->color_css;
	}

	public function getColorFontChat(){
		return $this->color_font_chat;
	}
}
