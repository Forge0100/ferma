<?php
ob_start();
session_start();
Header("Content-Type: text/html;charset=UTF-8");

require_once($_SERVER['DOCUMENT_ROOT']."/data/conn_file.php");
require_once($_SERVER['DOCUMENT_ROOT']."/data/func.php");
	


if(isset($_GET["menu"])){
		
			$menu = strval($_GET["menu"]);
			
			switch($menu){
			
			case "newproduct": include("pages/_newproduct.php"); break; // Страница ошибки
				
				
			# Страница ошибки
			default: @include("pages/_404.php"); break;
			
			}
			
}else @include("pages/_stats.php");


?>
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
			<div class="wrapper">
		<div class="wrapper-inner">
			<div class="top-menu-box">
				<div class="top-menu">
					
						<ul style="width:1200px; margin-top:50px;">
							<li style="width:15%;"><a style="background-repeat: no-repeat;
background-image: url(../img/Home-50.png);
background-position: 0px 0px;" href="/">Главная</a></li>
							<li style="width:15%;"><a href="/news/">Новости</a></li>
							<? if(isset($_SESSION['id'])) : ?>
							<li style="width:15%;"><a href="/otzyvy">Отзывы</a></li>
							<? else : ?>
							<li style="width:15%;"><a href="/reg">Регистрация</a></li>
							<? endif; ?>
							<li style="width:15%;"><a href="/faq/">Инструкция</a></li>
							<li style="width:15%;"><a href="/about/">FAQ</a></li>	
						</ul>
					
				</div>
			</div>
			
											<li style="margin-top: 10px;" class="menuhid">Игра -</li>
											<div id="menuhid-hidden" style="display: none;">		
												<li class="btnmenuacc"><a class="btnmenuaca" href="/newproduct/">&nbsp;&nbsp;&nbsp;&nbsp;Ферма</a></li>
												<li class="btnmenuacc"><a class="btnmenuaca" href="/fabrika">&nbsp;&nbsp;&nbsp;&nbsp;Фабрики продуктов</a></li>
												<li class="btnmenuacc"><a class="btnmenuaca" href="/fabrika_blincik">&nbsp;&nbsp;&nbsp;&nbsp;Пекарня</a></li>
												<li class="btnmenuacc"><a class="btnmenuaca" href="/blinaya">&nbsp;&nbsp;&nbsp;&nbsp;Пироговая</a></li>
												<li class="btnmenuacc"><a class="btnmenuaca" href="/rinok">&nbsp;&nbsp;&nbsp;&nbsp;Скотский рынок</a></li>
												<li class="btnmenuacc"><a class="btnmenuaca" href="/lavka">&nbsp;&nbsp;&nbsp;&nbsp;Ярмарка</a></li>
												<li class="btnmenuacc"><a class="btnmenuaca" href="/sclad">&nbsp;&nbsp;&nbsp;&nbsp;Склад</a></li>
												<li class="btnmenuacc"><a class="btnmenuaca" href="/exchange">&nbsp;&nbsp;&nbsp;&nbsp;Биржа опыта</a></li>
											</div>	
			
			</div>
			</div>
			<div class="center">
																																																																																																																																																								
								<div class="content" style="padding: 15px; min-height: 820px">
									<div id="scrollheight">
																		</div>
								</div>

			</body>