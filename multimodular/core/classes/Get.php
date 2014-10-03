<?php
class Get {
	
	protected static $json_file = "./json/model.json";
	
	public function __construct() {  }
	
	private static function ToArray($obj){
		$reaged = (array)$obj;
		foreach($reaged as $key => &$field){
			if(is_object($field))$field = self::ToArray($field);
		}
		return $reaged;
	}
	
	
	public static function getRules($table) {
		$joins = "";		
		
		echo $table;echo "<hr><pre>";
		$sections = array();
		
		$json = self::ToArray( json_decode( file_get_contents(self::$json_file) ) );
		
		//print_r($json);exit;
  		$sections = $json["sections"];
  		$relations = $json["relations"];

//    		print_r($relations);
//    		exit;
   		
  		//print_r($sections);exit;
		
		/*
		foreach ($sections as $section) {
			if(key_exists($section, $relations)) {
				echo "{$section} si existe";
				
			}
		}
		*/  		
		while(key_exists($table, $relations)) {
			
			$next_join = key($relations[$table]["with"]);
		//	$connect = value($relations[$table]["with"]);
			$joins .= "LEFT JOIN {$next_join} ON {$next_join}.{$sections[$next_join]["PK"]} = {$table}.{$sections[$table]["PK"]} ";
			
			$table = $next_join;
		}
		
		echo $joins;
		exit;
		return $joins;
	}
	
}