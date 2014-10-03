<?php 


/**
 * this class has logic of work.
 *
 * @author Juan Andrés Carmena <juan14nob@gmail.com>
 * @since 02/09/2014
 *
 */
require_once 'iDB.php';
require_once 'Get.php';

class Database implements iDB {
	
	/**
	 * CS "Connection String"
	 * @var PDO
	 */
	protected $db;
	
	/**
	 * This is an string that set the current query
	 * @var string
	 */
	protected $sql = ""; 
	
	protected static $table;
	
	/**
	 * Is an array that set current table description 
	 * @var array() 
	 */
	private $table_desc;

	
	/**
	 * Set primary key from table
	 */
	private $primary;
	
	private $conditions = "";
	
	/**
	 * PDO Statement 
	 */
	private $stmt;
	
	protected static $externs;
	
	/**
	 * save if i am making and insert,delete,edit or getting, whatever is "action delimeter"
	 * @var string
	 * @see $ACTION_ADD,
	 * 		$ACTION_DEL,
	 * 		$ACTION_EDT
	 * 		$ACTION4_GET
	 */
	
	private $action;
	
	private $objKeys;
	private $objValues;
	private $objTypes;
	
	private static $ACTION_ADD = "add";
	private static $ACTION_DEL = "del";
	private static $ACTION_EDT = "edit";
	private static $ACTION_GET = "get";
	
	private static $xml_mysqlconnection = "mysql-connect"; 
	
	protected static $dbuser = "root";
	protected static $dbpsw = "r00t";
	protected static $dbname = "modular";
	protected static $hostname = "localhost";
	
	public function __construct() {
		
		if($this->connection()) {
			$this->db = $this->connection(); 
		}else{
			die($xml->getMessage(self::$xml_mysqlconnection));
		}
	}
	public function __destruct() {
		$this->disconnection();
	}
	
	public function setExternals($registry) {
		//print_r($registry);exit;
		self::$externs = $registry;
	}
	
	/**
	 * @todo set table and values to make an insert or upgrades
	 * @param Array $object_vals - this is the parameters values to insert or update
	 * @return Database object
	 */
	public function setVals($object_vals) {
		
		$new = array();
		$K = strtolower(get_class($object_vals)) . "_";
		
		$search  = array('p_');
		$replace = array($K);
		
		foreach(get_object_vars($object_vals) as $k => $v) {
			if(substr($k, 0, 2) === $search[0]) {
		
				$new[str_replace($search, $replace, $k)] = $v;
			}
		}
		
		if(!array_key_exists("tblName", $object_vals)) {
			die("Falta setear la tabla");
		}
		
		self::$table = $object_vals->tblName;
		$this->getTableFields();
		$this->prepareArguments($new);	

		return $this;
	}
	
	/**
	 * set Connection with MySQL db , initialize PDO
	 */
	public function connection() {
		$server = 'mysql:host='. self::$hostname .';dbname='. self::$dbname;
		
		return new PDO(
			$server,
			self::$dbuser,
			self::$dbpsw
		);
	}
	
	/**
	 * Close Database Connection
	 * 
	 * (non-PHPdoc)
	 * @see iDB::disconnection()
	 * @access public
	 * 
	 */
	public function disconnection() {
		$this->db = null;
	}
	
	/**
	 * @return integer 
	 * 
	 */
	public function getLastId() {
		return $this->stmt->lastInsertId();
	}
	
	/**
	 * @param Array $where
	 * @return Database $this
	 */
	public function where($where=null) {
		if(is_array($where)) {
			$i=0;
			if(key_exists("AND", $where)) {
				$and = $where["AND"];
				$totAnd = count($and)-1;
	
				if(count($and)>0) {
					$this->conditions .= " WHERE ";
					foreach ($and as $w_key => $w_val) {
						
						$this->conditions .= $w_key . " = :" . $w_key;
						
						$this->objKeys[] = $w_key;
						$this->objValues[] = $w_val;
						
						if(is_int($w_val) || is_integer($w_val)) {
							$this->objTypes[] = PDO::PARAM_INT;
						}else if(is_string($w_val)) {
							$this->objTypes[] = PDO::PARAM_STR;
						}
						
						if($i < $totAnd) $this->conditions .= " AND "; 
										
						$i++;
					}
				}
				
			}else { die("Verificar conditions"); }
			
		}
		
		return $this;
	}
	
	
	public function ijoin($table, $field, $fieldjoin) {
		$this->sql .= "INNER JOIN $table ON $table . $field = ". self::$table .".$fieldjoin";
		die($this->sql);
	}
	
	
	
	/**
	 * @see set "table_desc" and "primary" properties. 
	 * @param string $table
	 * 
	 */
	private function getTableFields() {
		$this->table_desc = $this->query("DESCRIBE ".self::$table);
		$this->primary = $this->query("SHOW KEYS FROM ".self::$table." WHERE Key_name = 'PRIMARY'");
	}
	
	/**
	 * before insert is responsible to verify if the type parameters are correct 
	 * @return boolean
	 */
	final private function verifyParamsFields() {
		//print_r($this->table_desc);exit;
		//print_r($this->objKeys);exit;
		if(count($this->table_desc) - 1  !== count($this->objKeys) ) return false;
		for($i = 0; $i < count($this->table_desc)-1; $i++) {
			
			if($this->table_desc[$i]["Field"] == $this->objKeys[$i]) {
				if($this->table_desc[$i]["Key"] != "PRI") {
					if($this->type->setType($this->table_desc[$i]["Type"]) !== $this->type->getType( $this->objValues[$i] ) ) return false;
				}
			}
		}
		return true;
	}
	
	final private function setobjKeys($keys) {
		$this->objKeys = $keys;
	}
	
	private function setobjValues($vals) {
		
		
		$this->objValues = $vals;
		
		for($i=0; $i<count($vals); $i++) {
			if(is_int($vals[$i]) || is_integer($vals[$i])) {
				$this->objTypes[] = PDO::PARAM_INT;
			}else if(is_string($vals[$i])) {
				$this->objTypes[] = PDO::PARAM_STR;
			}
		}
	}
	
	/**[]
	 * 
	 */
	private function prepareArguments($object_vals) {
		$this->setobjKeys(array_keys($object_vals));
		$this->setobjValues(array_values($object_vals));
	}
	
	private function reset() {
		$this->objKeys = array();
		$this->objValues = array();
		$this->objTypes = array();
			
		$this->conditions = "";
		$this->sql = "";
	}
	
	public function test($object) { 
		
	}
	
	/**
	 * (non-PHPdoc)
	 * @see iDB::select()
	 * @param string|array $fields
	 * @param string $table
	 * @return Database $this
	 */
	public function select($fields, $table) {
		self::$table = $table;
		$this->action = self::$ACTION_GET;
		
		$this->sql .= "SELECT ";
		
		if(is_array($fields)) {
			
			if(count($fields) > 1) {
				//print_r(self::$externs);exit;
				if(!self::$externs->core->utils->isAssoc($fields)) {
					$this->sql .= implode($fields, ",");				
				}else{ 
					die("No debe ser un array asociativo");
				}
			}else{
				$this->sql .= $fields[0];
			}
			
		}else{
			$this->sql .= $fields;
		}
		
		$this->sql .= " FROM {$table} ";
		
		
		$this->sql .= Get::getRules($table);
		
		return $this;
	}
	
	public function update() {
		$this->action = self::$ACTION_EDT;
		
		$this->sql .= "UPDATE ". self::$table. " SET ";
		for($i = 0; $i < count($this->objKeys); $i++) {
			
			$this->sql .= $this->objKeys[$i]. " = :".$this->objKeys[$i];

			if($i != count($this->objKeys)-1) {
				$this->sql .= ",";
			}
		}
			
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see iDB::delete()
	 * 
	 */
	public function delete($table) {
		self::$table = $table;
		$this->action = self::$ACTION_DEL;
		$this->sql = "DELETE FROM {$table}";
		
		return $this;
	}
	
	public function insert() {
		$this->action = self::$ACTION_ADD;
		
		if($this->verifyParamsFields()) {
			
			$this->sql = "INSERT INTO ".self::$table. "(". implode($this->objKeys, ','). ")VALUES(:". implode($this->objKeys, ', :') .")";
			
		} else {
			die(self::$externs->xml->getMessage("insert-params"));
		}
		
		return $this;
	}
	
	public function exec() {
		
		try{
			
			if(!empty($this->conditions) AND $this->action != self::$ACTION_ADD) $this->sql .= $this->conditions;
			$this->stmt = $this->db->prepare($this->sql);
				
			if(count($this->objValues)>0) {
				for($i=0; $i<count($this->objValues); $i++) {
					$this->stmt->bindValue(":".$this->objKeys[$i], $this->objValues[$i], $this->objTypes[$i]);
				}
			}
			
			if($this->stmt->execute()) {
				$this->reset();	
			}
			
			if($this->stmt->errorInfo()[0] != 00000) {
				print_r($this->stmt->errorInfo());
			}
			
			$this->debug();
			
			return $this;
				
		}catch(PDOException $e) {
			
			echo "Hubo un error <br /> <br /> ";
			$this->stmt->debugDumpParams();
			echo $this->stmt->queryString;
			
			throw new Exception("Code: ". $e->getCode() . " Message: ". $e->getMessage());
			
			die("Code: ". $e->getCode() . " Message: ". $e->getMessage());
		}
	}
	
	public function fetch() {
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	protected function query($sql) {
		$this->stmt = $this->db->prepare($sql);
		$this->stmt->execute();
		return $this;
	}
	
	public function debug() {
		//$this->stmt->debugDumpParams();
		echo $this->stmt->queryString;
	}
	
	protected function deleteAll($table) {}
}
