<?php
class Types {

	const TYPE_ARRAY = "array";
	const TYPE_BOOLEAN = "boolean";
	const TYPE_FLOAT = "float";
	const TYPE_INTEGER = "integer";
	const TYPE_STRING = "string";
	const TYPE_NULL = "NULL";
	
	public function setType($type) {
		
		$t = explode("(", $type);
		
		if($t[0] == "datetime") return self::TYPE_STRING;
		
		return $this->verifyType($t[0]);
	}
	
	public function getType($p) {
		return $this->verifyType($p);
	}
	
	private function verifyType($p) {
		
		if (is_array($p)) return self::TYPE_ARRAY;
		if (is_bool($p)) return self::TYPE_BOOLEAN;
		if (is_float($p)) return self::TYPE_FLOAT;
		if (is_int($p)) return self::TYPE_INTEGER;
		if (is_null($p)) return self::TYPE_NULL;
		if (is_numeric($p)) return "numeric";
		if (is_object($p)) return "object";
		if (is_resource($p)) return "resource";
		if (is_string($p)) return self::TYPE_STRING;
		
		return "unknown type";
	}
	
}


