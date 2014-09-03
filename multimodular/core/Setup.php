<?php

class Setup{
	
	const CLASSES_FOLDER = "classes";
	const UP = "./";
	public static $MODULAR_PATH;
	
	private static $MODULAR_ROOT;
	public static $MODULAR_DATA;
	public static $MODULAR_DS;
	
	public static function Init() {
		
		error_reporting(E_ALL);
		ini_set("display_errors", "On");
		
		self::$MODULAR_DS = DIRECTORY_SEPARATOR;
		self::$MODULAR_ROOT = realpath(dirname(__FILE__)) . self::$MODULAR_DS;
		self::$MODULAR_PATH = self::$MODULAR_ROOT . self::CLASSES_FOLDER . self::$MODULAR_DS; 
		
		//echo self::$MODULAR_PATH;exit;
		self::$MODULAR_DATA = realpath(self::UP). self::$MODULAR_DS. "modules/private". self::$MODULAR_DS;
	//	echo self::$MODULAR_DATA;exit;
	}	 
}