<?php
require_once($_SERVER['DOCUMENT_ROOT']."/data/conn_file.php");

$SysValue['connect']['host'] 		= $host;
$SysValue['connect']['user_db'] 	= $user;
$SysValue['connect']['pass_db'] 	= $pass;
$SysValue['connect']['dbase']   	= $dbName;

@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db']) or 
	@die("" . PHPSHOP_error(101, $SysValue['my']['error_tracer']) . "");
	
@mysql_select_db ($SysValue['connect']['dbase']) or 
			@die("" . PHPSHOP_error(102, $SysValue['my']['error_tracer']) . "");
			
$strSQL 	= "SELECT id_freekassa , key_freekassa FROM tb_conf_site";

$rs 		= mysql_query($strSQL);
$row 		= mysql_fetch_array($rs);

$merchant_id 	= $row['id_freekassa'];
#$merchant_id 	= '10274';
$secret_word	= $row['key_freekassa'];
#$secret_word 	= 'Mashajohn31081986';
$order_id 		= time()+1;
$order_amount 	= number_format($_GET['amount'], 2, '.', '');
$singtest		= $merchant_id.':'.$order_amount.':'.$secret_word.':'.$order_id;
$sign = md5($merchant_id.':'.$order_amount.':'.$secret_word.':'.$order_id);
#echo '<pre>'.print_r($GLOBALS,true).'</pre>';
header("Location: http://www.free-kassa.ru/merchant/cash.php?m=".$merchant_id."&oa=".$order_amount."&o=".$order_id."&s=".$sign."&i=&lang=ru");
#http://www.free-kassa.ru/merchant/cash.php?m=10274&oa=0.1&o=111&s=e925f57712a8b6f3244cd96c42a2e079&i=&lang=ru
#http://www.free-kassa.ru/merchant/cash.php?m=10274&oa=0.1&o=111&s=ca1895ae17936a84b6735ec6563f5b3c&lang=ru&i=&em=

?>
