<?php
ob_start();
session_start();
Header("Content-Type: text/html;charset=UTF-8");

require_once($_SERVER['DOCUMENT_ROOT']."/data/conn_file.php");
require_once($_SERVER['DOCUMENT_ROOT']."/data/func.php");
	
require_once ("blocks/head.php");
#SetCookie("dle_user_id",$_SESSION['id'],time()+3600,'/');
if(!isset($_SESSION['adm'])) {
 include("pages/_login.php"); return;
	}
if(isset($_GET["menu"])){
		
			$menu = strval($_GET["menu"]);
			
			switch($menu){
			
				case "404": include("pages/_404.php"); break; // Страница ошибки
				case "login": include("pages/_login.php"); break; // Страница ошибки
				case "stats": include("pages/_stats.php"); break; // Страница ошибки
				case "price_by": include("pages/_price_by.php"); break; // Страница ошибки
				case "price_sell": include("pages/_price_sell.php"); break; // Страница ошибки
				case "price_lavka": include("pages/_price_lavka.php"); break; // Страница ошибки
				case "set_site": include("pages/_set_site.php"); break; // Страница ошибки
				case "gifts": include("pages/_gifts.php"); break; // Страница ошибки
				case "users": include("pages/_users.php"); break; // Страница ошибки
				case "time": include("pages/_time.php"); break; // Страница ошибки
				case "news": include("pages/_news.php"); break; // Страница ошибки
				case "page": include("pages/_page.php"); break; // Страница ошибки
				#case "stat_enter": include("pages/_stat_enter.php"); break; // Страница ошибки
				case "stat_vivod": include("pages/_stat_vivod.php"); break; // Страница ошибки
				case "vivod": include("pages/_vivod.php"); break; // Страница ошибки
				case "support": include("pages/_support.php"); break; // Страница ошибки
				case "action": include("pages/_action.php"); break; // Страница ошибки
				case "stat_pop": include("pages/_stat_pop.php"); break; // Страница ошибки
				case "pay_stats": include("pages/_pay_stats.php"); break; // БЛЯТЬ
				case "plat": include("pages/_plat.php"); break; // Страница ошибки
				case "energy": include("pages/_energy.php"); break; // Страница ошибки
				case "exit": @session_destroy(); Header("Location: /adminka/login"); return; break; // Выход
				case "exchange": include("pages/_exchange.php"); break;
				
				
			# Страница ошибки
			default: @include("pages/_404.php"); break;
			
			}
			
}else @include("pages/_stats.php");

require_once ("blocks/foot.php");
?>