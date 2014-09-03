<?php
require_once "core/classes/Core.php";
$core = new Core();



$user = new Users($core);
$user->addUser("Ismael", "Carmena", "mail@gmail.com", date("Y-m-d H:i:s"));

print($user->User->getName());
//var_dump($core);
