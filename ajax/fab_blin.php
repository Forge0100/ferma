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
$islvlup = 'bad';
if(!isset($_SESSION['id'])) {echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "Сессия устарела! Обновите страницу!")); exit();}
$pole = valideint($_POST["pole"]);
$semena = valideint($_POST["type"]);

//цены
$row = $db->getRow("SELECT `f1`, `f2`, `f3` FROM `tb_price`");

switch($semena) {
case 1:
	$price_s = $row["f1"];
break;
case 2:
	$price_s = $row["f2"];
break;
case 3:
	$price_s = $row["f3"];
break;
default:
	$price_s = $row["f1"]; 
break;
}

unset($sql, $row);

// данные пользователя
$row = $db->getRow("SELECT `id`, `money`, `ref_id`, `level`, `energy`, `reyting`, `testo_per`, `farsh_per`, `sir_per`, `smetana_per` FROM `tb_users` WHERE `username` = ?s", $login);

$user_id = $row['id'];
$money = $row["money"];
$ref_id = $row['ref_id'];
$level = $row["level"];
$rating = $row["reyting"];
$energy = $row['energy'];
$yaco = $row['testo_per'];
$farsh = $row['farsh_per'];
$sir = $row['sir_per'];
$smet = $row['smetana_per'];
//$varezh = $row['varezhki'];

unset($sql, $row);
$date = time();


$ener = $db->getRow("SELECT * FROM tb_energy WHERE id = 1");



// данные поля
$row = $db->getRow("SELECT * FROM `tb_fabrika_blin` WHERE `num` = ?i AND `type` = ?i AND `username` = ?s", $pole, $semena, $login);

if(isset($row['pay']) and $row['pay'] == 1) {

$fin_time = time_type_fab_b($row["type"]);

$endtime = ($row["time"]+$fin_time) - time();
// если поле есть то обробатывает
if($row["time"] == 0 and $row['pay'] == 1) {
// засажываем поле
$fin_time = time_type_fab_b($semena);
switch($row["type"]) {
case 1: 
	$tip_sem1 = "testo_per"; 
	$tip_sem2 = "farsh_per"; 
	$kol1 = 70; 
	$kol2 = 200; 
	$kol_sem_user1 = $yaco; 
	$kol_sem_user2 = $farsh; 
break;
case 2: 
	$tip_sem1 = "testo_per"; 
	$tip_sem2 = "sir_per"; 
	$kol1 = 70; 
	$kol2 = 200; 
	$kol_sem_user1 = $yaco; 
	$kol_sem_user2 = $sir; 
break;
case 3: 
	$tip_sem1 = "testo_per"; 
	$tip_sem2 = "smetana_per"; 
	$kol1 = 70; 
	$kol2 = 200; 
	$kol_sem_user1 = $yaco; 
	$kol_sem_user2 = $smet;
break;
}

//Энергия и опыт за установку фабрики а так же необходимые продукты
switch($row["type"]) {
	case 1: 
		$opit1 = $ener['p43']; 
		$ener1 = $ener['p16'];
		
	break;
	
	case 2: 
		$opit1 = $ener['p44']; 
		$ener1 = $ener['p17'];
			
	break;
	
	case 3: 
		$opit1 = $ener['p45']; 
		$ener1 = $ener['p18'];
				
	break;
}

if($energy < 1) { echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "Недостаточно энергии! Покушайте пирог!")); exit();}

if($kol_sem_user1 < $kol1 and $kol_sem_user2 < $kol2) { echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "Недостаточно продукции для переработки!")); exit();}
//if($row['date_use'] != 0 and (time() <= (intval($row['date_use']) + 86400))) { echo json_encode($result = array("typeu" => "error", "message" => "Сегодня вы уже пользовались этой фабрикой")); exit();}
$rating = $rating + $opit1;
$db->query("UPDATE `tb_users` SET ?n = ?n - ?i, ?n = ?n - ?i, energy = energy - ?i, `reyting` = ?i WHERE `username` = ?s", $tip_sem1, $tip_sem1, $kol1, $tip_sem2, $tip_sem2, $kol2, $ener1, $rating, $login);
if($lvlup = IsLevelUp($level, $rating, $user_id)) 
{
	$islvlup = "Поздравляем вы перешли на уровень ($lvlup)";
}
$db->query("UPDATE `tb_fabrika_blin` SET ?u WHERE `num` = ?i AND `type` = ?i AND `username` = ?s", array('time' => time(), 'res1' => $kol1, 'res2' => $kol2, 'date_use' => time()), $pole, $semena, $login);

echo json_encode($result = array("typeu" => "success", "lvlup" => $islvlup, "typeclick" => "posadil", "type" => $semena, "id" => $pole, "message" => "Вы поставили продукты на переработку"));exit();

}elseif($row["time"] > 0 and $row["time"] > (time()-$fin_time)) {

switch($row["type"]) {
case 1: 
	$tip_sem11 = "мясом";
break;
case 2: 
	$tip_sem11 = "сыром";
break;
case 3: 
	$tip_sem11 = "творогом";
break;

}
// время до сбора урожая
$endtime = ($row["time"]+$fin_time) - time();
echo json_encode($result = array("typeu" => "none", "lvlup" => $islvlup, "message" => "Перерабатываются пироги с ".$tip_sem11."! <br>Изготовлено: ".$row['kol_prod']."/365<br> <span id='timer_$pole'></span><script type='text/javascript'>pole_timer($endtime, 'timer_$pole');</script>"));exit();

}elseif($row["time"] <= (time()-$fin_time)) {

switch($row['type']) {
case 1: 
	$sbor = 'blin_myaso_by'; 
	$kol_sbor = 200; 
break;
case 2: 
	$sbor = 'blin_sir_by'; 
	$kol_sbor = 200; 
break;
case 3: 
	$sbor = 'blin_smetana_by'; 
	$kol_sbor = 200; 
break;
default: 
	$sbor = 'blin_myaso_by'; 
	$kol_sbor = 200; 
break;
}

switch($row["type"]) {
case 1: $tip_sem12 = "мясом"; break;
case 2: $tip_sem12 = "сыром"; break;
case 3: $tip_sem12 = "творогом"; break;
}
//Энергия и опыт за установку фабрики а так же необходимые продукты
switch($row["type"]) {
	case 1: 
		
		$opit2 = $ener['p52']; 
		$ener2 = $ener['p25']; 
		$varez = 2;
	break;
	
	case 2: 
		
		$opit2 = $ener['p53']; 
		$ener2 = $ener['p26']; 
		$varez = 5;		
	break;
	
	case 3: 
		
		$opit2 = $ener['p54']; 
		$ener2 = $ener['p27'];
		$varez = 10;
	break;
}
//if($varezh < $varez) { echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "Для сбора необходимы варежки!")); exit();}
if($energy < $ener2) { echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "Недостаточно энергии! Покушайте пирог!")); exit();}
$rating = $rating + $opit2;
$db->query("UPDATE `tb_users` SET ?n = ?n + ?i, energy = energy - ?i, `reyting` = ?i WHERE `username` = ?s", $sbor, $sbor, $kol_sbor, $ener2, $rating, $login);
if($lvlup = IsLevelUp($level, $rating, $user_id)) 
{
	$islvlup = "Поздравляем вы перешли на уровень ($lvlup)";
}
#Проверяем лимит готовой продукции (для уничтожения фабрики)
if($row['kol_prod'] == 364)
{
	$db->query("update `tb_fabrika_blin` set `time` = '0', `res1` = '0', `res2` = '0', `kol_prod` = '0', `pay` = '0' where `username` = ?s AND `num` = ?i AND `type` = ?i", $login, $pole, $semena);
	echo json_encode($result = array("typeu" => "warning", "lvlup" => $islvlup, "stil" => "pole_kupite", "stildell" => "pole_kupite", "message" => "Поздравляем Вы собрали пироги с  ".$tip_sem12.". Фабрика завершила свою работу."));exit(); 
}
else
{
	$db->query("UPDATE `tb_fabrika_blin` SET `time` = '0', `res1` = '0', `res2` = '0', `kol_prod` = `kol_prod` + 1 WHERE `num` = ?i AND `type` = ?i AND `username` = ?s", $pole, $semena, $login);
	echo json_encode($result = array("typeu" => "success", "lvlup" => $islvlup, "typeclick" => "sobrat", "type" => $row['type'], "message" => "Поздравляем Вы собрали пироги с  ".$tip_sem12.""));exit();exit();
}

}

// если завода нет то покупаем
} else {

switch($semena) {
case 1: 
	$op = 40;
	$ener = 100;
	$opit = 100;	
break;
case 2: 
	$op = 60;
	$ener = 100;
	$opit = 100;	
break;
case 3: 
	$op = 80; 
	$ener = 100;
	$opit = 100;
break;

}



if($level >= $op) {
if($energy < $ener) { echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "Недостаточно энергии! Покушайте пирог!")); exit();}
if($money < $price_s){ echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "Недостаточно денег на счету"));exit();}

switch($semena) {
case 1: $zav = 'мясом'; break;
case 2: $zav = 'сыром'; break;
case 3: $zav = 'творогом'; break;
}

if(isset($row['pay']) and $row['pay'] == 0)
{
	$db->query("update `tb_fabrika_blin` set `pay` = 1 where `username` = ?s and `num` = ?i and `type` = ?i", $login, $pole, $semena);
}
else
{
	$db->query("INSERT INTO `tb_fabrika_blin` (`username`, `num`, `type`, `time`, `res1`, `res2`, `pay`) VALUES (?s, ?i, ?i, '0', '0', '0', '1')", $login, $pole, $semena);
}

$date = time();

if($ref_id > 0)
{
	$ref_sum = $price_s * 0.1;
	//$db->query("UPDATE `tb_users` SET `money_out` = `money_out` + ?i WHERE id = ?i LIMIT 1", $ref_sum, $ref_id);
	$db->query("UPDATE `tb_users` SET `money_out` = `money_out` + ?s, `ref_money` = `ref_money` + ?s WHERE id = ?i LIMIT 1", $ref_sum, $ref_sum, $ref_id);
	$db->query("insert into `tb_history` set ?u", array('user_id' => $ref_id, 'summa' => $ref_sum, 'date' => $date, 'comment' => 'Покупка фабрики по переработке пирогов с $zav, рефералом $login', 'type' => 'ref'));
}

$percent_admin = $price_s * 0.11;
$db->query("UPDATE `tb_users` SET `money_out` = `money_out` + ?i WHERE id = '1' LIMIT 1", $percent_admin);
$db->query("insert into `tb_history` set ?u", array('user_id' => '1', 'summa' => $percent_admin, 'date' => $date, 'comment' => 'Покупка по переработке пирогов с $zav, пользователем: $login', 'type' => 'admin'));

$rez = $price_s - ($percent_admin + $ref_sum);
$db->query("UPDATE `tb_lavka` SET `rezerv` = `rezerv` + ?i WHERE id = 1", $rez);
$db->query("insert into `tb_history` set ?u", array('user_id' => '0', 'summa' => $rez, 'date' => $date, 'comment' => 'Покупка фабрики по переработке пирогов с $zav, пользователем: $login', 'type' => 'rezerv'));

$rating = $rating + $opit;
$db->query("UPDATE `tb_users` SET `money` = `money` - ?i, energy = energy - ?i, `reyting` = ?i WHERE `username` = ?s", $price_s, $ener, $rating, $login);
if($lvlup = IsLevelUp($level, $rating, $user_id)) 
{
	$islvlup = "Поздравляем вы перешли на уровень ($lvlup)";
}
//$ref_sum = $price_s * 0.1;
//mysql_query("UPDATE `tb_users` SET `money` = `money` + '$ref_sum' WHERE id = '$ref_id' LIMIT 1") or die(mysql_error());
//$rez_lavka = $price_s * 0.01;
//$rez = $price_s - ($ref_sum + $rez_lavka);
//mysql_query("UPDATE `tb_lavka` SET `rezerv` = `rezerv` + '$rez' WHERE id = 1") or die(mysql_error());
//mysql_query("INSERT INTO tb_history (user_id, summa, date, comment, type) VALUES ('$usid', '$price_s', '$date', 'Купил фабррику по переработке пирогов с $zav', 'fabrika_blincik')") or die(mysql_error());
echo json_encode($result = array("typeu" => "success", "lvlup" => $islvlup, "typeclick" => "pole_kupite", "message" => "Поздравляем Вы купили завод по переработке пирогов с ".$zav.""));exit();
}else{
echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "Рейтинг меньше нужного"));exit();
}

}

} else {echo json_encode($result = array("typeu" => "error", "lvlup" => $islvlup, "message" => "Ошибочка!!!"));exit(); }
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