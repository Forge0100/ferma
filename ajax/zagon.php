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

if(!isset($_SESSION['id'])) {echo json_encode($result = array("typeu" => "error", "message" => "Сессия устарела! Обновите страницу!")); exit();}

$pole = valideint($_POST["pole"]);
$type_zagon = valideint($_POST["type"]);
$page = valideint($_POST["page"]);


$_SESSION['zagon']['tab'][$type_zagon] = $page;

//цены
$row = $db->getRow("SELECT `price_kuratnik`, `price_svin`, `price_ovta`, `price_karova`, `price_lama`, `price_slon` FROM `tb_price`");

	switch($type_zagon) {
		case 1: $price_zagon = $row['price_kuratnik']; break;
		case 2: $price_zagon = $row['price_svin']; break;
		case 3: $price_zagon = $row['price_ovta']; break;
		case 4: $price_zagon = $row['price_karova']; break;
		//case 5: $price_zagon = $row['price_lama']; break;
		//case 6: $price_zagon = $row['price_slon']; break;
	}
unset($sql, $row);

switch($type_zagon) {
	case 1: $stil = ' zagon1'; break;
	case 2: $stil = ' zagon2'; break;
	case 3: $stil = ' zagon3'; break;
	case 4: $stil = ' zagon4'; break;
	//case 5: $stil = ' zagon5'; break;
	//case 6: $stil = ' zagon6'; break;
}

switch($type_zagon) {
	case 1: $name_zagon = 'Загон Кур';$kol_type="kol_kurat"; break;
	case 2: $name_zagon = 'Загон Бычков';$kol_type="kol_svinarnik"; break;
	case 3: $name_zagon = 'Загон Коз'; $kol_type="kol_ovtarnik";break;
	case 4: $name_zagon = 'Загон Коров'; $kol_type="kol_korovnik";break;
	
}

switch($type_zagon){
	case 1: $min_opit = 1; break;
	case 2: $min_opit = 5; break;
	case 3: $min_opit = 10; break;
	case 4: $min_opit = 15; break;
	//case 5: $min_opit = 20; break;
	//case 6: $min_opit = 25; break;

}

// данные пользователя

$row = $db->getRow("SELECT * FROM `tb_users` WHERE `username` = ?s", $login);

$money = $row["money"];
$ref_id = $row['ref_id'];
$level = $row["level"];
$energy = $row['energy'];

unset($sql, $row);


// данные поля
$sql = $db->query("SELECT * FROM `tb_zagon` WHERE `num` = ?i AND `type` = ?i AND `login` = ?s", $pole, $type_zagon, $login);

if($db->numRows($sql) > 0) {
$row = $db->fetch($sql);
}else{

if($price_zagon > $money) { echo json_encode($result = array("typeu" => "error", "typeclick" => "pole_kupite", "message" => "Не достаточно денег для покупки")); exit(); }
if($level < $min_opit) { echo json_encode($result = array("typeu" => "error", "typeclick" => "pole_kupite", "message" => "Рейтинг меньше нужного!")); exit(); }

$db->query("INSERT INTO `tb_zagon` SET ?u", array('user_id' => $usid, 'login' => $login, 'type' => $type_zagon, 'num' => $pole, 'pay' => '1'));

for($i = 1; $i <= 9; $i++) {
$db->query("INSERT INTO `tb_zagon_id` SET ?u", array('zagon_id' => $pole, 'user_id' => $usid, 'login' => $login, 'type' => $type_zagon, 'num' => $i, 'status' => '0'));
}

$db->query("UPDATE tb_users SET money = money - ?i WHERE username = ?s", $price_zagon, $login);
$db->query("UPDATE tb_stat_full SET ?n = ?n + 1 WHERE id = 1", $kol_type, $kol_type);

$date = time();

if($ref_id > 0)
{
	$ref_sum = $price_zagon * 0.1;
	//$db->query("UPDATE `tb_users` SET money_out = money_out + ?i WHERE id = ?i LIMIT 1", $ref_sum, $ref_id);
	$db->query("UPDATE `tb_users` SET money_out = money_out + ?s, ref_money = ref_money + ?s WHERE id = ?i LIMIT 1", $ref_sum, $ref_sum, $ref_id);
	$db->query("insert into `tb_history` set ?u", array('user_id' => $ref_id, 'summa' => $ref_sum, 'date' => $date, 'comment' => 'Покупка загона $name_zagon, рефералом $login', 'type' => 'ref'));
}

//$rez_lavka = $price_zagon * 0.01;
$percent_admin = $price_zagon * 0.11;
$db->query("UPDATE `tb_users` SET `money_out` = `money_out` + ?i WHERE id = '1' LIMIT 1", $percent_admin);
$db->query("insert into `tb_history` set ?u", array('user_id' => '1', 'summa' => $percent_admin, 'date' => $date, 'comment' => 'Покупка загона $name_zagon, пользователем: $login', 'type' => 'admin'));

$rez = $price_zagon - ($percent_admin + $ref_sum);
$db->query("UPDATE `tb_lavka` SET `rezerv` = `rezerv` + ?i WHERE id = 1", $rez);
$db->query("insert into `tb_history` set ?u", array('user_id' => '0', 'summa' => $rez, 'date' => $date, 'comment' => 'Покупка загона $name_zagon, пользователем: $login', 'type' => 'rezerv'));

$db->query("insert into `tb_history` set ?u", array('user_id' => $usid, 'summa' => $price_zagon, 'date' => $date, 'comment' => 'Покупка загона $name_zagon', 'type' => 'domik'));

echo json_encode($result = array("typeu" => "success", "typeclick" => "pole_kupite1", "stil" => $stil, "message" => "Поздравляем! Вы купили ".$name_zagon."!")); exit();
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