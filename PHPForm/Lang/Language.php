<?php
namespace Bajdzis\PHPForm\Lang;

class Language
{
	static $currentLanguage = 'English';
	static $arrayLanguage = array();
	
	static function inicjalize()
	{
		self::$setLanguage(self::$language);
	}
	
	static function setLanguage($name)
	{
		$langClass = '\\Bajdzis\\PHPForm\\Lang\\'.$name;
		self::$arrayLanguage = (new $langClass)->lang();
	}
	
	static function l($index)
	{
		return self::$arrayLanguage[$index];
	}
}
?>