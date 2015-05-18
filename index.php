<?php
//ini_set('display_errors',1);
error_reporting(E_ALL);
ob_start();
session_start();
Header("Content-Type: text/html;charset=UTF-8");
$start_time = microtime();

// ðàçäåëÿåì ñåêóíäû è ìèëëèñåêóíäû (ñòàíîâÿòñÿ çíà÷åíèÿìè íà÷àëüíûõ êëþ÷åé ìàññèâà-ñïèñêà)

$start_array = explode(" ",$start_time);

// ýòî è åñòü ñòàðòîâîå âðåìÿ

$start_time = $start_array[1] + $start_array[0];
require_once($_SERVER['DOCUMENT_ROOT']."/data/conn_file.php");
require_once($_SERVER['DOCUMENT_ROOT']."/data/func.php");
require_once($_SERVER['DOCUMENT_ROOT']."/class/libmail.php");
// require_once($_SERVER['DOCUMENT_ROOT']."/ferma/data/conn_file.php");
// require_once($_SERVER['DOCUMENT_ROOT']."/ferma/data/func.php");
// require_once($_SERVER['DOCUMENT_ROOT']."/ferma/class/libmail.php");
if(isset($_GET['rid'])) {
$ridd = intval($_GET['rid']);
setcookie("rid",$ridd,time()+2592000);
}
if (isset($_SESSION['id'])) {

}

//if($_SERVER['REMOTE_ADDR'] == '146.158.108.12')
//{
//	
//}

require_once ("theme/header.php");

if(isset($_GET["menu"])){
		
			$menu = strval($_GET["menu"]);
			
			switch($menu){
			
				case "404": include("pages/_404.php"); break; // Ñòðàíèöà îøèáêè
				case "account": include("pages/_account.php"); break; // Ñòðàíèöà îøèáêè
				case "reg": include("pages/_reg.php"); break; // Ñòðàíèöà îøèáêè
				case "pole": include("pages/_pole.php"); break; // Ñòðàíèöà îøèáêè
				case "logout": include("pages/_logout.php"); break; // Ñòðàíèöà îøèáêè
				case "lavka": include("pages/_lavka.php"); break; // Ñòðàíèöà îøèáêè
				case "rinok": include("pages/_rinok.php"); break; // Ñòðàíèöà îøèáêè
				case "magazin": include("pages/_magazin.php"); break; // Ñòðàíèöà îøèáêè
				case "blinaya": include("pages/_blinaya.php"); break; // Ñòðàíèöà îøèáêè
				case "fabrika": include("pages/_fabrika.php"); break; // Ñòðàíèöà îøèáêè
				case "fabrika_blincik": include("pages/_fabrika_blincik.php"); break; // Ñòðàíèöà îøèáêè
				case "newproduct": include("pages/_newproduct.php"); break; // Ñòðàíèöà îøèáêè
				case "svin": include("pages/_svin.php"); break; // Ñòðàíèöà îøèáêè
				case "ovta": include("pages/_ovta.php"); break; // Ñòðàíèöà îøèáêè
				case "korova": include("pages/_korova.php"); break; // Ñòðàíèöà îøèáêè
				case "lama": include("pages/_lama.php"); break; // Ñòðàíèöà îøèáêè
				case "slon": include("pages/_slon.php"); break; // Ñòðàíèöà îøèáêè
				case "profile": include("pages/_profile.php"); break; // Ñòðàíèöà îøèáêè
				case "plat_pass": include("pages/_plat_pass.php"); break; // Ñòðàíèöà îøèáêè
				case "re_pass": include("pages/_re_pass.php"); break; // Ñòðàíèöà îøèáêè
				case "sclad": include("pages/_sclad.php"); break; // Ñòðàíèöà îøèáêè
				case "error_login": include("pages/_error_login.php"); break; // Ñòðàíèöà îøèáêè
				case "ref": include("pages/_ref.php"); break; // Ñòðàíèöà îøèáêè
				case "reflink": include("pages/_reflink.php"); break; // Ñòðàíèöà îøèáêè
				case "wall": include("pages/_wall.php"); break; // Ñòðàíèöà îøèáêè
				case "pm": include("pages/_pm.php"); break; // Ñòðàíèöà îøèáêè
				case "chat": include("pages/_chat.php"); break; // Ñòðàíèöà îøèáêè
				case "online": include("pages/_online.php"); break; // Ñòðàíèöà îøèáêè
				case "bonus": include("pages/_bonus.php"); break; // Ñòðàíèöà îøèáêè
				case "perevod": include("pages/_perevod.php"); break; // Ñòðàíèöà îøèáêè
				case "convert": include("pages/_convert.php"); break; // Ñòðàíèöà îøèáêè
				case "vivod": include("pages/_vivod.php"); break; // Ñòðàíèöà îøèáêè
				case "popoln": include("pages/_popoln.php"); break; // Ñòðàíèöà îøèáêè
				case "gifts": include("pages/_gifts.php"); break; // Ñòðàíèöà îøèáêè
				case "news": include("pages/_news.php"); break; // Ñòðàíèöà îøèáêè
				case "top100": include("pages/_top100.php"); break; // Ñòðàíèöà îøèáêè
				case "faq": include("pages/_faq.php"); break; // Ñòðàíèöà îøèáêè
				case "faq2": include("pages/_faq2.php"); break; // Ñòðàíèöà îøèáêè
				case "about": include("pages/_about.php"); break; // Ñòðàíèöà îøèáêè
				case "otzyvy": include("pages/_otzyvy.php"); break; // Ñòðàíèöà îøèáêè
				case "poslednie_vyplaty": include("pages/_poslednie_vyplaty.php"); break; // Ñòðàíèöà îøèáêè
				case "support": include("pages/_support.php"); break; // Ñòðàíèöà îøèáêè
				case "action": include("pages/_action.php"); break; // Ñòðàíèöà îøèáêè
				case "statistics": include("pages/_statistic.php"); break; // Ñòðàíèöà îøèáêè
				case "tos": include("pages/_tos.php"); break; // Ñòðàíèöà îøèáêè
				case "remind": include("pages/_remind.php"); break; // Ñòðàíèöà îøèáêè
				case "history": include("pages/_history.php"); break; // Ñòðàíèöà îøèáêè
				case "exchange": include("pages/_exchange.php"); break;
				case "auth": include("pages/_auth.php"); break;
				case "payeer": include("oplata/payeer/status"); break;
				case "success_query": include("pages/_success_query.php"); break;
				case "fail_query": include("pages/_fail_query.php"); break;
			# Ñòðàíèöà îøèáêè
			default: include("pages/_404.php"); break;
			
			}
			
}else include("pages/_index.php");




require_once ("theme/footer.php");
?>
