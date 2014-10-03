<?php

class Register{
	
	
	private static $instance;
	private $_data;

	private function __construct() {}

	public static function getInstance() {
		if(!self::$instance instanceof self){
			self::$instance = new Register();
		}

		return self::$instance;
	}

	public function __set($name, $value) {
		$this->_data[$name] = $value;
	}

	public function __get($name) {
		if(isset($this->_data[$name])) {
			return $this->_data[$name];
		}

		return false;
	}
}

?>
