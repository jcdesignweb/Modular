<?php
require_once("data/Sale_detail.class.php");

class Sales_details {
	private $Sale_detail;
	protected $core;

	public function __construct(Core $core) {
		$this->core = $core;
	}

	public function add($sale_id_rel, $product_id_rel, $product_cant) {
		$this->Sale_detail = new SaleDetail($sale_id_rel, $product_id_rel, $product_cant);
		$this->core->db->setVals($this->Sale_detail)->insert()->exec();
	}

	public function remove($conditions) {
		$this->core->db
		->delete("sales_details")
		->where($conditions)
		->exec();
	}
	
	public function edit() {}
	
	public function get($conditions, $fields="*", $table) {
		$SaleDetail = array();
		$Products = new Products($this->core);

		$fetch = $this
				->core
				->db
				->select($fields, "sales_details")
				->where($conditions)
				->exec()
				->fetch(); 
		
// 		print_r($fetch);exit;
		for($i=0; $i < count($fetch); $i++) {
			$SaleDetail[] = $Products->get(array("AND" => array("product_id" => $fetch[$i]["sale_detail_product_id_rel"])), "*","products"); 
		}
		
		return $SaleDetail;
	}
}

