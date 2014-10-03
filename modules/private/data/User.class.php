<?php
class User {
	
	protected $id;
	public $p_name = "";
	public $p_subname = "";
	public $p_email = "";
	public $p_created = "";
	
	public $tblName = "users";
	
	public function __construct($name, $subname, $email, $created) {
		$this->p_name = $name;
		$this->p_subname = $subname;
		$this->p_email = $email;
		$this->p_created = $created;
		
		return $this;
	}
	
	public function getName() {
		return $this->p_name;	
	}
	
	public function getSubname() {
		return $this->p_subname;
	}
	
	public function getEmail() {
		return $this->p_email;
	}
	
	public function getCreated() {
		return $this->p_created;
	}
}