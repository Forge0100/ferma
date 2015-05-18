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
			
				case "404": include("pages/_404.php"); break; // �������� ������
				case "login": include("pages/_login.php"); break; // �������� ������
				case "stats": include("pages/_stats.php"); break; // �������� ������
				case "price_by": include("pages/_price_by.php"); break; // �������� ������
				case "price_sell": include("pages/_price_sell.php"); break; // �������� ������
				case "price_lavka": include("pages/_price_lavka.php"); break; // �������� ������
				case "set_site": include("pages/_set_site.php"); break; // �������� ������
				case "gifts": include("pages/_gifts.php"); break; // �������� ������
				case "users": include("pages/_users.php"); break; // �������� ������
				case "time": include("pages/_time.php"); break; // �������� ������
				case "news": include("pages/_news.php"); break; // �������� ������
				case "page": include("pages/_page.php"); break; // �������� ������
				#case "stat_enter": include("pages/_stat_enter.php"); break; // �������� ������
				case "stat_vivod": include("pages/_stat_vivod.php"); break; // �������� ������
				case "vivod": include("pages/_vivod.php"); break; // �������� ������
				case "support": include("pages/_support.php"); break; // �������� ������
				case "action": include("pages/_action.php"); break; // �������� ������
				case "stat_pop": include("pages/_stat_pop.php"); break; // �������� ������
				case "pay_stats": include("pages/_pay_stats.php"); break; // �����
				case "plat": include("pages/_plat.php"); break; // �������� ������
				case "energy": include("pages/_energy.php"); break; // �������� ������
				case "exit": @session_destroy(); Header("Location: /adminka/login"); return; break; // �����
				case "exchange": include("pages/_exchange.php"); break;
				
				
			# �������� ������
			default: @include("pages/_404.php"); break;
			
			}
			
}else @include("pages/_stats.php");

require_once ("blocks/foot.php");
?>