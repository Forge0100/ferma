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

if($_POST['func'] == 'success') {
$pole = valideint($_POST["pole"]);
$semena = valideint($_POST["type"]);
echo json_encode($result = array("message" => "Рейтинг меньше нужного"));


//цены
$row = $db->getRow("SELECT * FROM `tb_price`");

switch($semena) {
case 1:$price_s = $row["s1"];break;
case 2:$price_s = $row["s2"];break;
case 3:$price_s = $row["s3"];break;
case 4:$price_s = $row["s4"];break;
case 5:$price_s = $row["s5"];break;
case 6:$price_s = $row["s6"];break;
default:$price_s = $row["s6"];
}
$price_pole = $row["pole"];
unset($sql, $row);
// данные пользователя
$row = $db->getRow("SELECT * FROM `tb_users` WHERE `username` = ?s", $login);

$money = $row["money"];
$level = $row["level"];
$u_udob = $row["udob"];
$energy = $row['energy'];
unset($sql, $row);
// данные поля
$sql = $db->query("SELECT * FROM `tb_fabrika` WHERE `num` = ?i AND `username` = ?s", $pole, $login);
if($db->numRows($sql) > 0) {
$row = $db->fetch($sql);

$fin_time = time_type($row["type"]);

$endtime = ($row["time"]+$fin_time) - time();
// если поле есть то обробатывает
if($row["type"] == 0) {
// засажываем поле
$fin_time = time_type($semena);
if($energy < 1) { echo json_encode($result = array("message" => "Недостаточно энергии! Покушайте пирог!")); exit();}
$db->query("UPDATE `tb_users` SET `money` = `money` - ?i, energy = energy - '1' WHERE `username` = ?s", $price_s, $login);
include_once ("data/opit.php");
$db->query("UPDATE `tb_fabrika` SET `type` = ?i, `time` = ?s, `udob` = '0' WHERE `num` = ?i AND `username` = ?s", $semena, time(), $pole, $login);
echo json_encode($result = array("typeclick" => "posadil", "type" => $semena, "id" => $pole, "message" => "Вы засадили поле"));exit();
}elseif($row["type"] > 0) {
if($udob == 1) {
if($row["time"] <= (time()-$fin_time)){
// собираем урожай
switch($row["type"]) {
case 1: $tip_sem = "pshenica";break;
case 2: $tip_sem = "kukurudza";break;
case 3: $tip_sem = "jachmen";break;
case 4: $tip_sem = "svekla";break;
case 5: $tip_sem = "bobi";break;
case 6: $tip_sem = "tikva";break;
}
if($energy < 1) { echo json_encode($result = array("message" => "Недостаточно энергии! Покушайте пирог!")); exit();}
$db->query("UPDATE `tb_users` SET `?n` = `?n` + '1', energy = energy - '1' WHERE `username` = ?s", $tip_sem, $tip_sem, $login);
include_once ("data/opit.php");
$db->query("UPDATE `tb_fabrika` SET `type` = '0', `udob` = '0', `time` = '0' WHERE `num` = ?i AND `username` = ?s", $pole, $login);
echo json_encode($result = array("typeclick" => "sobrat", "type" => $row['type'], "message" => "Поздравляем Вы собрали урожай"));exit();exit();
}else{
// удобряем урожай
if($row["udob"] == 1 AND $row["time"] > (time()-$fin_time)){
switch($row["type"]) {
case 1: $tip_sem1 = "Пшеница";break;
case 2: $tip_sem1 = "Клевер";break;
case 3: $tip_sem1 = "Капуста";break;
case 4: $tip_sem1 = "Свёкла";break;
case 5: $tip_sem1 = "Бобы";break;
case 6: $tip_sem1 = "Тыква";break;
}
echo json_encode($result = array("type" => $row['type'], "message" => "Засеяно ".$tip_sem1."! <span id='timer_$pole'></span><script type='text/javascript'>pole_timer($endtime, 'timer_$pole');</script>", "id" => $pole));exit();
exit();}
if($u_udob < 1){echo json_encode($result = array("message" => "У Вас недостаточно энергии"));exit();}
if($energy < 1) { echo json_encode($result = array("message" => "Недостаточно энергии! Покушайте пирог!")); exit();}
$db->query("UPDATE `tb_users` SET `udob` = `udob` - '1', energy = energy - '1' WHERE `username` = ?s", $login);
include_once ("data/opit.php");
$db->query("UPDATE `tb_fabrika` SET `udob` = '1' WHERE `num` = ?i AND `username` = ?s", $pole, $login);
echo json_encode($result = array("typeclick" => "udobrit", "type" => $row['type'], "id" => $pole, "message" => "Вы удобрили поле"));exit();
}
}elseif($row["time"] <= (time()-$fin_time)){
// собираем урожай
switch($row["type"]) {
case 1: $tip_sem = "pshenica";break;
case 2: $tip_sem = "kukurudza";break;
case 3: $tip_sem = "jachmen";break;
case 4: $tip_sem = "svekla";break;
case 5: $tip_sem = "bobi";break;
case 6: $tip_sem = "tikva";break;
}

switch($row["type"]) {
case 1: $tip_sem1 = "Пшеницу";break;
case 2: $tip_sem1 = "Клевер";break;
case 3: $tip_sem1 = "Капусту";break;
case 4: $tip_sem1 = "Свёклу";break;
case 5: $tip_sem1 = "Бобы";break;
case 6: $tip_sem1 = "Тыкву";break;
}
if($energy < 1) { echo json_encode($result = array("message" => "Недостаточно энергии! Покушайте пирог!")); exit();}
$db->query("UPDATE `tb_users` SET `?n` = `?n` + '1', energy = energy - '1' WHERE `username` = ?s", $tip_sem, $tip_sem, $login);
include_once ("data/opit.php");
$db->query("UPDATE `tb_fabrika` SET `type` = '0', `udob` = '0', `time` = '0' WHERE `num` = ?i AND `username` = ?s", $pole, $login);
echo json_encode($result = array("typeclick" => "sobrat", "type" => $row['type'], "message" => "Поздравляем Вы собрали ".$tip_sem1.""));exit();exit();
}else{
switch($row["type"]) {
case 1: $tip_sem1 = "Пшеница";break;
case 2: $tip_sem1 = "Клевер";break;
case 3: $tip_sem1 = "Капуста";break;
case 4: $tip_sem1 = "Свёкла";break;
case 5: $tip_sem1 = "Бобы";break;
case 6: $tip_sem1 = "Тыква";break;
}
// время до сбора урожая
$endtime = ($row["time"]+$fin_time) - time();
echo json_encode($result = array("message" => "Засеяно ".$tip_sem1."! <span id='timer_$pole'></span><script type='text/javascript'>pole_timer($endtime, 'timer_$pole');</script>"));exit();
}
}
unset($row);
}else{
// если поля нет то покупаем
if($level >= $pole) {
if($energy < 1) { echo json_encode($result = array("message" => "Недостаточно энергии! Покушайте пирог!")); exit();}
if($money < $price_pole){ echo json_encode($result = array("message" => "Недостаточно денег на счету"));exit();}
$db->query("INSERT INTO `tb_fabrika` (`username`, `num`, `type`, `time`, `udob`, `pay`) VALUES (?s, ?i, '0', '0', '0', '1')", $login, $pole);
include_once ("data/opit.php");
$db->query("UPDATE `tb_users` SET `money` = `money` - ?i, energy = energy - '1' WHERE `username` = ?s", $price_pole, $login);
echo json_encode($result = array("typeclick" => "pole_kupit", "message" => "Поздравляем Вы купили поле"));exit();
}else{
echo json_encode($result = array("message" => "Рейтинг меньше нужного"));exit();
}
}
unset($sql);
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