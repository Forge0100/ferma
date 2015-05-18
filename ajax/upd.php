<?php
session_start();
error_reporting (1);
$login = $_SESSION['login'];
$usid = $_SESSION['id'];
Header("Content-Type: text/html;charset=UTF-8");
require($_SERVER['DOCUMENT_ROOT']."/data/conn_file.php");
require($_SERVER['DOCUMENT_ROOT']."/data/func.php");
if($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest' ) { exit();}
$sql = $db->query("SELECT * FROM `tb_pole` WHERE `type` >= '1' AND `username` = ?s", $login);
if($db->numRows($sql) > 0) {
while($row = $db->fetch($sql)) {
if($row["udob"] == 1) {
$fin_time = time_type($row["type"]) * 0.5;
}else{
$fin_time = time_type($row["type"]);
}
if($row["time"] <= (time()-$fin_time)) {
$result[] = array($row["num"] => $row["type"]);
}
}
}
echo json_encode($result);
?>