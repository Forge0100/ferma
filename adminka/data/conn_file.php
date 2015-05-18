<?php
$conn = mysql_connect('localhost', 'sosedi', 'sosedi') or die('Сервер перегружен, пожалуйста, зайдите позже.');
mysql_select_db('sosedi', $conn) or die('Сервер перегружен, пожалуйста, зайдите позже.');
mysql_query("set names 'utf8'");
mysql_query ("set character_set_client='utf8'");
mysql_query ("set character_set_results='utf8'");
mysql_query ("set collation_connection='utf8_general_ci'"); 
unset($conn);
?>