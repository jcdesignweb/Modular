<?php
require_once("data/Client.class.php");
class Clients {

	
	private $Client;
	protected $core;

	public function __construct(Core $core) {
		$this->core = $core;
	}

	/**
	 * 
	 * @param string $name
	 * @param string $address
	 */
	public function add($name, $address) {
		$this->Client = new Client($name, $address);

		$this->core->db->setVals($this->Client)->insert()->exec();
	}

	/**
	 * 
	 * @param array $conditions
	 */
	public function remove($conditions) {

		$this->core->db
		->delete("clients")
		->where($conditions)
		->exec();
	}
	public function edit() {
	}

}