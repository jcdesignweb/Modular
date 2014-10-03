<?php

abstract class Crud {
	
	private $fields;
	private $fetch;
	
	public function get($conditions, $fields="*", $table) {
		
		$this->core->db->setExternals($this->core);
		$this->fetch = $this
		->core
		->db
		->select($fields, $table)
		->where($conditions)
		->exec()
		->fetch();
		
		return $this->fetch;
	}
	
	final public function getFetch() {
		return $this->fetch;
	}
} 