<?php
session_start();
Header("Content-Type: text/html;charset=UTF-8");

require_once($_SERVER['DOCUMENT_ROOT']."/data/conn_file.php");
require_once($_SERVER['DOCUMENT_ROOT']."/data/func.php");
$ip = $_SERVER['REMOTE_ADDR'];
$login = $_SESSION['login'];
$date = time();
$page = 'Чат';
$uo_query = "select * from tb_chat order by date asc";
$uo_result = $db->query($uo_query);
if($db->numRows($uo_result) == 0) {
	$db->query("INSERT INTO tb_online (`ip`,`login`,`date`,`page`) VALUES (?s, ?s, ?s, ?s)", $ip, $login, $date, $page);
} 
$res=$db->query("SELECT DISTINCT ip, login, page FROM tb_online WHERE `page` = ?s", $page);
while($row=$db->fetch($res))
{
if($row['login'] != '') {
$d = $db->getRow("SELECT * FROM tb_users WHERE username = ?s", $row['login']);
if($d['chat_status'] == 1) { 
$adm = '<font color="red">'; $admm = '</font>';
} elseif($d['chat_status'] == 2) {
$adm = '<font color="green">'; $admm = '</font>';
} elseif($d['chat_status'] == 5) {
$adm = '<font color="blue">'; $admm = '</font>';
}else{
$adm = '<font color="black">'; $admm = '</font>';
}
}
echo <<<STILL
<img src="/chat/strel.png" style="vertical-align: middle;" border="0"><a class="onli" onclick="insert_text('','[b][i]{$row["login"]}:[/i][/b]')" >{$adm} {$row["login"]} {$admm}</a><br>
STILL;
}
?>



