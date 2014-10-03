<?php
require_once("data/Product.class.php");

require_once("./core/classes/Crud.php");
class Products extends Crud {
	private $Product;
	protected $core;
	public function __construct(Core $core) {
		$this->core = $core;
	}
	/**
	 * @param string $name
	 * @param integer $price
	 * @param datetime $updated
	 * @param datetime $created
	 * @param integer $category_rel
	 * @param integer $user_id_rel
	 */
	public function add($name, $price, $updated, $created, $category_rel, $user_id_rel) {
		$this->Product = new Product($name, $price, $updated, $created, $category_rel, $user_id_rel);
		$this->core->db->setVals($this->Product)->insert()->exec();
	}
	/**
	 * 
	 * @param array $conditions
	 */
	public function remove($conditions) {
		$this->core->db
		->delete("products")
		->where($conditions)
		->exec();
	}
	public function edit() { }
	public function get($conditions, $fields="*", $table) {
		$fetch = $this
		->core
		->db
		->select($fields, $table)
		->where($conditions)
		->exec()
		->fetch();
	
		return $fetch;
	}
}