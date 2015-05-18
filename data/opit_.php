<?php

//ќпыт
function getExperience($level) {
if ($level <= 0) return 0;
if ($level === 1||$level === 2) return 10;
if ($level > 2&&$level < 6) return 50 + getExperience($level - 1);
if ($level <= 10) return 100 + getExperience($level - 1);
$diff = 10 * (10+$level - $level%10);
return $diff+getExperience($level - 1);
}

$opit = getExperience($us_data['level']);


$energy = 0;

for($i = 1; $i <= $us_data['level']; $i++) {
if($us_data['level'] == 1) {
$energy = 100;
} elseif($us_data['level'] == 2) {
$energy = 150;

}else {
$energy = $energy + 500;
}

}



if($us_data['reyting'] >= ($opit)) {
$qwerty = $us_data['reyting'] - $opit;
$qq = $db->query("UPDATE tb_users SET reyting = ?i, level = level + '1' WHERE id = ?i AND username = ?s", $qwerty, $usid, $login);
}



$us_data1 = $db->getRow("SELECT * FROM tb_users WHERE id = ?i", $usid);
//ќпыт

$opit1 = getExperience($us_data1['level']);

$energy1 = 0;

for($i = 1; $i <= $us_data1['level']; $i++) {
if($us_data1['level'] == 1) {
$energy1 = 100;
} elseif($us_data1['level'] == 2) {
$energy1 = 150;

}else {
$energy1 = $energy1 + 200;
}

}




//////////////////////Уведомление о получени нового уровня!
if($us_data1['reyting'] == 0 and $us_data1['level'] > 1) {
$msg = 1;
$_SESSION['msg'] = $msg;
$qq = $db->query("UPDATE tb_users SET reyting = '1' WHERE id = ?i AND username = ?s", $usid, $login);
		
}

if (isset($_POST['mess'])) {
unset ($_SESSION['msg']);
}
if(isset($_SESSION['msg'])) {
		?>

<div id="overlay" class="web_dialog_overlay"></div>


		<script type="text/javascript" src="../js/web_dialog.js"></script>
		<?php
		}
?>

