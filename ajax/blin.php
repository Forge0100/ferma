<?php
session_start();
error_reporting (1);
$login = $_SESSION['login'];
$usid = $_SESSION['id'];
header('Content-type: application/json');
Header("Content-Type: text/html;charset=UTF-8");
require($_SERVER['DOCUMENT_ROOT']."/data/conn_file.php");
require($_SERVER['DOCUMENT_ROOT']."/data/func.php");
if($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest' ) { exit();}


if (isset($_POST['text'])) {
if(!isset($_SESSION['id'])) {echo json_encode($result = array("typeu" => "error", "message" => "Сессия устарела! Обновите страницу!")); exit();}
$us_data = $db->getRow("SELECT * FROM tb_users WHERE id = ?i AND username = ?s", $usid, $login);

require($_SERVER['DOCUMENT_ROOT']."/data/opit.php");
$type = valideint($_POST['text']);
$mode = $_POST['mode'];

switch($type) {
case 1: $en = 135; break;
case 2: $en = 185; break;
case 3: $en = 320; break;

}

if($type == 1) { 
	//if(($us_data['energy'] + $en) <= $energy ) {
		if ($us_data['blin_myaso'] >= 1)
		{
			$en = ($mode == 'all') ? ($en * $us_data['blin_myaso']) : $en;
			
			$db->query("UPDATE tb_users SET energy = energy + ?i, blin_myaso = '0' WHERE id = ?i AND username = ?s", $en, $usid, $login);
			echo '<center><font color="green">Вы получили '.$en.' энергии!</font></center>';exit();
		}
		else echo '<center><font color="red">У вас нет пирогов!</font></center>';exit();
}
if($type == 2) {
	//if(($us_data['energy'] + $en) <= $energy ) {
		if ($us_data['blin_sir'] >= 1)
		{
			$en = ($mode == 'all') ? ($en * $us_data['blin_sir']) : $en;
			
			$db->query("UPDATE tb_users SET energy = energy + ?i, blin_sir = '0' WHERE id = ?i AND username = ?s", $en, $usid, $login);
			echo '<center><font color="green">Вы получили '.$en.' энергии!</font></center>';exit();
		}
		else echo '<center><font color="red">У вас нет пирогов!</font></center>';exit();
	//} else echo '<center><font color="red">Для вашего уровня уже достаточно энергии! </font></center>';exit();
}
if($type == 3) {
	//if(($us_data['energy'] + $en) <= $energy ) {
		if ($us_data['blin_smetana'] >= 1)
		{
			$en = ($mode == 'all') ? ($en * $us_data['blin_sir']) : $en;
			
			$db->query("UPDATE tb_users SET energy = energy + ?i, blin_smetana = '0' WHERE id = ?i AND username = ?s", $en, $usid, $login);
			echo '<center><font color="green">Вы получили '.$en.' энергии!</font></center>';exit();
			
		}
		else echo '<center><font color="red">У вас нет пирогов!</font></center>';exit();
	//} else echo '<center><font color="red">Для вашего уровня уже достаточно энергии!</font></center> ';exit();
}
}

?>