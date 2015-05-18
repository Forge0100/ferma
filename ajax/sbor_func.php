<?php
require 'config_db.php';
require 'class.db.php';
require 'sbor_js.php';

$db = db::getInstance();

function test()
{
	global $db;
	return $db->getRow("select * from `tb_action` where `id`=1");
}


function UpdateInfo($user)
{
	global $db;
	$db->query('update `a_btn_users` set `status`= 0 where `id_user`=?i and (DATE_ADD(`buy_date`, interval 30 DAY)<NOW()=1)', $user);
}


function check_access($user, $type)
{
	global $db;
	UpdateInfo($user);
	return $db->getOne("select `id` from `a_btn_users` where 
		`id_user`=?i and 
		`buy_type`=?s and 
		`status`=1", $user,$type);
}


function get_price($val)
{
	switch ($val) 
	{
		case 'pole':
			return 10;
			break;
		
		case 'kur':
			return 50;
			break;

		case 'svin':
			return 100;
			break;	

		case 'ovc':
			return 200;
			break;
		
		case 'kor':
			return 400;
			break;

		case 'lam':
			return 500;
			break;	

		case 'slon':
			return 60;
			break;	

		default:
			return 0;
			break;
	}
}


function GetUserNick($user)
{
	global $db;
	return $db->getOne("select `username` from `tb_users` where `id`=?i ", $user);
}

function GetUserMoney($user)
{
	global $db;
	return $db->getOne("select `money` from `tb_users` where `id`=?i ", $user);
}

function GetUserEnerg($user)
{
	global $db;
	return $db->getOne("select `energy` from `tb_users` where `id`=?i ", $user);
}

function DoBuy($user, $type)
{
	global $db;
	$arr = array();
	$arr['err'] = "";
	$price = get_price($type);
	$money = GetUserMoney($user);
	$energ = GetUserEnerg($user);

	if ($energ<1000)
	{
		$arr['err'] = "Недостаточно энергии для покупки !";
		return $arr;
	}

	if ($money<$price)
	{
		$arr['err'] = "Недостаточно денег для покупки !";
		return $arr;
	}

	$db->query('insert into `a_btn_users` 
		(`id_user`, `buy_type`, `buy_date`, `status`)
		values (?i, ?s, NOW(), 1)', $user, $type);
	$db->query("update `tb_users` set `money` = `money` - ?i, `energy` = `energy` - 1000 
		where `id` = ?i", $price, $user);
	$db->query("update `tb_users` set `money` = `money` + ?i where `id` = 1", $price);
	$arr['msg'] = "Услуга успешно установлена";
	return $arr;
}

function DoSbor($user, $type)
{
	$arr = array();
	$arr['err'] = "";
	if (check_access($user, $type)==false)
	{
		$arr['err'] = 'Данная услуга недоступна, т.к. ещё не куплена<br>';
		$arr['err'] .= "цена на 30 дней составляет: ".get_price($type)." рублей и 1000 энергии";
		return $arr;
	}
	$arr['msg'] = "Собираем / кормим";
	switch ($type) 
	{
		case 'pole':
			$arr['msg'] = "Собираем / сеем";
			$arr['js'] = GetJS_pole();
			break;


		case 'kur':
			$arr['js'] = str_replace("%TYPE%", "1", GetJS_JIV());
			break;

		case 'svin':
			$arr['js'] = str_replace("%TYPE%", "2", GetJS_JIV());
			break;

		case 'ovc':
			$arr['js'] = str_replace("%TYPE%", "3", GetJS_JIV());
			break;

		case 'kor':
			$arr['js'] = str_replace("%TYPE%", "4", GetJS_JIV());
			break;

		case 'lam':
			$arr['js'] = str_replace("%TYPE%", "5", GetJS_JIV());
			break;

		case 'slon':
			$arr['js'] = str_replace("%TYPE%", "6", GetJS_JIV());
			break;
		
		default:
			# code...
			break;
	}
		
	return $arr;
}



/*
function mtime_type($type)
{
	global $db;
	return $db->getOne("SELECT `time` FROM `tb_time` WHERE `type` = ?i"),$type);
}


function DoSborPole($user)
{
	$nick = GetUserNick($user);
	$poles = $db->getAll("SELECT * FROM `tb_pole` WHERE  `type`>0 and  `username` = ?s", $nick);
	foreach ($poles as $pole) 
	{
		if($pole["udob"] == 1) 
			$fin_time = mtime_type($pole["type"]) * 0.5;
		else
			$fin_time = mtime_type($pole["type"]);


	$endtime = ($pole["time"]+$fin_time) - time();
	}
	
}
*/