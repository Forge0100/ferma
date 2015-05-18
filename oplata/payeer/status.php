<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/data/conn_file.php");

	$SysValue['connect']['host'] 		= $host;
	$SysValue['connect']['user_db'] 	= $user;
	$SysValue['connect']['pass_db'] 	= $pass;
	$SysValue['connect']['dbase']   	= $dbName;
	$SysValue['base']['tb_users']		= "tb_users";
	$SysValue['base']['tb_pay_stats'] 	= "tb_pay_stats";
	
	//$user_id_session =  $_SESSION['id'];
	$user_id 	= $_COOKIE['dle_user_id'];
	$amount 	= $_GET['m_amount'];
	$m_status	= $_GET['m_status'];
	$date 		= date("Y-m-d H:i:s");
	$purse		= "Payeer";

	echo '<pre>'.print_r($SysValue,true);
	echo $m_status.'<br>';
	echo $amount.'<br>';
	echo $user_id."session".$user_id_session;
	
	@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db']) or 
			@die("" . PHPSHOP_error(101, $SysValue['my']['error_tracer']) . "");
	mysql_select_db ($SysValue['connect']['dbase']) or 
			@die("" . PHPSHOP_error(102, $SysValue['my']['error_tracer']) . "");
	if($m_status == 'success'){
		echo "Вот так вот";
		
		$sql	= "UPDATE ".$SysValue['base']['tb_users']." SET money = money +  '$amount' WHERE id = '$user_id'"; 
		mysql_query($sql);
		  
		$strSQL 	= "SELECT username FROM tb_users WHERE id ='$user_id'";
		$rs 		= mysql_query($strSQL);
		$row 		= mysql_fetch_array($rs);
		$user_login = $row['username'];
		
		$strSQL1 	= "INSERT INTO ".$SysValue['base']['tb_pay_stats']." (user_id,user,date,purse,amount) VALUES ('$user_id','$user_login','$date','$purse','$amount')";
		mysql_query($strSQL1);
		
		echo $user_login;
		// echo '<pre>'.print_r($GLOBALS, true).'</pre>';
		exit (header("Location: /success_query"));

	}else{
		#echo "Что-то пошло не так, не наши проблемы, сам виноват";
		exit (header("Location: /fail_query"));
	}