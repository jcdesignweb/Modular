<?php

require_once("data/User.class.php");

class Users {
	public $User;
	protected $core;
	
	public function __construct(Core $core) {
		$this->core = $core;
	}
	
	public function addUser($name, $subname, $email, $created) {
		$this->User = new User($name, $subname, $email, $created);
		
		$this->core->db->setVals($this->User);
		
	}

	public function removeUser() {
		
	}
	public function editUser() {}
}
