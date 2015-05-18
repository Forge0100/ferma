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

//echo json_encode($result = array("typeu" => "success", "message" => "test first"));
//echo json_encode($result = array("typeu" => "success", "message" => "test second"));
//exit();

if($_POST['func'] == 'success') {
$islvlup = 'bad';
if(!isset($_SESSION['id'])) {echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "Сессия устарела! Обновите страницу!")); exit();}
$pole = valideint($_POST["pole"]);
$semena = valideint($_POST["kuraid"]);
$type_zagon = valideint($_POST["type"]);

//цены
//$sql = mysql_query("SELECT * FROM `tb_price`") or die(mysql_error());
//$row = mysql_fetch_assoc($sql);
//$price_kurat = $row['price_kuratnik'];

//$price_pole = $row["pole"];
//unset($sql, $row);
// данные пользователя
$row = $db->getRow("SELECT * FROM `tb_users` WHERE `username` = ?s", $login);

$user_id = $row['id'];
$money = $row["money"];
$ref_id = $row['ref_id'];
$level = $row["level"];
$rating = $row["reyting"];
$energy = $row['energy'];
$kurr = $row['kurita'];

switch($type_zagon){
	case 1: 
		$kol_korm = $row['pshenica'];
		$kol_kurr = $row['kurita'];
		$korm_name = 'pshenica';
		$name_kurr = 'kurita';
		$prod_name = 'yaco';
		$animal_name = 'Курицу'; 
		$sbor_en = 4;
		$sbor_opit = 2;
		$stil1 = ' zagon1animal1';
		$stil2 = ' zagon1animal2';
		$stil3 = ' zagon1animal3';
		break;
	case 2: 
		$kol_korm = $row['kukurudza'];
		$kol_kurr = $row['svinya'];
		$korm_name = 'kukurudza';
		$name_kurr = 'svinya';
		$prod_name = 'myaso';
		$animal_name = 'Бычка'; 
		$sbor_en = 8;
		$sbor_opit = 4;
		$stil1 = ' zagon2animal1'; 
		$stil2 = ' zagon2animal2'; 
		$stil3 = ' zagon2animal3';
		break;
	case 3: 
		$kol_korm = $row['jachmen'];
		$kol_kurr = $row['ovta'];
		$korm_name = 'jachmen';
		$name_kurr = 'ovta';
		$prod_name = 'm_o';
		$animal_name = 'Козу'; 
		$sbor_en = 12;
		$sbor_opit = 6;
		$stil1 = ' zagon3animal1'; 
		$stil2 = ' zagon3animal2'; 
		$stil3 = ' zagon3animal3';
		break;
	case 4: 
		$kol_korm = $row['svekla'];
		$kol_kurr = $row['karova'];
		$korm_name = 'svekla';
		$name_kurr = 'karova';
		$prod_name = 'm_k';
		$animal_name = 'Корову'; 
		$sbor_en = 16;
		$sbor_opit = 8;
		$stil1 = ' zagon4animal1'; 
		$stil2 = ' zagon4animal2'; 
		$stil3 = ' zagon4animal3';
		break;

}
unset($sql, $row);
$id_prod = 1;
// данные поля
$row = $db->getRow("SELECT * FROM `tb_zagon_id` WHERE `num` = ?i AND `type` = ?i AND `zagon_id` = ?i AND `login` = ?s", $semena, $type_zagon, $pole, $login);

if($row['status'] == 1){
if($row['status'] == 1 and $row['date_korm'] == 0) {
$rating = $rating + 2;
if($energy < 1) { echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "Не хватает энергии! Скушайте пирог"));exit(); }
if($kol_korm < 1) { echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "У Вас нет корма!"));exit(); }
$d = time() + time_type_prod($id_prod);
$db->query("UPDATE `tb_zagon_id` SET `date_korm` = ?s, `korm` = '1' WHERE `zagon_id` = ?i AND `type` = ?i AND `num` = ?i AND `login` = ?s", $d, $pole, $type_zagon, $semena, $login);
$varz_query = "UPDATE `tb_users` SET `".$korm_name."`=`".$korm_name."`-2, `energy`=`energy`-4, `reyting`=".$rating." WHERE `username` ='".$login."'";
//echo $varz_query;
$db->query($varz_query);
//$db->query("UPDATE tb_users SET `?n` = `?n` - '1', `energy` = `energy` - ?i, reyting = ?i WHERE `username` = ?s", $korm_name, $korm_name, $enege, $rating, $login);

if($lvlup = IsLevelUp($level, $rating, $user_id)) 
{
	$islvlup = "Поздравляем вы перешли на уровень ($lvlup)";
}
echo json_encode($result = array("typeu" => "success", "lvlup" => $islvlup, "typeclick" => "pole_kupite", "stil" => $stil2, "stildell" => $stil1, "message" => "Вы покормили ".$animal_name.""));exit();

unset($row, $sql);

} elseif($row['date_korm'] <= time()) {
$rating = $rating + $sbor_opit;
if($energy < 1) { echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "Не хватает энергии! Скушайте пирог"));exit(); }
$db->query("UPDATE tb_zagon_id SET `date_korm` = '0', `korm` = '0', `kol_prod` = `kol_prod` + '1' WHERE `num` = ?i AND `zagon_id` = ?i AND `type` = ?i AND `login` = ?s", $semena, $pole, $type_zagon, $login);
$varz_query = "UPDATE `tb_users` SET `".$prod_name."`=`".$prod_name."`+2, `energy`=`energy` - {$sbor_en}, `reyting`=".$rating." WHERE `username` ='".$login."'";


//echo $varz_query;
$db->query($varz_query);
//$db->query("UPDATE tb_users SET `?n` = `?n` + '2', `energy`=`energy`-1, reyting = ?i WHERE username = ?s", $prod_name, $prod_name, $rating, $login);
if($lvlup = IsLevelUp($level, $rating, $user_id))
{	
	$islvlup = "Поздравляем вы перешли на уровень ($lvlup)";
}
//Проверяем не стоит ли курицу удалить после сбора 60 яиц 
$qq = $db->getRow("SELECT `kol_prod` FROM `tb_zagon_id` WHERE `num` = ?i AND `zagon_id` = ?i AND `type` = ?i AND `login` = ?s", $semena, $pole, $type_zagon, $login);

if($qq['kol_prod'] == 30) {
$db->query("UPDATE `tb_zagon_id` SET `date_korm` = '0', `status` = '0', `kol_prod` = '0', `korm` = '0' WHERE num = ?i AND `zagon_id` = ?i AND `type` = ?i AND login = ?s", $semena, $pole, $type_zagon, $login);
echo json_encode($result = array("typeu" => "warning", "lvlup" => $islvlup, "stil" => "pole_kupite", "stildell" => $stil3, "message" => "Вы собрали продукты! Животное покинуло игровой мир"));exit(); 
}
echo json_encode($result = array("typeu" => "success", "lvlup" => $islvlup, "typeclick" => "pole_kupite", "stil" => $stil1, "stildell" => $stil3, "message" => "Вы собрали продукты"));exit();

} elseif($row['date_korm'] >= time()) {
$endtime = $row['date_korm'] - time();
echo json_encode($result = array("typeu" => "none", "lvlup" => $islvlup, "message" => "".$animal_name."!<br>Собрано: ".$row['kol_prod']."/30<br><span id='timer_$pole'></span><script type='text/javascript'>pole_timer($endtime, 'timer_$pole', $type_zagon, $semena);</script>"));exit();
}
unset($row, $sql);
} else {

if($level < 1)  {echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "Рейтинг меньше нужного"));exit();}
if($energy < 1) { echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "Недостаточно энергии! Покушайте пирог!")); exit();}
if($kol_kurr < 1){ echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "У Вас нет ".$animal_name." на складе!"));exit();}


$db->query("UPDATE `tb_zagon_id` SET `status` = '1' WHERE `num` = ?i AND `zagon_id` = ?i AND `type` = ?i AND `login` = ?s", $semena, $pole, $type_zagon, $login);
$db->query("UPDATE `tb_users` SET ?n = ?n - '1' WHERE `username` = ?s", $name_kurr, $name_kurr, $login);
$db->query("UPDATE tb_stat_full SET kol_kur = kol_kur + 1 WHERE id = 1");

echo json_encode($result = array("typeu" => "success", "lvlup" => $islvlup, "stil" => $stil1, "stildell" => "pole_kupite", "typeclick" => "pole_kupite", "message" => "Поздравляем! Вы посадили ".$animal_name."!"));exit();


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