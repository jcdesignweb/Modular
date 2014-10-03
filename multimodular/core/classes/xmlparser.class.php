<?php

class XmlParser {
	private $xml;

	protected static $pathfile = './core/res/values.xml'; // string

	public function __construct() {
			
		if(file_exists(self::$pathfile)) {
			$this->xml = simplexml_load_file(self::$pathfile);
		} else {
			die("Error : xml file not found, file: ".self::$pathfile);
		}
	}
	
	public function __destruct() {
		$this->xml = null;
	}
	
	/**
	 * 
	 * @param string $att
	 * @return string|false
	 */
	public function getMessage($att) {
		
		for($i = 0; $i < count($this->xml->errors->error); $i++) {
			
			if($this->xml->errors->error[$i]->attributes()->type == $att) {
				return $this->xml->errors->error[$i];
			}
		}
		
		return false;
	}
	
}

