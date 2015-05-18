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
mysql_select_db ($SysValue['connect']['dbase']) or 
		@die("" . PHPSHOP_error(102, $SysValue['my']['error_tracer']) . "");

$strSQL 	= "SELECT id_ooopay FROM tb_conf_site";

$rs 		= mysql_query($strSQL);
$row 		= mysql_fetch_array($rs);

// Ид пользывателя
$user_id 		= $_COOKIE['dle_user_id'];
$user_login;
$date 			= date("Y-m-d H:i:s");

// Принимаем значения 
$signChech			= $_REQUEST['sign'];
$amount 			= $_REQUEST['amount'];
$order_id			= $_REQUEST['order_id'];
$from 				= $_REQUEST['from'];
$to 				= $_REQUEST['to'];
$merchant_id		= $row['id_ooopay'];
$secret_word		= $row['key_ooopay'];
$merchant_account 	= 'WM473651053';

// Создем уникальный код для проверки 
$sign = md5($merchant_id.$order_id.$amount.$from.$to.$secret_word);

echo $_POST['sign'];

echo '<pre>'.print_r($GLOBALS, true).'</pre>';

if ($sign != $_POST['sign'])
    die('incorrect sign'); //Подписи не сошлись

if ($merchant_id != $_POST['m'])
    die('incorrect merchant id'); //Неверный id продавца

if ($merchant_account != $_POST['to'])
    die('incorrect merchant account'); //Неверный аккаунт продавца

// Помещаем данные для передачи на сервер в массив
$data = array(
    'm' => $merchant_id,
    'id' => $_POST['payment_id'],
    'direction' => 2,
    'action' => 'p_status',
    'sign' => $sign
);

// Запись переменной с ответом от сервера
$res = check_payment($data);

// Проверки
if ($res->error == 1)
    die('check payment failed'); //Проблема при получении деталей платежа

if ($res->answer['amount'] != $_POST['amount'])
    die('diff amount'); //Суммы не сошлись

if ($res->answer['status'] != 'COMPLETED')
    die("order not completed"); //Заказ еще завершен

// Сравнимаем сумы и записем в дб
if($sign == $signChech){		
	$sql	= "UPDATE ".$SysValue['base']['tb_users']." SET money = money +  '$amount' WHERE id = '$user_id'"; 
	mysql_query($sql);
	
	$strSQL 	= "SELECT username FROM tb_users WHERE id ='$user_id'";
	$rs 		= mysql_query($strSQL);
	$row 		= mysql_fetch_array($rs);
	$user_login = $row['username'];
	
	$strSQL1 	= "INSERT INTO ".$SysValue['base']['tb_pay_stats']." VALUES ('$user_login', '$date', '$amount')";
	mysql_query($strSQL1);
	
	echo $user_login;
	echo '<pre>'.print_r($GLOBALS,true).'</pre>';
	// exit (header("Location: /"));
}else{
	echo "Ошибка оплаты";
	echo '<pre>'.print_r($GLOBALS,true).'</pre>';
	// exit (header("Location: /"));
}

function check_payment($arr) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.ooopay.org/cashin_v1.php');
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($arr));
    $result = curl_exec($ch);
    curl_close($ch);

    $res = simplexml_load_string($result);

    return $res;
}
?>
