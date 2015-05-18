<?php
Header("Content-Type: text/html;charset=UTF-8");

require_once($_SERVER['DOCUMENT_ROOT']."/data/conn_file.php");
require_once($_SERVER['DOCUMENT_ROOT']."/data/func.php");

$p = print_r($_POST,true);
mysql_query("insert into `tb_test` (`t`) values ('$p')");

$secret = '5aRwFxnmOi07QFGQ8Upc5s/C'; 

$str=$_POST['notification_type'] . '&' .
        $_POST['operation_id'] . '&' .
        $_POST['amount'] . '&' .
        $_POST['currency'] . '&' .
        $_POST['datetime'] . '&' .
        $_POST['sender'] . '&' .
        $_POST['codepro'] ."&".$secret.'&' .
        $_POST['label'];
 
if(sha1($str)!=$_POST['sha1_hash'])
 {
    mysql_query("insert into `tb_test` (`t`) values ('false21')");
    exit('Верификация не пройдена. SHA1_HASH не совпадает.'); // останавливаем скрипт. у вас тут может быть свой код.
}
mysql_query("insert into `tb_test`  (`t`) values ('true13')");
$r['withdraw_amount'] = floatval($_POST['withdraw_amount']);
$r['label']           = intval($_POST['label']); 

mysql_query("insert into `tb_test` (`t`) values ('truesTTT2')");
$q = "UPDATE `tb_users` SET `money` = `money` + ".$r['withdraw_amount']." WHERE `id` = ".$r['label'];
$q = print_r($q, true);
mysql_query("insert into `tb_test` (`t`) values ('$q')");
mysql_query($q);
$q2 = "INSERT INTO tb_enter (user_id, login, summa, date, status) VALUES ('".$r['label']."', '777', '".$r['withdraw_amount']."', '".time()."', '2')";
mysql_query($q2);
$q2 = print_r($q2, true);
mysql_query("insert into `tb_test` (`t`) values ('$q2')");