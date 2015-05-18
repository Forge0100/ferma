<?PHP
ob_start();
session_start();
Header("Content-Type: text/html;charset=UTF-8");

require_once($_SERVER['DOCUMENT_ROOT']."/data/conn_file.php");
require_once($_SERVER['DOCUMENT_ROOT']."/data/func.php");
$msg_file = "mesage.dat";//Файл где хронятся сообщения
$msg_count = "50"; //Число сообщений в чате
$msg_xron = "100";//Число сообщений в хронилище
?>