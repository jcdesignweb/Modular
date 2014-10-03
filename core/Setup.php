<?php

/**
 * 
 * Config class
 * 
 * @author Juan Andrés Carmena <juan14nob@gmail.com>
 * @access public
 */
class Setup{
	
	const CLASSES_FOLDER = "classes";
	
	/**
	 * 
	 * @var const string
	 * @example "development|production"
	 */
	const ENVIRONMENT = "development";
	
	public static $MODULAR_PATH;
	
	private static $MODULAR_ROOT;
	public static $MODULAR_DATA;
	
	public static $MODULAR_MODEL_JSON;
	
	public static function Init() {
		
		if(self:: ENVIRONMENT == "development") {
			error_reporting(E_ALL);
			ini_set("display_errors", "On");
		}
		
		$parent_path = realpath("./"). DIRECTORY_SEPARATOR;
		
		self::$MODULAR_ROOT = realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR;
		self::$MODULAR_PATH = self::$MODULAR_ROOT . self::CLASSES_FOLDER . DIRECTORY_SEPARATOR; 
		
		self::$MODULAR_DATA = $parent_path. "modules/private". DIRECTORY_SEPARATOR;
		
		//self::$MODULAR_MODEL_JSON = $parent_path. "json". DIRECTORY_SEPARATOR ."model.json";
	}
}