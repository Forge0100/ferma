<?php
function sf($str){

	return mysql_real_escape_string(strip_tags(htmlspecialchars($str))); 
	
}
function getExperience($level) {
if ($level <= 0) return 0;
if ($level == 1) return 10;
if ($level == 2) return 30;
if ($level > 2&&$level < 6) return 50 + getExperience($level - 1);
if ($level <= 10) return 100 + getExperience($level - 1);
$diff = 10 * (10+$level - $level%10);
return $diff+getExperience($level - 1);
}

function getUserData($id)
{
	global $db;
	$id = intval($id);
	
	if($result = $db->getRow("select * from tb_users where id = ?i limit 1", $id))
	{
		return $result;
	}
	
	return false;
}

function getUserId($name)
{
	global $db;
	if($result = $db->getRow("select id from tb_users where username = ?s limit 1", $name))
	{
		return $result['id'];
	}
	
	return 0;
}

function IsLevelUp($level, $rating, $user_id)
{
	global $db;
	$need_exp = getExperience($level);
	
	if($rating >= $need_exp)
	{
		$last = $rating - $need_exp;
		
		$db->query("UPDATE tb_users SET reyting = ?i, level = level + '1' WHERE id = ?i", $last, $user_id);
		
		return $level+1;
	}
	return false;
}

function validetext($text) {
	$text = strip_tags($text);
	$text = str_replace('<', '', $text);
    $text = str_replace('>', '', $text);
    $text = str_replace('$', 'y.e', $text);
    $text = str_replace(';', '', $text);
    $text = str_replace('"', '', $text);
    $text = str_replace('\'', '', $text);
    $text = str_replace('`', '', $text);
	$text = trim($text);
	return iconv('UTF-8', 'windows-1251', $text);
}

function valideint($str) {

	return (isset($str)) ? filter_var($str, FILTER_VALIDATE_INT) : false;
	
}

function valideurl($str) {

	return (isset($str)) ? filter_var($str, FILTER_VALIDATE_URL) : false;
	
}

function validefloat($str) {

	return (isset($str)) ? filter_var($str, FILTER_VALIDATE_FLOAT) : false;
	
}

function valideip($str) {

	return (isset($str)) ? filter_var($str, FILTER_VALIDATE_IP) : false;
	
}

function validemail($str) {

	return (isset($str)) ? filter_var($str, FILTER_VALIDATE_EMAIL) : false;
	
}

function time_type($type){
	global $db;
	return $type = $db->getOne("SELECT `time` FROM `tb_time` WHERE `type` = ?i", $type);
	
}

function time_type_fab_p($type){
	global $db;
	return $type = $db->getOne("SELECT `time` FROM `tb_time_fabp` WHERE `type` = ?i", $type);
	
}

function time_type_fab_b($type){
	global $db;
	return $type = $db->getOne("SELECT `time` FROM `tb_time_fabblin` WHERE `type` = ?i", $type);
	
}

function time_type_prod($type){
	global $db;
	return $type = $db->getOne("SELECT `time` FROM `tb_time_prod` WHERE `type` = ?i", $type);
	
}

function pole_class($user, $pole) {
global $db;
$sql = $db->query("SELECT `type`, `time`, `udob`, `pay` FROM `tb_pole` WHERE `username` = ?s AND `num` = ?i", $user, $pole);
if($db->numRows($sql) >= 0) {
$row = $db->fetch($sql);
if($row["type"] == 0 AND $row["pay"] == 0) {
return $class = "pole_kupite";
}
if($row["type"] == 0 AND $row["pay"] == 1){
return $class = "pole_img";
}
$time_type = time_type($row["type"]);
if($row["udob"] == 1) {
if($row["time"] > (time() - ($time_type * 0.5))){
return $class = "udobreno".$row["type"];
}
if($row["time"] <= (time() - ($time_type * 0.5))){
return $class = "gotovo".$row["type"];
}
}else{
if($row["time"] > (time() - $time_type)) {
return $class = "posadil".$row["type"];
}
if($row["time"] <= (time() - $time_type)) {
return $class = "gotovo".$row["type"];
}
}
}else{
return $class = "pole_kupit";
}
}



function fab_class($user, $pole) {
global $db;
$sql = $db->query("SELECT * FROM `tb_fabrika` WHERE `username` = ?s AND `num` = ?i", $user, $pole);
if($db->numRows($sql) >= 0) {
$row = $db->fetch($sql);
if($row["type"] == 0 AND $row["pay"] == 0) {
return $class = "pole_kupite";
}
if($row["type"] > 0 AND $row["pay"] == 1){
return $class = "fabrika1";
}
//$time_type = time_type_fab_p($row["type"]);
}else{
return $class = "";
}
}




function sobrati($user, $pole) {
global $db;
$sql = $db->query("SELECT * FROM `tb_fabrika` WHERE `username` = ?s AND `num` = ?i", $user, $pole);
if($db->numRows($sql) == 1) {
$row = $db->fetch($sql);
$time_type = time_type_fab_p($row["type"]);
if($row["time"] > (time() - $time_type)) {
return $class = "<span title=\"Продукты перерабатываются!\" class=\"kol_kormlen\">0</span>";
}elseif($row["time"] <= (time() - $time_type) and $row["time"] != 0) {
return $class = '<span title="Продукты переработаны!" class="kol_product">200</span>';
}elseif($row["time"] == 0) {
return $class = '<span title="Ничего не перерабатывается!" class="kol_golodaet">0</span>';
}
}else{
return $class = "";
}

}




function fab_blin_class($user, $pole) {
global $db;
	$sql = $db->query("SELECT * FROM `tb_fabrika_blin` WHERE `username` = ?s AND `num` = ?i", $user, $pole);
	
		if($db->numRows($sql) >= 0) {
		
			$row = $db->fetch($sql);
			
				if($row["type"] == 0 AND $row["pay"] == 0) {
				
					return $class = "pole_kupite";
					
				}
				
				if($row["type"] > 0 AND $row["pay"] == 1){

					return $class = "fabrika1";
					
				}
				
					//$time_type = time_type_fab_b($row["type"]);
					
		}else{
		
			return $class = "";
			
		}
		
}




function sobrati_blin($user, $pole) {
global $db;
	$sql = $db->query("SELECT * FROM `tb_fabrika_blin` WHERE `username` = ?s AND `num` = ?i", $user, $pole);
	
		if($db->numRows($sql) == 1) {
		
			$row = $db->fetch($sql);
			
				$time_type = time_type_fab_b($row["type"]);
				
					if($row["time"] > (time() - $time_type)) {
					
						return $class = "<span title=\"Продукты перерабатываются!\" class=\"kol_kormlen\">0</span>";
						
					}elseif($row["time"] <= (time() - $time_type) and $row["time"] != 0) {
					
						return $class = '<span title="Продукты переработаны!" class="kol_product">200</span>';
						
					}elseif($row["time"] == 0) {
					
						return $class = '<span title="Ничего не перерабатывается!" class="kol_golodaet">0</span>';
						
					}
					
		}else{
		
			return $class = "";
			
		}

}



//Вывод курятников
function kur_class($user, $pole, $type_zagon) {
global $db;
	if($type_zagon == 1) { $stil1 = ' zagon1';}
	if($type_zagon == 2) { $stil1 = ' zagon2';}
	if($type_zagon == 3) { $stil1 = ' zagon3';}
	if($type_zagon == 4) { $stil1 = ' zagon4';}
	if($type_zagon == 5) { $stil1 = ' zagon5';}
	if($type_zagon == 6) { $stil1 = ' zagon6';}
$sql = $db->query("SELECT * FROM `tb_zagon` WHERE `login` = ?s AND `type` = ?i AND `num` = ?i", $user, $type_zagon, $pole);
if($db->numRows($sql) > 0) {
$row = $db->fetch($sql);
if($row["type"] == 0 AND $row["pay"] == 0) {
return $class = "pole_kupite";
}
if($row["type"] > 0 AND $row["pay"] == 1){
return $class = $stil1;
}
//$time_type = time_type_fab_b($row["type"]);
}else{
return $class = "pole_kupite";
}
}




function sobrati_kur($user, $pole, $type_zagon) {
global $db;
	$sql = $db->query("SELECT `id` FROM `tb_zagon_id` WHERE `login` = ?s AND `zagon_id` = ?i AND `type` = ?i", $user, $pole, $type_zagon);
	
	$sw = $db->query("SELECT `pay` FROM `tb_zagon` WHERE `login` = ?s AND `num` = ?i AND `type` = ?i", $user, $pole, $type_zagon);
	
	$fetch = $db->fetch($sw);
	
		if($db->numRows($sql) == 0 and $fetch['pay'] == 1) {
		
			return $class = "<span title=\"!\" class=\"kol_non\">0</span>";
			
		}elseif($db->numRows($sql) > 0 and $fetch['pay'] == 1){
		
			$sql = $db->query("SELECT id FROM `tb_zagon_id` WHERE `login` = ?s AND `zagon_id` = ?i AND `type` = ?i AND `korm` = 0 AND `status` = 1", $user, $pole, $type_zagon);
			
			if($db->numRows($sql) == 0){
			
				$q = time() - 50;
				
				$sqll = $db->query("SELECT id FROM `tb_zagon_id` WHERE `login` = ?s AND `zagon_id` = ?i AND `type` = ?i AND `date_korm` < ?s AND `korm` = 1 AND `status` = 1", $user, $pole, $type_zagon, $q);
				
					if($db->numRows($sqll) > 0) {
					
						return $class = "<span title=\"!\" class=\"kol_product\">".$db->numRows($sqll)."</span>";
						
					}else{
					
						$q = time() - 50;
						
						$sqllq = $db->query("SELECT id FROM `tb_zagon_id` WHERE `login` = ?s AND `zagon_id` = ?i AND `type` = ?i AND `date_korm` > ?s AND `korm` = 1 AND `status` = 1", $user, $pole, $type_zagon, $q);
						
						return $class = "<span title=\"!\" class=\"kol_kormlen\">".$db->numRows($sqllq)."</span>";
						
					}
					
			}else{
			
			return $class = "<span title=\"!\" class=\"kol_golodaet\">".$db->numRows($sql)."</span>";
			
			}
			
		}else{
			return $class = "";
		}


}

function count_page_zagon($num, $type)
{
	switch($type)
	{
		case '1' :
			$first = 9;
			$sub = 0;
			break;
		case '2' :
			$first = 13;
			$sub = 4;
			break;
		case '3' :
			$first = 18;
			$sub = 9;
			break;
		case '4' :
			$first = 23;
			$sub = 14;
			break;
		case '5' :
			$first = 28;
			$sub = 19;
			break;
		case '6' :
			$first = 33;
			$sub = 24;
			break;			
	}
	
	$pages = ($num - $sub) / 9;
	$page = ceil($pages);
	
	return $page;
}

function kura_href($login, $i, $type_zagon) {
global $db;
switch($type_zagon) {
	case 1: $url = '/newproduct/id_kur'; break;
	case 2: $url = '/svin/id_svin'; break;
	case 3: $url = '/ovta/id_ovta'; break;
	case 4: $url = '/korova/id_karova'; break;
	case 5: $url = '/lama/id_lama'; break;
	case 6: $url = '/slon/id_slon'; break;
}
	$sql = $db->query("SELECT * FROM `tb_zagon` WHERE `num` = ?i AND `type` = ?i AND login = ?s", $i, $type_zagon, $login);
		if($db->numRows($sql) > 0) {
			return $class = '<a href="'.$url.'/'.$i.'"><div class="click_div"></div></a>';
		}else{
			return $class = "<div class=\"click_div\" onclick=\"pay_pol('$i', '$type_zagon');\"></div>";
		}

}



function kur_by($id_kurat, $login, $id_kur, $type_zagon) {
global $db;
//switch($type_zagon) {
	if($type_zagon == 1) { $stil1 = ' zagon1animal1'; $stil2 = ' zagon1animal2'; $stil3 = ' zagon1animal3'; }
	if($type_zagon == 2) { $stil1 = ' zagon2animal1'; $stil2 = ' zagon2animal2'; $stil3 = ' zagon2animal3'; }
	if($type_zagon == 3) { $stil1 = ' zagon3animal1'; $stil2 = ' zagon3animal2'; $stil3 = ' zagon3animal3'; }
	if($type_zagon == 4) { $stil1 = ' zagon4animal1'; $stil2 = ' zagon4animal2'; $stil3 = ' zagon4animal3'; }
	if($type_zagon == 5) { $stil1 = ' zagon5animal1'; $stil2 = ' zagon5animal2'; $stil3 = ' zagon5animal3'; }
	if($type_zagon == 6) { $stil1 = ' zagon6animal1'; $stil2 = ' zagon6animal2'; $stil3 = ' zagon6animal3'; }
//}
$sql = $db->query("SELECT * FROM tb_zagon_id WHERE login = ?s AND zagon_id = ?i AND `type` = ?i AND `num` = ?i", $login, $id_kurat, $type_zagon, $id_kur);
if($db->numRows($sql) > 0) {
$kur = $db->fetch($sql);
if($kur['status'] != 1) {
return $class = ' pol_sadit';
}

if($kur['status'] == 1 and $kur['date_korm'] == 0) {
return $class = $stil1;
}


if($kur['status'] == 1 and $kur['date_korm'] >= time() and $kur['date_korm'] > 0) {
return $class = $stil2;
}

if($kur['status'] == 1 and $kur['date_korm'] <= time() and $kur['date_korm'] > 0) {
return $class = $stil3;
}


}else{
return $class = ' pol_sadit';
}


}



/*======================================================================*\
	Function:	IsLogin
	Output:		True / False
	Input:		Строка логина, Маска, Длина ("10, 25") && ("10") 
	Descriiption: Проверяет правильность ввода логина
	\*======================================================================*/
	function IsLogin($login, $mask = "^[a-zA-Z0-9]", $len = "{4,10}"){
		
		return (is_array($login)) ? false : (preg_match("/{$mask}{$len}$/", $login)) ? $login : false;
	
	}
	
	
	/*======================================================================*\
	Function:	IsPassword
	Output:		True / False
	Input:		Строка пароля, Маска, Длина ("10, 25") && ("10") 
	Descriiption: Проверяет правильность ввода пароля
	\*======================================================================*/
	function IsPassword($password, $mask = "^[a-zA-Z0-9]", $len = "{4,20}"){
		
		return (is_array($password)) ? false : (preg_match("/{$mask}{$len}$/", $password)) ? $password : false;
	
	}
	
	
	/*======================================================================*\
	Function:	IsMail
	Output:		True / False
	Input:		Email 
	Descriiption: Проверяет правильность ввода email адреса
	\*======================================================================*/
	function IsMail($mail){
		
		if(is_array($mail) && empty($mail) && strlen($mail) > 255 && strpos($mail,'@') > 64) return false;
			return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $mail)) ? false : strtolower($mail);
			
	}
	
	
	/*======================================================================*\
	Function:	TextClean
	Descriiption: Очистка текста
	\*======================================================================*/
	function TextClean($text){
		
		$array_find = array("`", "<", ">", "^", '"', "~", "\\");
		$array_replace = array("&#96;", "&lt;", "&gt;", "&circ;", "&quot;", "&tilde;", "");
		
		
		
		return str_replace($array_find, $array_replace, $text);
		
	}
	
	/*======================================================================*\
	Function:	md5Password
	Descriiption: Возвращает md5_пароля
	\*======================================================================*/
	function md5Password($pass){
		$pass = strtolower($pass);
		return md5("http://wmrush.name"."-hfhTGE^EBFndfhskhdskfdsfds-".$pass);
		
	}
?>