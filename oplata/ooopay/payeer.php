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
			
$strSQL 	= "SELECT id_ooopay , key_ooopay FROM tb_conf_site";

$rs 	= mysql_query($strSQL);
$row 	= mysql_fetch_array($rs);

$merchant_id 	= $row['id_ooopay'];		// ид магазина
$secret_word	= $row['key_ooopay']; 		// секретный ключ
$order_id 		= time()+1; 				// номер заказа 
$description	= "Ферма Друзья";			// описание
$currency		= "RUR";					// валюта
$order_amount 	= number_format($_GET['amount'], 2, '.', '');
$sign 			= md5($merchant_id.$order_id.$order_amount.$description.$secret_word);

// header("Location: https://www.ooopay.org/cashin_v1.php?m=".$merchant_id."actiont=get_service_ids"."&sign=".$sign);

// header("Location: https://www.ooopay.org/page/payment/?m=".$merchant_id."&amount=".$order_amount."&order_id=".$order_id."&sign=".$sign."&currency=".$currency);

// echo '<pre>'.print_r($GLOBALS,true).'</pre>';
?>
<html>
	<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js'></script>
	<center>
		<form method="POST" action="https://www.ooopay.org/page/payment/" name='pay_form' id='pay_form'>
			<input type="hidden" name="m" value="<?=$merchant_id ; ?>">
			<input type="hidden" name="order_id" value="<?=$order_id; ?>">
			<input type="hidden" name="amount" value="<?=$order_amount; ?>">
			<input type="hidden" name="description" value="<?=$description; ?>">
			<input type="hidden" name="sign" value="<?=$sign; ?>">
			<input type="hidden" name="currency" value="<?=$currency; ?>">
			<input type="hidden" id="pay_form">
		</form>
		Перенаправление...
	</center>
	<script>$('#pay_form').submit();</script>
</html>