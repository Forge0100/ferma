<?php
require_once('db.php');

$host 		= "localhost";
$user 		= "Johnmail";
$pass 		= "John31081986";
$db 		= "fermadruzya";
$charset 	= "utf8";

//  -- Artem --
//$conn = mysql_connect('localhost', 'Johnmail', 'John31081986') or die('Сервер перегружен, пожалуйста, зайдите позже.');
$conn = mysql_connect($host, $user, $pass) or die('Сервер перегружен, пожалуйста, зайдите позже.');
mysql_select_db($db, $conn) or die('Сервер перегружен, пожалуйста, зайдите позже.');
mysql_query("set names 'utf8'");
mysql_query ("set character_set_client='utf8'");
mysql_query ("set character_set_results='utf8'");
mysql_query ("set collation_connection='utf8_general_ci'");
unset($conn);

//  -- Artem --
$dbName = $db;
$db 	= new SafeMysql(array('user' => $user, 'pass' => $pass,'db' => $db, 'charset' => $charset));
//$db = array('user' => $user, 'pass' => $pass,'db' => $db, 'charset' => $charset);