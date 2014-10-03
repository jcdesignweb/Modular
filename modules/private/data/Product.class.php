<?php
class Product {
	
	protected $id;
	
	public $p_name;
	public $p_price;
	public $p_updated;
	public $p_created;
	public $p_category_rel;
	public $p_user_id_rel;
	
	public $tblName = "products";

	public function __construct($name, $price, $updated, $created, $category_rel, $user_id_rel) {
		$this->p_name = $name;
		$this->p_price = $price;
		$this->p_updated = $updated;
		$this->p_created = $created;
		$this->p_category_rel = $category_rel;
		$this->p_user_id_rel = $user_id_rel;
	}
	
	public function setID($id) {
		$this->id = $id;
	}
	
	public function setPrice($price) {
		$this->p_price = $price;
	}
	
	public function setUpdated($updated) {
		$this->p_updated = $updated;
	}
	
	public function setCreated($created) {
		$this->p_created = $created;
	}
	
	public function setCategory($category_rel) {
		$this->p_category_rel = $category_rel;
	}
	
	public function setUser($user_id) {
		$this->p_user_id_rel = $user_id;
	}
	
	public function getID() {
		return $this->id;
	}
	
	public function getPrice() {
		return $this->p_price;
	}
	
	public function getUpdated() {
		return $this->p_updated;
	}
	
	public function getCreated() {
		return $this->p_created;
	}
	
	public function getCategory() {
		return $this->p_category_rel;
	}
	
	public function getUser() {
		return $this->p_user_id_rel;
	}
}