<?php
if (isset($_SESSION['id'])) {
$usid = $_SESSION['id'];
$login = $_SESSION['login'];
$us_data = $db->getRow("SELECT * FROM tb_users WHERE id = ?i AND username = ?s", $usid, $login);

//цены
$row = $db->getRow("SELECT * FROM `tb_price`");

$price_kurat = $row['price_kuratnik'];
$price_slovovik = $row['price_slon'];
$price_ovta = $row['price_ovta'];
$price_korova = $row['price_karova'];
$price_svin = $row['price_svin'];
$price_lama = $row['price_lama'];
include_once ("data/opit.php");
if($us_data['pol'] == 1) { $pol_u = 'male.png'; $tile = 'Муж';}
elseif($us_data['pol'] == 2)  { $pol_u = 'female.png'; $tile = 'Жен';}
else { $pol_u = 'male.png'; $tile = 'Муж';}
}
if( ! ini_get('date.timezone') )
{
date_default_timezone_set('Europe/Moscow');
}
$time_server=date("H:i:s",time());
$hours=date("H",time());
$minutes=date("i",time());
$seconds=date("s",time());
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
	<title>Ферма Друзья - Зарабатывай играя</title>
	<meta name="robots" content="all" />
	<meta name="revisit-after" content="1 days" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

	<link rel="stylesheet" href="/css/reset.css" type="text/css" />
	<link rel="stylesheet" href="/css/style.css" type="text/css" />
	<link rel="stylesheet" href="/css/engine.css" type="text/css" />

	<script type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="/js/jquery.tinycarousel.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript">

		$(document).ready(function() {

			// Store variables
			
			var accordion_head = $('.accordion > li > a'),
				accordion_body = $('.accordion li > .sub-menu');

			// Open the first tab on load

			accordion_head.first().addClass('active').next().slideDown('normal');

			// Click function

			accordion_head.on('click', function(event) {

				// Disable header links
				
				event.preventDefault();

				// Show and hide the tabs on click

				if ($(this).attr('class') != 'active'){
					accordion_body.slideUp('normal');
					$(this).next().stop(true,true).slideToggle('normal');
					accordion_head.removeClass('active');
					$(this).addClass('active');
				}

			});

		});

	</script>

	<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>

	<script type="text/javascript">
		function menu_func(menuid){
		 $('#' + menuid + ' ul li a').each(function () { 
		  var position = window.location.href; 
		  var thisTab = this.href; 
		 
		  var thisTabHahs = window.location.hash; 
		  var thisSearch = window.location.search;
		  
		   if(position == thisTab || position == thisTab + thisTabHahs || position == thisTab + thisSearch ){
			$(this).addClass('current');}
		  });
		 }
		 
		$(document).ready(function(){
			$('.menuhid').click(function(){
				$(this).next('#menuhid-hidden').slideToggle();
				$(this).toggleClass('menuopen');
			});
			menu_func('menu3');
			menu_func('menu3x');
		  var divParent = $('#menu3x ul').find('.current').parent().parent();
		  var isDivParent = divParent.is("#menuhid-hidden");
		  if (isDivParent) {
			divParent.fadeIn(1);
			divParent.prev().toggleClass('menuopen');
		  }
		});
	</script>
</head>

<body>
<div class="bg">
<ul class="backheader">
<li class="backheaderli1">
						

									<?php
										//Stat site
										$qs = $db->numRows($db->query("SELECT * FROM tb_users"));
										$t = time() - 86400;
										$ws = $db->numRows($db->query("SELECT * FROM tb_users WHERE date_reg >= '$t'"));
										$s = $db->numRows($db->query("SELECT DISTINCT ip, login, page FROM tb_online"));
										$d = $db->numRows($db->query("SELECT DISTINCT ip, login, page FROM tb_online WHERE login != 'Гость'"));
										$tt = $db->numRows($db->query("SELECT * FROM tb_vivod WHERE status = 1"));
										$ys = $db->getRow("SELECT SUM(summa_full) AS sum_v FROM tb_vivod WHERE status = 1");
										$q = $db->getRow("SELECT SUM(kol) AS q1 FROM tb_stat_z WHERE type = 1");
										$q1 = $db->getRow("SELECT SUM(kol) AS q2 FROM tb_stat_z WHERE type = 2");
										$q3 = $db->getRow("SELECT SUM(kol) AS q3 FROM tb_stat_z WHERE type = 3");
										$q4 = $db->getRow("SELECT SUM(kol) AS q4 FROM tb_stat_z WHERE type = 4");
										$q5 = $db->getRow("SELECT SUM(kol) AS q5 FROM tb_stat_z WHERE type = 5");
										$q6 = $db->getRow("SELECT SUM(kol) AS q6 FROM tb_stat_z WHERE type = 6");
										$w = $db->getRow("SELECT * FROM tb_stat_and ORDER BY id DESC LIMIT 1");
										$y = $db->getRow("SELECT * FROM tb_stat_full");
										$r = $db->getRow("SELECT SUM(summa_full) AS sum_v FROM tb_vivod WHERE status = 1");
										$rr = $db->getRow("SELECT SUM(amount) AS sum_p FROM tb_pay_stats");
										$p = $db->getRow("SELECT * FROM tb_conf_site WHERE id = 1");
										$rez = $db->getRow("SELECT * FROM tb_lavka WHERE id = 1");
									?>
									<script type="text/javascript">
										function server_time()
										{
											var Hours = document.getElementById('Server_hours').value;
											var Minutes = document.getElementById('Server_minutes').value;
											var Seconds = document.getElementById('Server_seconds').value;

											if(Seconds < 59){
												Seconds++;
												if(Seconds < 10) {Seconds = "0" + Seconds;}
											}else{
												Seconds = 0;
												if(Seconds < 10) {Seconds = "0" + Seconds;}
												if(Minutes < 59){
													Minutes++;
													if(Minutes < 10) {Minutes = "0" + Minutes;}
												}else{
													Minutes = 0;
													if(Minutes < 10) {Minutes = "0" + Minutes;}
													if(Hours < 23){
														Hours++;
														if(Hours < 10 ) {Hours = "0" + Hours;}
													}else{
														Hours = 0;
														if(Hours < 10 ) {Hours = "0" + Hours;}
													}
												}
											}
											
											document.getElementById('Server_hours').value = Hours;
											document.getElementById('Server_minutes').value = Minutes;
											document.getElementById('Server_seconds').value = Seconds;
											var servertime = Hours + ":" + Minutes + ":" + Seconds;
											document.getElementById('server_time').innerHTML = servertime;
											setTimeout(function(){server_time()},1000);	
										}
										function show_menu(e_id) {
											var obj = document.getElementById(e_id); 
											if (obj.style.display != "block") { 
												obj.style.display = "block"; 
											}
											else obj.style.display = "none"; 
										}   
									</script>
									<div width="70%" style="text-align:left;margin-left:2%; color:#fff;">
										<p><h2 style="color: #fff;font-size: 30px;">СТАТИСТИКА<h2></p>
										<b style="color:#fff;">Пользователей: <?=$qs;?> </b><span style="color:#fff;" title="Новых за сегодня">[+<b style="color:#fff;"><?=$ws; ?></b> новых]</span><br>
										<b style="color:#fff;">Выплат: </b><b style="color:#fff;"><?=$tt; ?></b><br>
										<b style="color:#fff;">Выплачено: </b><b style="color:#fff;"><?=$ys['sum_v']; ?> руб</b><br />
										<div style="margin-top: -10px;">
											<input id="Server_hours" value="<?=$hours?>" type="hidden">
											<input id="Server_minutes" value="<?=$minutes?>" type="hidden">
											<input id="Server_seconds" value="<?=$seconds?>" type="hidden">
										</div>
										<div style="margin-top: 4px;"></div>
										<b style="color:#fff;">На сайте:</b> <span style="color:#fff;" title='Онлайн'><?=$s;?></span> <span style="color:#fff;" title='Фермеров онлайн!'>(<?=$d;?>)</span> <a style="color:#fff;" title="Пользователи Online" href="/online/">[Кто?]</a><br />
<div>
											<input id="Server_hours" value="<?=$hours?>" type="hidden">
											<input id="Server_minutes" value="<?=$minutes?>" type="hidden">
											<input id="Server_seconds" value="<?=$seconds?>" type="hidden">
											<b style="color:#fff;">Время сервера: </b>
											<b style="color:#fff;" id="server_time"><?=$time_server?></b>
											<script> server_time(); </script>
										</div>
									</div>
									<br>
									
					
</li>
<li class="backheaderli2">

<center><br><p class="slogan" style="font-weight: bold;">Ферма друзья!</p><p class="slogan" style="font-weight: bold;">Мы не просто соседи, мы - друзья!</p></center>
</li>

<li class="backheaderli3">				


<?php if(!isset($_SESSION['id'])) : ?>

						<p><h3 style="color: #fff;">ВХОД&nbsp;В&nbsp;АККАУНТ</h3></p>
									<div id="login">
										<form action="/error_login" method="post">
											
													
													<p valign="top"><input type="text" name="user" placeholder="Логин"  maxlength="12"></p>
												
													<p valign="top"><input type="password" name="pass" placeholder="Пароль" maxlength="12"></p>
												
												<table>
												<tr>
												<td style="width:25%;">
													<input style="width:100%;" type="text" name="keystring" placeholder="Код" maxlength="10">
													</td>
													<td>
													<img style="width: 82px;height: 40px;border-bottom-right-radius: 4px;border-top-right-radius: 4px;" title="Если Вы не видите число на картинке, нажмите на картинку мышкой" onclick="this.src=this.src+'&amp;'+Math.round(Math.random())" src="../captcha.php?<?php echo session_name()?>=<?php echo session_id()?>">	</p>
													</td>
													</tr>
													</table>
													
													<table style="margin: 0 auto;">
													<tr>
													<td>
													<input type="submit" alt="" value="Вход" class="buttone" /></p>
												</td></tr>
												<tr><td>
													
														<a href="/remind/">Забыли пароль?</a>
												</td>
												</tr>
												</table>
										</form>

						
					</div>
					<?php else : include ('user.php'); endif; ?>
					
</li>
</ul>


	<div class="wrapper">
		<div class="wrapper-inner">

			<div class="top-menu-box">
				<div class="top-menu">

					<div id="menu3">

<script>
$(function () {
	var el = $('#nav_list_first li a');
	$('#nav_list_first li:has("ul")').append('<span></span>');		
	el.click(function() {
		var checkElement = $(this).next();	
		
		checkElement.stop().animate({'height':'toggle'}, 500).parent().toggleClass('active');
		if(checkElement.is('ul')) {
			return false;
		}		
	});
});
</script>

						<ul class="menuglav">
							<li style="width:15%;"><a style="border-radius: 5px;-webkit-transition: all 0.5s; -o-transition: all 0.5s; transition: all 0.5s;background-repeat: no-repeat;background: url(../img/Home-50.png) 0 6px no-repeat #5A8CFA;background-position: 10px -4px;" href="/">Главная</a></li>
							<li style="width:15%;"><a style="border-radius: 5px;-webkit-transition: all 0.5s; -o-transition: all 0.5s; transition: all 0.5s;background-repeat: no-repeat;background: url(../img/News-50.png) 0 6px no-repeat #5A8CFA;background-position: 9px 4px;" href="/news/">Новости</a></li>
							<?php if(isset($_SESSION['id'])) : ?>
							<li style="width:15%;"><a style="border-radius: 5px;-webkit-transition: all 0.5s; -o-transition: all 0.5s; transition: all 0.5s;background-repeat: no-repeat;background: url(../img/Bell-50.png) 0 6px no-repeat #5A8CFA;background-position: 9px 4px;" href="/otzyvy">Отзывы</a></li>
							<?php else : ?>
							<li style="width:15%; margin-right: 2.6%;"><a style="border-radius: 5px;-webkit-transition: all 0.5s; -o-transition: all 0.5s; transition: all 0.5s;background-repeat: no-repeat;background: url(../img/Reg-50.png) 0 6px no-repeat #5A8CFA;background-position: 9px 0px;" href="/reg">Регистрация</a></li>
							<?php endif; ?>
							<li style="width:15%;"><a style="border-radius: 5px;-webkit-transition: all 0.5s; -o-transition: all 0.5s; transition: all 0.5s;background-repeat: no-repeat;background: url(../img/Contacts-50.png) 0 6px no-repeat #5A8CFA;background-position: 9px 4px;" href="/faq/">Инструкция</a></li>
							<li style="width:15%;margin-left: 2.1%;"><a style="border-radius: 5px;-webkit-transition: all 0.5s; -o-transition: all 0.5s; transition: all 0.5s;background-repeat: no-repeat;background: url(../img/Info-50.png) 0 6px no-repeat #5A8CFA;background-position: 9px 1px;" href="/about/">FAQ</a></li>	
						</ul>
					
				</div>
				</div>
			</div>
			<div class="header-box">

<script>
$(document).ready(function() {
  $("[data-toggle]").click(function() {
    var toggle_el = $(this).data("toggle");
    $(toggle_el).toggleClass("open-sidebar");
  });
});
</script>
			
			</div>
			

				<div class="left-blocks">
					<div class="menu-box">	
					

</div>
									<?php if (isset($_SESSION['id']) and isset($_SESSION['login'])) : ?>      
									<div id="menu3x">
										<ul>
											<div> 
												<li style="margin-top: 0px;-webkit-transition: all 0.5s; -o-transition: all 0.5s; transition: all 0.5s;background-repeat: no-repeat;background: url(../img/Menu-50.png) 0 6px no-repeat #5A8CFA;background-position: 10px -4px;" class="menuhid">Пользователь -</li>
												<div id="menuhid-hidden" style="display: none;">
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/account/">&nbsp;&nbsp;&nbsp;&nbsp;Аккаунт</a></li>
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/profile/">&nbsp;&nbsp;&nbsp;&nbsp;Профиль</a></li>
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/wall/">&nbsp;&nbsp;&nbsp;&nbsp;Стена&nbsp;фермера</a></li>
												<?php $pim = mysql_num_rows(mysql_query("SELECT * FROM tb_pm_in WHERE user_id_1 = '$usid' AND status = 0")); ?>
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/pm/">&nbsp;&nbsp;&nbsp;&nbsp;Внутренняя&nbsp;почта <?php echo ($pim != '0') ? "(<font color='#fff'>$pim</font>)" : ""; ?></a></li>
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/history/">&nbsp;&nbsp;&nbsp;&nbsp;История</a></li>
												</div>
											</div>
											<li style="margin-top: 10px;-webkit-transition: all 0.5s; -o-transition: all 0.5s; transition: all 0.5s;background-repeat: no-repeat;background: url(../img/Menu-50.png) 0 6px no-repeat #5A8CFA;background-position: 10px -4px;" class="menuhid">Баланс -</li>
											<div id="menuhid-hidden" style="display: none;">
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/popoln/">&nbsp;&nbsp;&nbsp;&nbsp;Пополнить</a></li>
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/perevod/">&nbsp;&nbsp;&nbsp;&nbsp;Перевод</a></li>
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/convert/">&nbsp;&nbsp;&nbsp;&nbsp;Обменный&nbsp;пункт</a></li>
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/vivod/">&nbsp;&nbsp;&nbsp;&nbsp;Вывод</a></li>
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/poslednie_vyplaty/">&nbsp;&nbsp;&nbsp;&nbsp;Последние&nbsp;выплаты</a></li>
											</div>
																				
											<li style="margin-top: 10px;-webkit-transition: all 0.5s; -o-transition: all 0.5s; transition: all 0.5s;background-repeat: no-repeat;background: url(../img/Menu-50.png) 0 6px no-repeat #5A8CFA;background-position: 10px -4px;" class="menuhid">Игра -</li>
											<div id="menuhid-hidden" style="display: none;">
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/pole">&nbsp;&nbsp;&nbsp;&nbsp;Ферма</a></li>
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/fabrika/">&nbsp;&nbsp;&nbsp;&nbsp;Фабрики&nbsp;продуктов</a></li>
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/fabrika_blincik/">&nbsp;&nbsp;&nbsp;&nbsp;Пекарня</a></li>
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/blinaya/">&nbsp;&nbsp;&nbsp;&nbsp;Пироговая</a></li>
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/rinok/">&nbsp;&nbsp;&nbsp;&nbsp;Скотский&nbsp;рынок</a></li>
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/lavka/">&nbsp;&nbsp;&nbsp;&nbsp;Ярмарка</a></li>
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/sclad/">&nbsp;&nbsp;&nbsp;&nbsp;Склад</a></li>
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/exchange/">&nbsp;&nbsp;&nbsp;&nbsp;Биржа&nbsp;опыта</a></li>
											</div>			
											<li style="margin-top: 10px;-webkit-transition: all 0.5s; -o-transition: all 0.5s; transition: all 0.5s;background-repeat: no-repeat;background: url(../img/Menu-50.png) 0 6px no-repeat #5A8CFA;background-position: 10px -4px;" class="menuhid">Друзья -</li>
											<div id="menuhid-hidden" style="display: none;">	
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/referals/">&nbsp;&nbsp;&nbsp;&nbsp;Ваши&nbsp;Друзья</a></li>
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/reflink/">&nbsp;&nbsp;&nbsp;&nbsp;Рекламные&nbsp;материалы</a></li>
											</div>			
											<li style="margin-top: 10px;-webkit-transition: all 0.5s; -o-transition: all 0.5s; transition: all 0.5s;background-repeat: no-repeat;background: url(../img/Menu-50.png) 0 6px no-repeat #5A8CFA;background-position: 10px -4px;" class="menuhid">Об игре -</li>
											<div id="menuhid-hidden" style="display: none;">		
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/about/">&nbsp;&nbsp;&nbsp;&nbsp;Информация</a></li>
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/tos/">&nbsp;&nbsp;&nbsp;&nbsp;Польз.&nbsp;соглашение</a></li>
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/faq/">&nbsp;&nbsp;&nbsp;&nbsp;Вопрос&nbsp;Ответ</a></li>
												<li class="menuhid" style="padding: 11px 17px;"><a class="menubtn" style="width: 82%;display:block;" href="/statistics/">&nbsp;&nbsp;&nbsp;&nbsp;Статистика</a></li>
											</div>			
											<!--<li><a href="/kupon/"><span>Купоны</span></a></li>-->
											<li class="menuhid" style="width:93%;margin-top: 14px;"><a class="menubtn" style="display:block;" href="/top100/">&nbsp;&nbsp;&nbsp;&nbsp;Топ&nbsp;100</a></li>
											<li class="menuhid" style="width:93%"><a class="menubtn" style="display:block;" href="/bonus/">&nbsp;&nbsp;&nbsp;&nbsp;Бонус</a></li>
											<li class="menuhid" style="width:93%"><a class="menubtn" style="display:block;" href="/action/">&nbsp;&nbsp;&nbsp;&nbsp;КОНТАКТЫ</a></li>
											<?php $qqq = mysql_num_rows(mysql_query("SELECT * FROM tb_support WHERE user_id = '$usid' AND status = 1")); ?>
											<li class="menuhid" style="width:93%"><a class="menubtn" style="display:block;" href="/support/">&nbsp;&nbsp;&nbsp;&nbsp;Тех.&nbsp;Поддержка <?php echo ($qqq != '0') ? "(<font color='#fff'>$qqq</font>)" : ""; ?></a></li>
											<script type="text/javascript">
												jQuery(document).ready(function(){
												setInterval("jQuery('#loadAafr').load('#span #loadBdef');",15000); //У меня интервал обновления блока - минута
												});
											</script>
											<?php $q = mysql_query("SELECT DISTINCT ip, login, page FROM tb_online WHERE page = 'Чат'") or die(mysql_error()); ?>
											<li class="menuhid" style="width:93%"><a class="menubtn" style="display:block;" href="/chat/">&nbsp;&nbsp;&nbsp;&nbsp;Чат&nbsp;проекта (<span id="loadAafr"><span id="loadBdef"><?=mysql_num_rows($q); ?></span></span>)</a></li>
											<li class="menuhid" style="width:93%;margin-bottom: 14px;"><a class="menubtn" style="display:block;" href="/logout.php/">&nbsp;&nbsp;&nbsp;&nbsp;Выход</a></li>
										</ul>
									</div>
										

									<?php
										//Stat site
										$qs = $db->numRows($db->query("SELECT * FROM tb_users"));
										$t = time() - 86400;
										$ws = $db->numRows($db->query("SELECT * FROM tb_users WHERE date_reg >= '$t'"));
										$s = $db->numRows($db->query("SELECT DISTINCT ip, login, page FROM tb_online"));
										$d = $db->numRows($db->query("SELECT DISTINCT ip, login, page FROM tb_online WHERE login != 'Гость'"));
										$tt = $db->numRows($db->query("SELECT * FROM tb_vivod WHERE status = 1"));
										$ys = $db->getRow("SELECT SUM(summa_full) AS sum_v FROM tb_vivod WHERE status = 1");
										$q = $db->getRow("SELECT SUM(kol) AS q1 FROM tb_stat_z WHERE type = 1");
										$q1 = $db->getRow("SELECT SUM(kol) AS q2 FROM tb_stat_z WHERE type = 2");
										$q2 = $db->getRow("SELECT SUM(kol) AS q3 FROM tb_stat_z WHERE type = 3");
										$q3 = $db->getRow("SELECT SUM(kol) AS q4 FROM tb_stat_z WHERE type = 4");
										$q5 = $db->getRow("SELECT SUM(kol) AS q5 FROM tb_stat_z WHERE type = 5");
										$q6 = $db->getRow("SELECT SUM(kol) AS q6 FROM tb_stat_z WHERE type = 6");
										$w = $db->getRow("SELECT * FROM tb_stat_and ORDER BY id DESC LIMIT 1");
										$y = $db->getRow("SELECT * FROM tb_stat_full");
										$r = $db->getRow("SELECT SUM(summa_full) AS sum_v FROM tb_vivod WHERE status = 1");
										$rr = $db->getRow("SELECT SUM(summa) AS sum_p FROM tb_enter WHERE status = 2");
										$p = $db->getRow("SELECT * FROM tb_conf_site WHERE id = 1");
										$rez = $db->getRow("SELECT * FROM tb_lavka WHERE id = 1");
										echo '<pre>'.print_r($GLOBALS,true).'</pre>';
									?>
									<script type="text/javascript">
										function server_time()
										{
											var Hours = document.getElementById('Server_hours').value;
											var Minutes = document.getElementById('Server_minutes').value;
											var Seconds = document.getElementById('Server_seconds').value;

											if(Seconds < 59){
												Seconds++;
												if(Seconds < 10) {Seconds = "0" + Seconds;}
											}else{
												Seconds = 0;
												if(Seconds < 10) {Seconds = "0" + Seconds;}
												if(Minutes < 59){
													Minutes++;
													if(Minutes < 10) {Minutes = "0" + Minutes;}
												}else{
													Minutes = 0;
													if(Minutes < 10) {Minutes = "0" + Minutes;}
													if(Hours < 23){
														Hours++;
														if(Hours < 10 ) {Hours = "0" + Hours;}
													}else{
														Hours = 0;
														if(Hours < 10 ) {Hours = "0" + Hours;}
													}
												}
											}
											
											document.getElementById('Server_hours').value = Hours;
											document.getElementById('Server_minutes').value = Minutes;
											document.getElementById('Server_seconds').value = Seconds;
											var servertime = Hours + ":" + Minutes + ":" + Seconds;
											document.getElementById('server_time').innerHTML = servertime;
											setTimeout(function(){server_time()},1000);	
										}
										function show_menu(e_id) {
											var obj = document.getElementById(e_id); 
											if (obj.style.display != "block") { 
												obj.style.display = "block"; 
											}
											else obj.style.display = "none"; 
										}   
									</script>
									<div id="wrapper-250" style="display: inline-block;">

		<ul class="accordion">
			
			<li id="one" class="files">

				<a href="#one">Купленно сегодня</a>

				<ul class="sub-menu">
					
					<li><a><em></em>Кур<span><?=$w['q1']; ?></span></a></li>		
					<li><a><em></em>Бычков<span><?=$w['q2']; ?></span></a></li>
					<li><a><em></em>Коз<span><?=$w['q3']; ?></span></a></li>
					<li><a><em></em>Коров<span><?=$w['q4']; ?></span></a></li>

				</ul>

			</li>
			
			<li id="two" class="mail">

				<a href="#two">Статистика покупок</a>

				<ul class="sub-menu">
					
					<li><a><em></em>Кур<span><?=$q['q1']; ?></span></a></li>
					
					<li><a><em></em>Бычков<span><?=$q1['q2']; ?></span></a></li>
					<li><a><em></em>Коз<span><?=$q2['q3']; ?></span></a></li>
					<li><a><em></em>Коров<span><?=$q3['q4']; ?></span></a></li>

				</ul>

			</li>
			
			<li id="three" class="cloud">

				<a href="#three">Куплено</a>

				<ul class="sub-menu">
					
					<li><a><em></em>Полей<span><?=$y['kol_pole']; ?></span></a></li>
					
					<li><a><em></em>Загонов Кур: <span><?=$y['kol_kurat']; ?></span></a></li>

					<li><a><em></em>Загонов Бычков: <span><?=$y['kol_svinarnik']; ?></span></a></li>

					<li><a><em></em>Загонов Коз: <span><?=$y['kol_ovtarnik']; ?></span></a></li>
					
					<li><a><em></em>Загонов Коров: <span><?=$y['kol_korovnik']; ?></span></a></li>

				</ul>

			</li>
		
		
		</ul>
					<br>
	<div style="margin-top: 10px;display: inline-block;padding: 5%;width: 90%;height: 84px;background: -moz-linear-gradient(90deg, rgb(79, 146, 187) 0%, rgb(90, 140, 250) 54%);background: -webkit-linear-gradient(90deg, rgb(79, 146, 187) 0%, rgb(90, 140, 250) 54%);background: -o-linear-gradient(90deg, rgb(79, 146, 187) 0%, rgb(90, 140, 250) 54%);background: -ms-linear-gradient(90deg, rgb(79, 146, 187) 0%, rgb(90, 140, 250) 54%);background: linear-gradient(180deg, rgb(79, 146, 187) 0%, rgb(90, 140, 250) 54%);">										
	<p style="color:#fff;">Старт проекта: <?=date("d.m.Y", $p['start']); ?></p>
	<p style="color:#fff;">Резерв выплат: <?=$rr['sum_p'] - $r['sum_v']; ?> руб.</p>
	<p style="color:#fff;">Резерв ярмарки: <?=$rez['rezerv']; ?> руб.</p>
	</div>
	</div>


									<?php else : ?>
			
									<div id="menu3x">
										<ul>
											<li class="menuhid"><a class="menubtn" style="display:block;" href="/about/">&nbsp;&nbsp;&nbsp;&nbsp;Информация&nbsp;об&nbsp;игре</a></li>
											<li class="menuhid"><a class="menubtn" style="display:block;" href="/otzyvy/">&nbsp;&nbsp;&nbsp;&nbsp;Отзывы</a></li>
											<li class="menuhid"><a class="menubtn" style="display:block;" href="/top100/">&nbsp;&nbsp;&nbsp;&nbsp;Топ&nbsp;100</a></li>
											<li class="menuhid"><a class="menubtn" style="display:block;" href="/poslednie_vyplaty/">&nbsp;&nbsp;&nbsp;&nbsp;Последние&nbsp;выплаты</a></li>
											<li class="menuhid" style="margin-bottom:14px;"><a class="menubtn" style="display:block;" href="/action/">&nbsp;&nbsp;&nbsp;&nbsp;Реквизиты</a></li>
										</ul>
									</div>
										<div id="wrapper-250" style="display: inline-block;">

		<ul class="accordion">
			
			<li id="one" class="files">

				<a href="#one">Купленно сегодня</a>

				<ul class="sub-menu">
					
					<li><a><em></em>Кур<span><?=$w['q1']; ?></span></a></li>		
					<li><a><em></em>Бычков<span><?=$w['q2']; ?></span></a></li>
					<li><a><em></em>Коз<span><?=$w['q3']; ?></span></a></li>
					<li><a><em></em>Коров<span><?=$w['q4']; ?></span></a></li>

				</ul>

			</li>
			
			<li id="two" class="mail">

				<a href="#two">Статистика покупок</a>

				<ul class="sub-menu">
					
					<li><a><em></em>Кур<span><?=$q['q1']; ?></span></a></li>
					<li><a><em></em>Бычков<span><?=$q1['q2']; ?></span></a></li>
					<li><a><em></em>Коз<span><?=$q2['q3']; ?></span></a></li>
					<li><a><em></em>Коров<span><?=$q3['q4']; ?></span></a></li>

				</ul>

			</li>
			
			<li id="three" class="cloud">

				<a href="#three">Куплено</a>

				<ul class="sub-menu">
					
					<li><a><em></em>Полей<span><?=$y['kol_pole']; ?></span></a></li>
					
					<li><a><em></em>Загонов Кур: <span><?=$y['kol_kurat']; ?></span></a></li>

					<li><a><em></em>Загонов Бычков: <span><?=$y['kol_svinarnik']; ?></span></a></li>

					<li><a><em></em>Загонов Коз: <span><?=$y['kol_ovtarnik']; ?></span></a></li>
					
					<li><a><em></em>Загонов Коров: <span><?=$y['kol_korovnik']; ?></span></a></li>

				</ul>

			</li>
		
		
		</ul>
			<br>
	<div style="display: inline-block; margin-top:10px;padding: 5%;width: 90%;height: 84px;background: -moz-linear-gradient(90deg, rgb(79, 146, 187) 0%, rgb(90, 140, 250) 54%);background: -webkit-linear-gradient(90deg, rgb(79, 146, 187) 0%, rgb(90, 140, 250) 54%);background: -o-linear-gradient(90deg, rgb(79, 146, 187) 0%, rgb(90, 140, 250) 54%);background: -ms-linear-gradient(90deg, rgb(79, 146, 187) 0%, rgb(90, 140, 250) 54%);background: linear-gradient(180deg, rgb(79, 146, 187) 0%, rgb(90, 140, 250) 54%);">										
	<p style="color:#fff;">Старт проекта: <?=date("d.m.Y", $p['start']); ?></p>
	<p style="color:#fff;">Резерв выплат: <?=$rr['sum_p'] - $r['sum_v']; ?> руб.</p>
	<p style="color:#fff;">Резерв ярмарки: <?=$rez['rezerv']; ?> руб.</p>
	</div>
	</div>

									<?php endif; ?>

					</div>
					
				</div>
				
				<div class="center">
																																																																																																																																																								
								<div class="content" style="padding: 15px; min-height: 820px">
									<div id="scrollheight">
									
									<meta name="interkassa-verification" content="0c944fd2e992074caacbf80f77c1a483" />
