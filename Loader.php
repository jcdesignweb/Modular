<?php
/**
 * @todo Make Autoload
 * @author Juan Andrés Carmena <juan14nob@gmail.com>
 *
 */
function autoloadCore($class) {
	if(file_exists(Setup::$MODULAR_PATH . ucfirst(strtolower($class)) . '.php')) {
		include_once Setup::$MODULAR_PATH . ucfirst(strtolower($class)) . '.php';
	}
}

function autoloadClass($class) {
	if(file_exists(Setup::$MODULAR_PATH . strtolower($class) . '.class.php')) {
	//	die(Setup::$MODULAR_PATH . ucfirst(strtolower($class)) . '.class.php');
		include_once Setup::$MODULAR_PATH . strtolower($class) . '.class.php';
	}
}

function autoloadData($class) {
	if(file_exists(Setup::$MODULAR_DATA . ucfirst(strtolower($class)) . '.php')) {
		//	die(Setup::$MODULAR_DATA . ucfirst(strtolower($class)) . '.php');
		include_once Setup::$MODULAR_DATA . ucfirst(strtolower($class)) . '.php';
	}
}

spl_autoload_register("autoloadCore");
spl_autoload_register("autoloadClass");
spl_autoload_register("autoloadData");