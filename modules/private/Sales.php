<?php

require_once("data/Sale.class.php");
require_once("Sales_details.php");

require_once("./core/classes/Crud.php");

class Sales extends Crud{

	private $Sale;
	protected $core;
	

	public function __construct(Core $core) {
		//print_r($core);exit;
		$this->core = $core;
	}

	public function add($total, $user_id_rel, $client_id_rel, $created, $sales) {
		$this->Sale = new Sale($total, $user_id_rel, $client_id_rel, $created);

		$this->core->db->setVals($this->Sale)->insert()->exec();
		$this->Sale->setID($this->core->db->getLastId());
		
		foreach ($sales as $produc_id => $product_cant) {
			$this->core->db->setVals(
				new SaleDetail(
					$this->Sale->getID(),				
					$produc_id, 
					$product_cant
				)
			)
			->insert()
			->exec();
		}
	}

	public function remove($conditions) {

		$this->core->db
		->delete("sales")
		->where($conditions)
		->exec();
		
	}
	public function edit() { }
	
	public function get($conditions, $fields="*", $table) {
		parent::get($conditions, $fields, $table);
		
		$sales_detail = new Sales_details($this->core);
		
		
		
		$sales = $this->getFetch();
		
				
		print_r($sales);exit;
		
		return $sales;
		
	}
	
	/*
	public function get($conditions, $fields="*") {
	
		return $Sale;
	}
	*/
	
	
}

