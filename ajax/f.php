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

//echo json_encode($result = array("typeu" => "success", "message" => "test first"));exit();
if($_POST['func'] == 'success') {
$islvlup = 'bad';
if(!isset($_SESSION['id'])) {echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "Сессия устарела! Обновите страницу!")); exit();}
$pole = valideint($_POST["pole"]);
$semena = valideint($_POST["type"]);

//цены
$row = $db->getRow("SELECT * FROM `tb_price`");

switch($semena) {
case 1:$price_s = $row["zavod_testo"];break;
case 2:$price_s = $row["zavod_farsh"];break;
case 3:$price_s = $row["zavod_sir"];break;
case 4:$price_s = $row["zavod_smetana"];break;
case 5:$price_s = $row["zavod_meh"];break;
case 6:$price_s = $row["zavod_navoz"];break;

}
$price_pole = $row["pole"];
unset($sql, $row);
// данные пользователя
$row = $db->getRow("SELECT * FROM `tb_users` WHERE `username` = ?s", $login);

$user_id = $row['id'];
$money = $row["money"];
$ref_id = $row['ref_id'];
$level = $row["level"];
$rating = $row["reyting"];
$energy = $row['energy'];
$yaco = $row['yaco_per'];
$maso = $row['myaso_per'];
$m_o = $row['m_o_per'];
$m_k = $row['m_k_per'];
$meh = $row['meh'];
$navoz = $row['navoz'];

unset($sql, $row);
$date = time();
//$enerr = mysql_fetch_assoc(mysql_query("SELECT * FROM tb_energy WHERE id = 1")) or die(mysql_error());
/*
if($semena == 2) {
$sql = mysql_query("SELECT `id` FROM `tb_fabrika` WHERE `type` = '1' AND `username` = '$login'") or die(mysql_error());
	if(mysql_num_rows($sql) == 0) {
		echo json_encode($result = array("typeu" => "error", "message" => "Вам необходимо сначала купить фабрику Тесто!")); exit();
	}
}

if($semena == 3) {
$sql = mysql_query("SELECT `id` FROM `tb_fabrika` WHERE `type` = 2 AND `username` = '$login'") or die(mysql_error());
	if(mysql_num_rows($sql) == 0) {
		echo json_encode($result = array("typeu" => "error", "message" => "Вам необходимо сначала купить фабрику Фарш!")); exit();
	}
}

if($semena == 4) {
$sql = mysql_query("SELECT `id` FROM `tb_fabrika` WHERE `type` = 3 AND `username` = '$login'") or die(mysql_error());
	if(mysql_num_rows($sql) == 0) {
		echo json_encode($result = array("typeu" => "error", "message" => "Вам необходимо сначала купить фабрику Сыр!")); exit();
	}
}

if($semena == 5) {
$sql = mysql_query("SELECT `id` FROM `tb_fabrika` WHERE `type` = 4 AND `username` = '$login'") or die(mysql_error());
	if(mysql_num_rows($sql) == 0) {
		echo json_encode($result = array("typeu" => "error", "message" => "Вам необходимо сначала купить фабрику Сметана!")); exit();
	}
}

if($semena == 6) {
$sql = mysql_query("SELECT `id` FROM `tb_fabrika` WHERE `type` = 5 AND `username` = '$login'") or die(mysql_error());
	if(mysql_num_rows($sql) == 0) {
		echo json_encode($result = array("typeu" => "error", "message" => "Вам необходимо сначала купить фабрику Варежки!")); exit();
	}
}
*/

$enerr = $db->getRow("SELECT * FROM tb_energy WHERE id = 1");

// данные поля
$row = $db->getRow("SELECT * FROM `tb_fabrika` WHERE `num` = ?i AND `type` = ?i AND  `username` = ?s", $pole, $semena, $login);

if(isset($row['pay']) and $row['pay'] == 1) {

$fin_time = time_type_fab_p($row["type"]);

$endtime = ($row["time"]+$fin_time) - time();
// если поле есть то обробатывает
if($row["time"] == 0 and $row['pay'] == 1) {
// засажываем поле
$fin_time = time_type_fab_p($semena);
switch($row["type"]) {
case 1: $tip_sem = "yaco_per"; $kol = 300; $kol_sem_user = $yaco; $erer = $enerr['p10']; $ret = $enerr['p37']; break;
case 2: $tip_sem = "myaso_per"; $kol = 300; $kol_sem_user = $maso; $erer = $enerr['p11']; $ret = $enerr['p38']; break;
case 3: $tip_sem = "m_o_per"; $kol = 300; $kol_sem_user = $m_o; $erer = $enerr['p12']; $ret = $enerr['p39']; break;
case 4: $tip_sem = "m_k_per"; $kol = 300; $kol_sem_user = $m_k; $erer = $enerr['p13']; $ret = $enerr['p40']; break;
case 5: $tip_sem = "meh"; $kol = 300; $kol_sem_user = $meh; $erer = $enerr['p14']; $ret = $enerr['p41']; break;
case 6: $tip_sem = "navoz"; $kol = 300; $kol_sem_user = $navoz; $erer = $enerr['p15']; $ret = $enerr['p42']; break;
default: $tip_sem = "yaco_per"; $kol = 300; $kol_sem_user = $yaco; $erer = $enerr['p10']; $ret = $enerr['p37']; break;
}
if($energy < 1) { echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "Недостаточно энергии! Покушайте пирог!")); exit();}
if($kol_sem_user < $kol) { echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "Недостаточно продукции для переработки!")); exit();}

$rating = $rating + $ret;
$db->query("UPDATE `tb_users` SET ?n = ?n - ?i, energy = energy - ?i, reyting = ?i WHERE `username` = ?s", $tip_sem, $tip_sem, $kol, $erer, $rating, $login);
$db->query("UPDATE `tb_fabrika` SET `time` = ?s, `udob` = ?i, `date_use` = ?s WHERE `num` = ?i AND `type` = ?i AND `username` = ?s", time(), $kol, time(), $pole, $semena, $login);

if($lvlup = IsLevelUp($level, $rating, $user_id)) 
{
	$islvlup = "Поздравляем вы перешли на уровень ($lvlup)";
}
echo json_encode($result = array("typeu" => "success", "lvlup" => $islvlup, "typeclick" => "posadil", "type" => $semena, "id" => $pole, "message" => "Вы поставили продукты на переработку"));exit();
}elseif($row["time"] > 0 and $row["time"] > (time()-$fin_time)) {
switch($row["type"]) {
case 1: $tip_sem1 = "Тесто";break;
case 2: $tip_sem1 = "Фарш";break;
case 3: $tip_sem1 = "Сыр";break;
case 4: $tip_sem1 = "Сметана";break;
case 5: $tip_sem1 = "Варежки";break;
case 6: $tip_sem1 = "Удобрение";break;
}
// время до сбора урожая
$endtime = ($row["time"]+$fin_time) - time();
echo json_encode($result = array("typeu" => "none", "lvlup" => $islvlup, "message" => "Перерабатывается ".$tip_sem1."! <br>Изготовлено: ".$row['kol_prod']."/365<br> <span id='timer_$pole'></span><script type='text/javascript'>pole_timer($endtime, 'timer_$pole');</script>"));exit();
}elseif($row["time"] <= (time()-$fin_time)) {
switch($row['type']) {
case 1: $sbor = 'testo'; $kol_sbor = 200; $erer = $enerr['p19']; $ret = $enerr['p46']; break;
case 2: $sbor = 'farsh'; $kol_sbor = 200; $erer = $enerr['p20']; $ret = $enerr['p47']; break;
case 3: $sbor = 'sir'; $kol_sbor = 200; $erer = $enerr['p21']; $ret = $enerr['p48']; break;
case 4: $sbor = 'smetana'; $kol_sbor = 200; $erer = $enerr['p22']; $ret = $enerr['p49']; break;
case 5: $sbor = 'meh'; $kol_sbor = 200; $erer = $enerr['p23']; $ret = $enerr['p50']; break;
case 6: $sbor = 'navoz'; $kol_sbor = 200; $erer = $enerr['p24']; $ret = $enerr['p51']; break;
default: $sbor = 'testo'; $kol_sbor = 200; $erer = $enerr['p19']; $ret = $enerr['p46']; break;
}
switch($row["type"]) {
case 1: $tip_sem1 = "Тесто";break;
case 2: $tip_sem1 = "Фарш";break;
case 3: $tip_sem1 = "Сыр";break;
case 4: $tip_sem1 = "Сметана";break;
case 5: $tip_sem1 = "Варежки";break;
case 6: $tip_sem1 = "Удобрение";break;
}
if($energy < 1) { echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "Недостаточно энергии! Покушайте пирог!")); exit();}
$rating = $rating + $ret;
$db->query("UPDATE `tb_users` SET ?n = ?n + ?i, energy = energy - ?i, reyting = ?i WHERE `username` = ?s", $sbor, $sbor, $kol_sbor, $erer, $rating, $login);
if($lvlup = IsLevelUp($level, $rating, $user_id)) 
{
	$islvlup = "Поздравляем вы перешли на уровень ($lvlup)";
}
#Проверяем лимит готовой продукции (для уничтожения фабрики)
if($row['kol_prod'] == 364)
{
	$db->query("update `tb_fabrika` set `time` = '0', `udob` = '0', `kol_prod` = '0', `pay` = '0' where `username` = ?s AND `num` = ?i AND `type` = ?i", $login, $pole, $semena);
	echo json_encode($result = array("typeu" => "warning", "lvlup" => $islvlup, "stil" => "pole_kupite", "stildell" => "pole_kupite", "message" => "Поздравляем Вы собрали ".$tip_sem1.". Фабрика завершила свою работу."));exit(); 
}
else
{
	$db->query("UPDATE `tb_fabrika` SET `time` = '0', `udob` = '0', `kol_prod` = `kol_prod` + 1 WHERE `num` = ?i AND `type` = ?i AND `username` = ?s", $pole, $semena, $login);
	echo json_encode($result = array("typeu" => "success", "lvlup" => $islvlup, "typeclick" => "sobrat", "type" => $row['type'], "message" => "Поздравляем Вы собрали ".$tip_sem1.""));exit();exit();
}

}

// если завода нет то покупаем
} else {

switch($semena) {
case 1; $op = 10; $erer = $enerr['p1']; $ret = $enerr['p28']; break;
case 2; $op = 25; $erer = $enerr['p2']; $ret = $enerr['p29']; break;
case 3; $op = 40; $erer = $enerr['p6']; $ret = $enerr['p30']; break;
case 4; $op = 55; $erer = $enerr['p4']; $ret = $enerr['p31']; break;
//case 5; $op = 40; $erer = $enerr['p5'];  $ret = $enerr['p32']; break;
//case 6; $op = 45; $erer = $enerr['p6'];  $ret = $enerr['p33']; break;
}



if($level >= $op) {
if($energy < $ener) { echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "Недостаточно энергии! Покушайте пирог!")); exit();}
if($money < $price_s){ echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "Недостаточно денег на счету"));exit();}

switch($semena) {
case 1: $zav = 'Теста'; break;
case 2: $zav = 'Фарша'; break;
case 3: $zav = 'Сыра'; break;
case 4: $zav = 'Творога'; break;
//case 5: $zav = 'Варежек'; break;
//case 6: $zav = 'Удобрений'; break;
}

/*function test($login, $semena, $pole, $level)
{
	$sql = mysql_fetch_assoc(mysql_query("select count(`id`) as `cnt` from `tb_fabrika` where `username` = '$login' and `type` = '$semena' limit 1"));
	
	if($sql['cnt'] > 1)
	echo json_encode($result = array("typeu" => "error", "message" => "Ошибка: " . $sql['cnt']));exit();
}

test($login, $semena, $pole, $level);
*/
if(isset($row['pay']) and $row['pay'] == 0)
{
	$db->query("update `tb_fabrika` set `pay` = 1 where `username` = ?s and `num` = ?i and `type` = ?i", $login, $pole, $semena);
}
else
{
	$db->query("INSERT INTO `tb_fabrika` SET ?u", array('username' => $login, 'num' => $pole, 'type' => $semena, 'time' => '0', 'udob' => '0', 'pay' => '1'));
}

$date = time();

if($ref_id > 0)
{
	$ref_sum = $price_s * 0.1;
	$db->query("UPDATE `tb_users` SET `money_out` = `money_out` + ?i WHERE id = ?i LIMIT 1", $ref_sum, $ref_id);
	$db->query("insert into `tb_history` set ?u", array('user_id' => $ref_id, 'summa' => $ref_sum, 'date' => $date, 'comment' => 'Покупка фабрики по переработке $zav, рефералом $login', 'type' => 'ref'));
}

$percent_admin = $price_s * 0.11;
$db->query("UPDATE `tb_users` SET `money_out` = `money_out` + ?i WHERE id = '1' LIMIT 1", $percent_admin);
$db->query("insert into `tb_history` set ?u", array('user_id' => '1', 'summa' => $percent_admin, 'date' => $date, 'comment' => 'Покупка фабрики по переработке $zav, пользователем: $login', 'type' => 'admin'));

$rez = $price_s - ($percent_admin + $ref_sum);
$db->query("UPDATE `tb_lavka` SET `rezerv` = `rezerv` + ?i WHERE id = 1", $rez);
$db->query("insert into `tb_history` set ?u", array('user_id' => '0', 'summa' => $rez, 'date' => $date, 'comment' => 'Покупка фабрики по переработке $zav, пользователем: $login', 'type' => 'rezerv'));

$rating = $rating + $ret;
$db->query("UPDATE `tb_users` SET money = money - ?i, energy = energy - ?i, reyting = ?i WHERE `username` = ?s", $price_s, $erer, $rating, $login);
if($lvlup = IsLevelUp($level, $rating, $user_id)) 
{
	$islvlup = "Поздравляем вы перешли на уровень ($lvlup)";
}
//$ref_sum = $price_s * 0.1;
//mysql_query("UPDATE `tb_users` SET `money_out` = `money_out` + '$ref_sum' WHERE id = '$ref_id' LIMIT 1") or die(mysql_error());
//$rez_lavka = $price_s * 0.01;
//$rez = $price_s - ($ref_sum + $rez_lavka);
//mysql_query("UPDATE `tb_lavka` SET `rezerv` = `rezerv` + '$rez' WHERE id = 1") or die(mysql_error());

//mysql_query("INSERT INTO tb_history (user_id, summa, date, comment, type) VALUES ('$usid', '$price_s', '$date', 'Купил фабрику по переработке $zav', 'fabrika')") or die(mysql_error());

echo json_encode($result = array("typeu" => "success", "lvlup" => $islvlup, "typeclick" => "pole_kupite", "message" => "Поздравляем Вы купили завод по переработке ".$zav.""));exit();
}else{
echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "Рейтинг меньше нужного"));exit();
}

}

}
if (!function_exists('json_encode')) {  
    function json_encode($value) 
    {
        if (is_int($value)) {
            return (string)$value;   
        } elseif (is_string($value)) {
	        $value = str_replace(array('\\', '/', '"', "\r", "\n", "\b", "\f", "\t"), 
	                             array('\\\\', '\/', '\"', '\r', '\n', '\b', '\f', '\t'), $value);
	        $convmap = array(0x80, 0xFFFF, 0, 0xFFFF);
	        $result = "";
	        for ($i = mb_strlen($value) - 1; $i >= 0; $i--) {
	            $mb_char = mb_substr($value, $i, 1);
	            if (mb_ereg("&#(\\d+);", mb_encode_numericentity($mb_char, $convmap, "UTF-8"), $match)) {
	                $result = sprintf("\\u%04x", $match[1]) . $result;
	            } else {
	                $result = $mb_char . $result;
	            }
	        }
	        return '"' . $result . '"';                
        } elseif (is_float($value)) {
            return str_replace(",", ".", $value);         
        } elseif (is_null($value)) {
            return 'null';
        } elseif (is_bool($value)) {
            return $value ? 'true' : 'false';
        } elseif (is_array($value)) {
            $with_keys = false;
            $n = count($value);
            for ($i = 0, reset($value); $i < $n; $i++, next($value)) {
                        if (key($value) !== $i) {
			      $with_keys = true;
			      break;
                        }
            }
        } elseif (is_object($value)) {
            $with_keys = true;
        } else {
            return '';
        }
        $result = array();
        if ($with_keys) {
            foreach ($value as $key => $v) {
                $result[] = json_encode((string)$key) . ':' . json_encode($v);    
            }
            return '{' . implode(',', $result) . '}';                
        } else {
            foreach ($value as $key => $v) {
                $result[] = json_encode($v);    
            }
            return '[' . implode(',', $result) . ']';
        }
    } 
}
?>