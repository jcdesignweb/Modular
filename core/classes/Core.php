<?php
/**
 * @category Core class
 * @author Juan Andrés Carmena <juan14nob@gmail.com>
 * 
 */
class Core {
	
	public $core;	
	public $db;
	public function __construct() {
		
		require_once "core/Setup.php";
		require "Loader.php";
		
		try {
			Setup::Init();
			
			$Register = Register::getInstance();
		
			$Register->db = new Database();
			$Register->type = new Types();
			$Register->xml = new XmlParser();
			$Register->utils = new Utilities();
			
			$this->db = $Register->db;

			$this->core = $Register;
		
		}catch(Exception $e) {
			die("Exception ". $e->getMessage());
		}
	}
}
