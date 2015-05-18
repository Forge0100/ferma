<?php
function sf($str){
	return mysql_real_escape_string(strip_tags(htmlspecialchars($str))); 
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
return $type = mysql_result(mysql_query("SELECT `time` FROM `tb_time` WHERE `type` = '$type'"),0);
}

function pole_class($user, $pole) {
$sql = mysql_query("SELECT `type`, `time`, `udob`, `pay` FROM `tb_pole` WHERE `username` = '$user' AND `num` = '$pole'");
if(mysql_num_rows($sql) >= 0) {
$row = mysql_fetch_assoc($sql);
if($row["type"] == 0 AND $row["pay"] == 0) {
return $class = "pole_kupite";
}
if($row["type"] == 0 AND $row["pay"] == 1){
return $class = "newpole_img";
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
$sql = mysql_query("SELECT `type`, `time`, `udob`, `pay` FROM `tb_fabrika` WHERE `username` = '$user' AND `num` = '$pole'");
if(mysql_num_rows($sql) >= 0) {
$row = mysql_fetch_assoc($sql);
if($row["type"] == 0 AND $row["pay"] == 0) {
return $class = "fabrika1";
}
if($row["type"] == 0 AND $row["pay"] == 1){
return $class = "fabrika1";
}
$time_type = time_type($row["type"]);
if($row["udob"] == 1) {
if($row["time"] > (time() - ($time_type * 1))){
return $class = "udobreno".$row["type"];
}
if($row["time"] <= (time() - ($time_type * 1))){
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