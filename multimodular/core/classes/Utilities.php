<?php
/**
 * 
 * Esta clase contiene métodos los cuales voy a utilizar en toda la app. 
 * 
 * @author Juan Andrés Carmena <juan14nob@gmail.com>
 * @since 03/09/2014
 */
class Utilities {

	
	/**
	 * Este metodo verifica si un array es o no asociativo
	 * 
	 * @example
	 * Exampĺe1 : var_dump(isAssoc(array('a', 'b', 'c'))); // false
	 * Example2 : var_dump(isAssoc(array("0" => 'a', "1" => 'b', "2" => 'c'))); // false
	 * Example3 : var_dump(isAssoc(array("1" => 'a', "0" => 'b', "2" => 'c'))); // true
	 * Example4 : var_dump(isAssoc(array("a" => 'a', "b" => 'b', "c" => 'c'))); // true 
	 * 
	 * @param unknown_type $arr
	 * @return boolean
	 */
	public function isAssoc($arr) {
		return array_keys($arr) !== range(0, count($arr) - 1);
	}
	
	
}