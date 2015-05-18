<?php
	$SysValue['connect']['host'] 	= "localhost";
	$SysValue['connect']['user_db'] = "root";
	$SysValue['connect']['pass_db'] = "123qqq";
	$SysValue['connect']['dbase']   = "fermadruzya";
	$SysValue['base']['tb_users']	= "tb_users";
	$user_id 						= $_COOKIE['dle_user_id'];
	$amount 						= $_GET['m_amount'];
	$m_status						= $_GET['m_status'];
	echo '<pre>'.print_r($SysValue,true);
	echo $m_status.'<br>';
	echo $amount.'<br>';
	echo $user_id ;
	
	@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db']) or 
			@die("" . PHPSHOP_error(101, $SysValue['my']['error_tracer']) . "");
	mysql_select_db ($SysValue['connect']['dbase']) or 
			@die("" . PHPSHOP_error(102, $SysValue['my']['error_tracer']) . "");
	if($m_status == 'success'){
		echo "Вот так вот";
		$sql	= "UPDATE ".$SysValue['base']['tb_users']." SET money = money +  '$amount' WHERE id = '$user_id'"; 
		
		  mysql_query($sql);
		  	exit (header("Location: /"));
	}else{
		echo "Что-то пошло не так, не наши проблемы, сам виноват";
			exit (header("Location: /"));
	}