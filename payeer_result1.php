<?php
Header("Content-Type: text/html;charset=UTF-8");

require_once($_SERVER['DOCUMENT_ROOT']."/data/conn_file.php");
require_once($_SERVER['DOCUMENT_ROOT']."/data/func.php");


if(isset($_POST["m_operation_id"]) && isset($_POST["m_sign"])) {
$m_key = 'HhbmkvQsMLvurQEX';
	$arHash = array($_POST['m_operation_id'],
			$_POST['m_operation_ps'],
			$_POST['m_operation_date'],
			$_POST['m_operation_pay_date'],
			$_POST['m_shop'],
			$_POST['m_orderid'],
			$_POST['m_amount'],
			$_POST['m_curr'],
			$_POST['m_desc'],
			$_POST['m_status'],
			$m_key);

	$sign_hash = strtoupper(hash('sha256', implode(":", $arHash)));

	if($_POST["m_sign"] == $sign_hash && $_POST['m_status'] == "success") {

			$row	= $db->getRow("SELECT * FROM tb_enter WHERE id = ?i AND status != 2 LIMIT 1", $_POST['m_orderid']);

			$date = date("d.m.Y");

			if($row['summa'] == $_POST['m_amount']) {
				$db->query("UPDATE tb_users SET money = money + ?i WHERE id = ?i LIMIT 1", $row['summa'], $row['user_id']);
				$db->query("UPDATE tb_enter SET status = 2, purse = 'PAYEER' WHERE id = ?i LIMIT 1", $_POST['m_orderid']);
			}

		echo $_POST['m_orderid']."|success";
		exit();

	} else {
		echo $_POST['m_orderid']."|error";
	}
}
?>