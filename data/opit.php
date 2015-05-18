<?php

//ќпыт

$opit = getExperience($us_data['level']);

$energy = 0;

for($i = 1; $i <= $us_data['level']; $i++) {
if($us_data['level'] == 1) {
$energy = 100;
} elseif($us_data['level'] == 2) {
$energy = 150;

}else {
$energy = $energy + 200;
}

}

/*

if($us_data['reyting'] >= ($opit)) {
$qwerty = $us_data['reyting'] - $opit;
$qq = mysql_query("UPDATE tb_users SET reyting = '$qwerty', level = level + '1' WHERE id = '$usid' AND username = '$login'");
}



$us_data11 = mysql_query("SELECT * FROM tb_users WHERE id = '$usid'");
$us_data1 = mysql_fetch_assoc($us_data11);
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
$qq = mysql_query("UPDATE tb_users SET reyting = '1' WHERE id = '$usid' AND username = '$login'");
		
}

if (isset($_POST['mess'])) {
unset ($_SESSION['msg']);
}
if(isset($_SESSION['msg'])) {
		?>

<div id="overlay" class="web_dialog_overlay"></div>


		<script type="text/javascript" src="../js/web_dialog.js"></script>
		<?php
		}*/
?>

