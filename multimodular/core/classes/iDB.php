<?php
/**
 * CRUD methods
 * 
 * @author Juan Andrés Carmena <juan14nob@gmail.com>
 *
 */
interface iDB {
	
	public function connection();
	public function disconnection();
	
	public function debug();
	
	/**
	 * Delete 
	 * @param string $table
	 */
	public function delete($table);
	
	/**
	 * Update
	 */
	public function update();
	
	/**
	 * Select 
	 * @param array $fields
	 * @param string $table
	 */
	public function select($fields, $table);
	
	/**
	 * Insert
	 */
	public function insert();
	
	public function exec();
}