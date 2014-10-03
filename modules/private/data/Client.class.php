<?php

class Client {
	
	protected $id;
	public $p_name;
	public $p_address;
	
	public $tblName = "clients";
	
	public function __construct($name, $address) {
		
		$this->p_name = $name;
		$this->p_address = $address;
	}
	
	public function setName($name) {
		$this->p_name = $name;
	}
	
	public function setAddress($address) {
		$this->p_address = $address;
	}
	
	public function getName() {
		return $this->p_name;
	}
	
	public function getAddress() {
		return $this->p_address;
	}
	
}