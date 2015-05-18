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
$semena = valideint($_POST["kuraid"]);
// данные пользователя
$row = $db->getRow("SELECT * FROM `tb_users` WHERE `username` = ?s", $login);
$money = $row["chat_status"];


if($money == 1 or $money == 2) {
$db->query("DELETE FROM tb_chat WHERE id = ?i", $semena);
echo json_encode($result = array("typeu" => "success", "message" => "Сообщение удалено"));exit();
}


}

if($_POST['func'] == 'ban') {

if(!isset($_SESSION['id'])) {echo json_encode($result = array("typeu" => "error", "message" => "Сессия устарела! Обновите страницу!")); exit();}
$semena = valideint($_POST["kuraid"]);
// данные пользователя
$row = $db->getRow("SELECT * FROM `tb_users` WHERE `username` = ?s", $login);
$money = $row["chat_status"];


//if($money == 1 or $money == 2) {
$db->query("UPDATE `tb_users` SET `chat_status` = '5' WHERE `id` = ?i", $semena);
echo json_encode($result = array("typeu" => "success", "message" => "Пользователь забанен в чате!"));exit();
//}


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