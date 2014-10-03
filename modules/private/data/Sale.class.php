<?php
class Sale {
	
	private $id;
	
	private $p_total;
	private $p_user_id_rel;
	private $p_client_id_rel;
	private $p_created;

	public static $tblName = "sales";
	
	public function __construct($total=null, $user_id_rel=null, $client_id_rel=null, $created=null) {
		$this->p_total = $total;
		$this->p_user_id_rel = $user_id_rel;
		$this->p_client_id_rel = $client_id_rel;
		$this->p_created = $created;
	}
	
	public function getID() {
		return $this->id;
	}
	public function getTotal() {
		return $this->p_total;
	}
	public function getUser_id() {
		return $this->p_user_id_rel;
	}
	public function getClient_id() {
		return $this->p_client_id_rel;
	}
	public function getCreated() {
		return $this->p_created;
	}
	
	public function setID($id) {
		$this->id = $id;
	}
	public function setTotal($total) {
		$this->p_total = $total;
	}
	public function setUser_id($user_id) {
		$this->p_user_id_rel = $user_id;
	}
	public function setClient_id($client_id) {
		$this->p_client_id_rel = $client_id;
	}
	public function setCreated($created) {
		$this->p_created = $created;
	}
	
	
	
}