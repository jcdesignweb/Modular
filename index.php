<?php

require_once "core/classes/Core.php";
$Core = new Core();



/*
$user = new Users($core);
$user->addUser("Ismael", "Carmena", "mail@gmail.com", date("Y-m-d H:i:s"));
//$user->removeUser(array("AND" => array("user_id" => 76)));

//print($user->User->getName());
//var_dump($core);
*/

/*
  Categoty
 
*/

// $category = new Categories($core);
// $category->add("autos");

/*
 Products
 */
// $product = new Products($Core);
 //$product->add("renault 18", 5000, date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), 5, 84);
 //print_r($product->get());

/*
 Clients
 */
// $client = new Clients($core);
// $client->add("Juan", "Pje Malaponte 5523");

/*
 Sales
*/


$Sales = new Sales($Core);

$Sale = $Sales->get(array("AND" => array("sale_total" => 500)), "*", Sale::$tblName);
die('aa');
print_r($Sale);

/*
 Sales Details
 */

// $Sales = new Sales_details($core);
// $Sale = $Sales->get();
// print_r($Sale);




