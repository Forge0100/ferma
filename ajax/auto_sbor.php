<?php
session_start();
error_reporting (1);
$login = $_SESSION['login'];
$usid = $_SESSION['id'];
header('Content-type: application/json');
Header("Content-Type: text/html;charset=UTF-8");
require 'sbor_func.php';

if(!isset($_SESSION['id'])) die();
$a = $_POST['action'];
$cat = $_POST['cat'];
switch ($a) 
{
	case 'sbor':
		echo json_encode(DoSbor($usid,$cat));
	break;

	case 'buy':
		echo json_encode(DoBuy($usid,$cat));
	break;
	
	default:
		echo json_encode($_POST);
	break;
}



