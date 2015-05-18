<?php
require_once($_SERVER['DOCUMENT_ROOT']."/data/conn_file.php");

	// Конфиг дб
	$SysValue['connect']['host'] 		= $host;
	$SysValue['connect']['user_db'] 	= $user;
	$SysValue['connect']['pass_db'] 	= $pass;
	$SysValue['connect']['dbase']   	= $dbName;


	$SysValue['base']['tb_users']		= "tb_users";
	$SysValue['base']['tb_pay_stats'] 	= "tb_pay_stats";

	// Подключение к БД
	@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db']) or 
		@die("" . PHPSHOP_error(101, $SysValue['my']['error_tracer']) . "");
	
	@mysql_select_db ($SysValue['connect']['dbase']) or 
		@die("" . PHPSHOP_error(102, $SysValue['my']['error_tracer']) . "");
		
	$strSQL 	= "SELECT * FROM tb_conf_site";
	$rs 		= mysql_query($strSQL);
	$row 		= mysql_fetch_array($rs);

	// Ид пользывателя
	$user_id 		= $_COOKIE['dle_user_id'];
	// $user_login;
	$date 			= date("Y-m-d H:i:s");
	
	// Принимаем значения 
	$signChech		= $_REQUEST['SIGN'];
	$amount 		= $_REQUEST['AMOUNT'];
	$order_id		= $_REQUEST['MERCHANT_ORDER_ID'];
	$merchant_id	= $row['id_freekassa'];
	$secret_word	= $row['key2_freekassa'];
	
	// Создем уникальный код для проверки 
	$sign = md5($merchant_id.':'.$amount.':'.$secret_word.':'.$order_id);

	// Сравнимаем сумы и записем в дб
	if($sign == $signChech){		
		$sql	= "UPDATE ".$SysValue['base']['tb_users']." SET money = money +  '$amount' WHERE id = '$user_id'"; 
		mysql_query($sql);
		
		$strSQL 	= "SELECT username FROM tb_users WHERE id ='$user_id'";
		$rs 		= mysql_query($strSQL);
		$row 		= mysql_fetch_array($rs);
		$user_login = $row['username'];
		
		$strSQL1 	= "INSERT INTO ".$SysValue['base']['tb_pay_stats']." (user,date,amount) VALUES ('$user_login', '$date', '$amount')";
		mysql_query($strSQL1);
		
		echo $user_login;
		echo '<pre>'.print_r($GLOBALS,true).'</pre>';
		// exit (header("Location: /success_query"));
	}else{
		echo "error";
		// echo '<pre>'.print_r($GLOBALS,true).'</pre>';
		// exit (header("Location: /fail_query"));
	}
?>