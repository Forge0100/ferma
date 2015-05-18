<?php
if(isset($_GET['act'])) {
ob_start();
session_start();
Header("Content-Type: text/html;charset=UTF-8");

require_once($_SERVER['DOCUMENT_ROOT']."/data/conn_file.php");
require_once($_SERVER['DOCUMENT_ROOT']."/data/func.php");
$code = sf($_GET['act']);

$q = $db->query("SELECT * FROM tb_users WHERE code_mail = ?s", $code);
if($db->numRows($q) == 1) {

mysql_query("UPDATE tb_users SET mail_act = 1 WHERE code_mail = ?s", $code);
Header("Location: /");
}

}else{
Header("Location: /");

}

?>