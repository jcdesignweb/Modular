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
	
	public static function run(Register $Register) {
		
		$Register->db->setExternals($Register);

		/**
		 * 
		 * @var example array to make an insert or update
		 * ELEMENT = table_field 
		 */
		$user = array( 
			"user_name" => "Juannnnnnnnnnnnnn lasssst33", 
			"user_subname" => "Carmena",
			"user_email" => "juan14nob@gmail.com",
			"user_created" => date("Y-m-d H:i:s")
		);
		
		/*
		$Register->db
			->setVals($user, "users")
			->insert()
			->exec();
		*/
		
		/*
		$conditions = array( "AND" => array("user_id" => 28) );
		$Register->db
			->setVals($user, "users")
			->update()
			->where($conditions)
			->exec();
		
		*/
		
		/*
		
		$conditions = array( "AND" => array("user_id" => 30) );
		
		$Register->db
		->delete("users")
		->where($conditions)
		->exec();
		*/

		/*
		$conditions = array( "AND" => array("user_id" => 30) );
		$sel = $Register->db
		->select(array("user_name","user_id"),"users")
		//->where($conditions)
		->exec();
		
		print_r($sel->fetch());
		
		*/

	}
}
