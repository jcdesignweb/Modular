<?php
interface iDB {
	
	public function delete($table);
	public function update();
	public function select($fields, $table);
	public function insert();
	
	public function exec();
}