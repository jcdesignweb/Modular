<?php
class SaleDetail {
	
	protected $id;
	
	private $p_sale_id_rel;
	private $p_product_id_rel;
	private $p_product_cant;

	public $tblName = "sales_details";
	
	public function __construct($sale_id_rel, $product_id_rel, $product_cant) {
		$this->p_sale_id_rel = $sale_id_rel;
		$this->p_product_id_rel = $product_id_rel;
		$this->p_product_cant = $product_cant;
	}
	
	public function getID() {
		return $this->id;
	}
	public function getSaleID() {
		return $this->p_sale_id_rel;
	}
	public function getProductID() {
		return $this->p_product_id_rel;
	}
	public function getProduct_cant() {
		return $this->p_product_cant;
	}
	
	public function setID($id) {
		$this->id = $id;
	}
	public function setSaleID($sale_id_rel) {
		$this->p_sale_id_rel = $sale_id_rel;
	}
	public function setProductID($product_id) {
		$this->p_product_id_rel = $product_id;
	}
	public function setProduct_cant($cant) {
		$this->p_product_cant = $cant;
	}
}