<?php
class Category {
	
	protected $id;
	public $p_name;
	
	public $tblName = "categories";
	
	public function __construct($name) {
		$this->p_name = $name;
	}
	
	public function getName(){
		return $this->p_name;
	}
	public function setName($id) {
		$this->p_name = $id;
	}
	
	public function getID(){
		return $this->id;
	}
	public function setID($id) {
		$this->id = $id;
	}
	
	
	
}