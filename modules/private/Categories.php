<?php

require_once("data/Category.class.php");
class Categories {
	
	private $Category;
	protected $core;
	
	public function __construct(Core $core) {
		$this->core = $core;
	}
	
	/**
	 * 
	 * @param string $name
	 */
	public function add($name) {
		$this->Category = new Category($name);
	
		$this->core->db->setVals($this->Category)->insert()->exec();
	}
	
	/**
	 * 
	 * @param array $conditions
	 */
	public function remove($conditions) {
	
		$this->core->db
		->delete("categories")
		->where($conditions)
		->exec();
	}
	public function edit() { }
	
}