<?php
Header("Content-Type: text/html;charset=UTF-8");

require_once($_SERVER['DOCUMENT_ROOT']."/data/conn_file.php");
require_once($_SERVER['DOCUMENT_ROOT']."/data/func.php");

$shop_id        = 4; //ID вашего магазина
$shop_key     = 'goldenfarmer'; //Секретный ключ вашего магазина
$pay_id          = (int)$_POST['VES_PAYID']; // ID платежа
$hash              = $_POST['VES_CHECKHASH']; // Полученный хеш
$amount         = number_format($_POST['VES_SUMMA'], 2, '.', '' );  //Сумма платежа
$anyname       = sf($_POST['id_plat']); //Пользовательские данные1


$gen_hash = strtoupper(md5(($shop_id.md5($shop_key).$amount.$pay_id)));; //Генерируем хеш

if($hash == $gen_hash){
	$query	= "SELECT * FROM tb_enter WHERE id = ".intval($anyname)." LIMIT 1";
	$result	= mysql_query($query);
	$row	= mysql_fetch_array($result);
	if($row['id'] && $row['status'] != 2) {

		if(sprintf("%01.2f", $amount) == $row['summa']){

			mysql_query('UPDATE tb_users SET money = money + '.$row['summa'].' WHERE id = "'.$row['user_id'].'" LIMIT 1');
			mysql_query("UPDATE tb_enter SET status = 2, purse = 'VilPay.com' WHERE id = ".intval($anyname)." LIMIT 1");

			

		} else {
			print "ERROR";
			mail($adminmail, "Status", "Не те данные");
		}

	} else {
		print "ERROR";
		mail($adminmail, "Status", "Нет записи в БД или повтор операции ".$_POST['VES_PAYID']);
	}
}else{
		print "ERROR";
	mail($adminmail, "Status", "Не прошёл хеш");
}
?>