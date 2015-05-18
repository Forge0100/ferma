                       <center>       <div class="tegname"><h2>Загон Коров</h2></div><br> </center>
<?php
if(!isset($_SESSION['id']) and !isset($_SESSION['login'])) {

print "<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">

<script language=\"javascript\">top.location.href=\"/\";</script>
<title>Перенаправление</title>
</head>
<body bgcolor=\"#eeeeee\" topmargin=\"0\" leftmargin=\"0\">

</body>
</html>";
exit;
}
?>
<?PHP
$login = $_SESSION['login'];
$usid = $_SESSION['id'];
$page = 'Загоны';
$row = $db->getRow("SELECT * FROM `tb_users` WHERE `username` = ?s", $login);
$level = $row["level"];

if(!isset($_SESSION['zagon']['tab']['4'])) $_SESSION['zagon']['tab']['4'] = 1;


//$sql_p = mysql_query("SELECT * FROM `tb_kura` WHERE `num` = '1' AND `username` = '$login'") or die(mysql_error());
$row = $db->getRow("SELECT `price_karova`FROM `tb_price`");

?>
<link rel="stylesheet" type="text/css" href="/css/pole.css" />
<a class="tooltip" href="javascript:void(0)">Загон Коров [?]<span class="custom help" style="width: 450px;"><em>Информация</em>В каждый загон можно посадить 9 коров.<br>
	Животных надо кормить каждые 24 часа. После того, как Вы покормили животное и прошло 24 часа, Вы получите две единици продукции, которую надо собрать.<br>
	1 корова дает 60 молока, после чего навсегда покидает игру.<br>
	Каждое кормление забирает 8 ед. энергии и дает 4 ед. опыта.<br>
	Каждый сбор продукта забирает 2 ед. энергии и дает 2 ед. опыта.<br><br>
</span></a>
<br><br>
<link rel="stylesheet" type="text/css" href="/css/pole1.css" />
<p style="border: 3px solid #0E82A7;border-radius: 8px;padding: 2%;">На полях Вы можете купить загоны коров для животных.<br>
	
	
	<br>У Вас в наличии корм: <span id="span_korm"><?=$us_data['svekla']; ?></span> шт.<br>
	У Вас в наличии молока: <span id="span_product"><?=$us_data['m_k']; ?></span> шт.<br>
	У Вас коров для посадки: <span id="span_animals"><?=$us_data['karova']; ?></span> шт.<br>
	<br>Цена покупки загона коров: <?=$row['price_karova']; ?> руб.<br>
	<br>Друг-реферер получает 10% от стоимости загона коров.</p>
<script type="text/javascript">
		var my_cat = "kor";

		function DoBuy()
		{
			if (confirm("Вы хотите купить услугу на месяц ?"))
			{
				$.post("/ajax/auto_sbor.php", 
				{action: "buy",cat:my_cat},
				function(data)
				{	
					var obj = $.parseJSON(data);
					if (obj.err!="")
						DoMsg(obj.err);
					else
						DoMsg(obj.msg,2);
				})
			}
		}

		function DoMsg(text, sh) 
		{
			n = noty({
			text: '<b>'+text+'</b>',
			dismissQueue: false,
			layout: 'top',
			theme: 'defaultTheme',
			killer: true,
			callback:  {
			afterClose: function() {n=null; if (sh==1) DoBuy(); if (sh==2) setTimeout(function() {location.reload();},100)  },
			}
			});
		};

		function DoSbor() 
		{
			$.post("/ajax/auto_sbor.php", 
			{action: "sbor",cat:my_cat},
			function(data)
			{	
				var obj = $.parseJSON(data);
				if (obj.err!="")
					DoMsg(obj.err,1);
				else 
				{
					eval(obj.js);
					DoMsg(obj.msg,2);
				}

			})
		}
		
</script>
<br>
<a href="javascript:void(0);" onclick="DoSbor();">
<span>Собрать / покормить</span>
</a>
	<div id="menu_zagon">
	<ul>
		<li><a href="/pole/"><span>Поле</span></a></li>
		<li><a href="/newproduct"><span>Загон Кур</span></a></li>
		<li><a href="/svin"><span>Загон Бычков</span></a></li>
		<li><a href="/ovta"><span>Загон Коз</span></a></li>
		<li class="active" ><a href="/korova"><span>Загон Коров</span></a></li>
		
	</ul>
	</div>



<div class="clear"></div>

<?php
$type_zagon = 4;
if(isset($_GET['id'])) {
$id_kurat = intval($_GET['id']);

$_SESSION['zagon']['tab']['4'] = count_page_zagon($_GET['id'], '4');

$q = $db->query("SELECT * FROM tb_zagon_id WHERE zagon_id = ?i AND `type` = ?i AND login = ?s", $id_kurat, $type_zagon, $login);
if($db->numRows($q) == 0){
echo '<center><font color="red">Это не ваш коровник</font></center>';
Header("Refresh: 3, /korova");
exit();
}else{
$id_kur = 1;
?>


<div class="answer_zagon" style="display: block;">
				<a href="/korova"><b class="close">X</b></a><br>
				<div id="loadA"><div id="loadB">
<span id="answer_span">
				<div id="poleinanswer">
			
				<div id="pole_<?=$id_kur;?>" class="pol_img   <? echo kur_by($id_kurat, $login, $id_kur, $type_zagon) ; ?>" style="top: 15px; left: 148px; cursor: pointer;">
				
				<div  class="click_div" onclick="korm_kur('<?=$id_kurat;?>', '<?=$id_kur;?>', '<?=$type_zagon;?>');"></div></div>
				
				<div id="pole_<?=$id_kur+1;?>" class="pol_img   <? echo kur_by($id_kurat, $login, $id_kur+1, $type_zagon) ; ?>" style="top: -43px; left: 74px; cursor: pointer;">
			
				<div class="click_div" onclick="korm_kur('<?=$id_kurat;?>', '<?=$id_kur+1;?>', '<?=$type_zagon;?>');"></div></div>
				
				<div id="pole_<?=$id_kur+2;?>" class="pol_img   <? echo kur_by($id_kurat, $login, $id_kur+2, $type_zagon) ; ?>" style="top: -101px; left: 0px; cursor: pointer;">
				
				<div class="click_div" onclick="korm_kur('<?=$id_kurat;?>', '<?=$id_kur+2;?>', '<?=$type_zagon;?>');"></div></div>
				
				<div id="pole_<?=$id_kur+3;?>" class="pol_img   <? echo kur_by($id_kurat, $login, $id_kur+3, $type_zagon) ; ?>" style="top: -247px; left: 227px; cursor: pointer;">
				
				<div class="click_div" onclick="korm_kur('<?=$id_kurat;?>', '<?=$id_kur+3;?>', '<?=$type_zagon;?>');"></div></div>
				
				<div id="pole_<?=$id_kur+4;?>" class="pol_img   <? echo kur_by($id_kurat, $login, $id_kur+4, $type_zagon) ; ?>" style="top: -305px; left: 153px; cursor: pointer;">
				
				<div class="click_div" onclick="korm_kur('<?=$id_kurat;?>', '<?=$id_kur+4;?>', '<?=$type_zagon;?>');"></div></div>
				
				<div id="pole_<?=$id_kur+5;?>" class="pol_img   <? echo kur_by($id_kurat, $login, $id_kur+5, $type_zagon) ; ?>" style="top: -362px; left: 79px; cursor: pointer;">
				
				<div class="click_div" onclick="korm_kur('<?=$id_kurat;?>', '<?=$id_kur+5;?>', '<?=$type_zagon;?>');"></div></div>
				
				<div id="pole_<?=$id_kur+6;?>" class="pol_img   <? echo kur_by($id_kurat, $login, $id_kur+6, $type_zagon) ; ?>" style="top: -509px; left: 307px; cursor: pointer;">
				
				<div class="click_div" onclick="korm_kur('<?=$id_kurat;?>', '<?=$id_kur+6;?>', '<?=$type_zagon;?>');"></div></div>
				
				<div id="pole_<?=$id_kur+7;?>" class="pol_img   <? echo kur_by($id_kurat, $login, $id_kur+7, $type_zagon) ; ?>" style="top: -567px; left: 232px; cursor: pointer;">
			
				<div class="click_div" onclick="korm_kur('<?=$id_kurat;?>', '<?=$id_kur+7;?>', '<?=$type_zagon;?>');"></div></div>
			
				<div id="pole_<?=$id_kur+8;?>" class="pol_img   <? echo kur_by($id_kurat, $login, $id_kur+8, $type_zagon) ; ?>" style="top: -624px; left: 158px; cursor: pointer;">
				
				<div class="click_div" onclick="korm_kur('<?=$id_kurat;?>', '<?=$id_kur+8;?>', '<?=$type_zagon;?>');"></div></div>
				
				</div>
				
				<link rel="stylesheet" href="/simplemodal/demo.css?v=2">
				
<div class="overlay-container">
	<div class="window-container zoomin">
		<h3></h3> 
		<div align=center>
			<span onclick="$('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible'); $('.window-container.zoomin').find('h3').html('');" class="closeWindow">Закрыть</span>
		</div>
	</div>
</div>
				
				<script type="text/javascript"src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="/js/jquery.noty.packaged.min.js" type="text/javascript"></script>
				<script type="text/javascript"src="/js/zagon_korm.js"></script>
</span>
</div>
				</div>
</div>

<?php

return;
}
}
?>

<script type="text/javascript" src="/js/pole_divs.js"></script>

	<div id="tabs_pole">
	<div class="answer_zagon">
				<b class="close">X</b><br>
				</div>
			<div class="answer_prod">
				<b class="close">X</b><br>
				</div>
	<ul>
	<?php
	
	$sql_pp = $db->query("SELECT * FROM `tb_zagon` WHERE `type` = ?i AND `login` = ?s", $type_zagon, $login);
$kol_pole = $db->numRows($sql_pp);
$koll = $kol_pole / 9;
	
	if($kol_pole <= 8) {$kl = 1;} else {
	$kl = 1;
	while ($kl <= $koll) {
	
	$kl++;
	}
	}
	for($i = 1; $i<=$kl; $i++) {
	
	?>
	<li <?php if($i == $_SESSION['zagon']['tab']['4']) echo 'class="active"'; ?>><a href="#pole<?=$i; ?>"><span><?=$i; ?></span></a></li>
	<? } ?>

		</ul>
		</div>
		<div id="loadA"><div id="loadB">
<div id="tabs_pole_container" style="height: 297px;">
<span id="errors_pole" style="padding:5px 10px; background:#F98E8E; border-radius:5px;display:none;"></span>

<span id="timers" style="padding:5px 10px; background:#F98E8E; border-radius:5px;display:none;"></span>
<?php
$q = $kl;
for ($k = 1; $k <= $q; $k++) {

if($k == 1) {$i = 15;}
elseif ($k > 1) {


$i = $i + 9;


}
?>
<div id="pole<?=$k; ?>" class="tab_content" style="display:<?if ($k==$_SESSION['zagon']['tab']['4']) print "block;"; else print"none;";?>">
<div id="pole" unselectable="on">
<span style="font-size: 18px;position: absolute;color: #4756EA;margin-left: 12px;">Поле № (<?=$k; ?>)</span>




<?php 
if($level == 15 and $k == 1) {
echo '<div id="pole_';echo $i; echo '" class="pole_img '.kur_class("$login", $i, "$type_zagon").'"  style="top: 0px; left: 154px; cursor: pointer;">'.sobrati_kur("$login", $i, "$type_zagon").''; 
echo kura_href("$login", $i, "$type_zagon");
} else {
if($level < ($i)) {
echo '<div class="pole_img pole_kupit" style="top: 0px; left: 154px;">';
echo '<span class="text">Купить c '; echo $i; echo' уровня</span>';
}else{

echo '<div id="pole_';echo $i; echo '" class="pole_img '.kur_class("$login", $i, "$type_zagon").'"  style="top: 0px; left: 154px; cursor: pointer;">'.sobrati_kur("$login", $i, "$type_zagon").'';
echo kura_href("$login", $i, "$type_zagon");

}


}
echo '</div>';
if($level < ($i+1)) {
echo '<div class="pole_img pole_kupit" style="top: -57px; left: 83px;">';
echo '<span class="text">Купить c '; echo $i+1; echo' уровня</span>';

}else{

echo '<div id="pole_';echo $i+1; echo '" class="pole_img '.kur_class("$login", $i+1, "$type_zagon").'"  style="top: -57px; left: 83px; cursor: pointer;">
'.sobrati_kur("$login", $i+1, "$type_zagon").'';
echo kura_href("$login", $i+1, "$type_zagon");

}
echo '</div>';
if($level < ($i+2)) {
echo '<div class="pole_img pole_kupit" style="top: -114px; left: 12px;">';
echo '<span class="text">Купить c '; echo $i+2; echo' уровня</span>';
}else{

echo '<div id="pole_';echo $i+2; echo '" class="pole_img '.kur_class("$login", $i+2, $type_zagon).'"  style="top: -114px; left: 12px; cursor: pointer;">
'.sobrati_kur("$login", $i+2, $type_zagon).'';
echo kura_href("$login", $i+2, $type_zagon);

}
echo '</div>';
if($level < ($i+3)) {
echo '<div class="pole_img pole_kupit" style="top: -265px; left: 232px;">';
echo '<span class="text">Купить c '; echo $i+3; echo' уровня</span>';
}else{

echo '<div id="pole_';echo $i+3; echo '" class="pole_img '.kur_class("$login", $i+3, $type_zagon).'" style="top: -265px; left: 232px; cursor: pointer;">'.sobrati_kur("$login", $i+3, $type_zagon).'';
echo kura_href("$login", $i+3, $type_zagon);
}
echo '</div>';
if($level < ($i+4)) {
echo '<div class="pole_img pole_kupit" style="top: -324px; left: 162px;">';
echo '<span class="text">Купить c '; echo $i+4; echo' уровня</span>';
}else{

echo '<div id="pole_';echo $i+4; echo '" class="pole_img '.kur_class("$login", $i+4, $type_zagon).'" style="top: -324px; left: 162px; cursor: pointer;">'.sobrati_kur("$login", $i+4, $type_zagon).'';
echo kura_href("$login", $i+4, $type_zagon);
}
echo '</div>';
if($level < ($i+5)) {
echo '<div class="pole_img pole_kupit" style="top: -381px; left: 91px;">';
echo '<span class="text">Купить c '; echo $i+5; echo' уровня</span>';
}else{

echo '<div id="pole_';echo $i+5; echo '" class="pole_img '.kur_class("$login", $i+5, $type_zagon).'" style="top: -381px; left: 91px; cursor: pointer;">'.sobrati_kur("$login", $i+5, $type_zagon).'';
echo kura_href("$login", $i+5, $type_zagon);
}
echo '</div>';
if($level < ($i+6)) {
echo '<div class="pole_img pole_kupit" style="top: -530px; left: 310px;">';
echo '<span class="text">Купить c '; echo $i+6; echo' уровня</span>';
}else{

echo '<div id="pole_';echo $i+6; echo '" class="pole_img '.kur_class("$login", $i+6, $type_zagon).'" style="top: -530px; left: 310px; cursor: pointer;">'.sobrati_kur("$login", $i+6, $type_zagon).'';
echo kura_href("$login", $i+6, $type_zagon);
}
echo '</div>';
if($level < ($i+7)) {
echo '<div class="pole_img pole_kupit" style="top: -588px; left: 239px;">';
echo '<span class="text">Купить c '; echo $i+7; echo' уровня</span>';
}else{

echo '<div id="pole_';echo $i+7; echo '" class="pole_img '.kur_class("$login", $i+7, $type_zagon).'" style="top: -588px; left: 239px; cursor: pointer;">'.sobrati_kur("$login", $i+7, $type_zagon).'';
echo kura_href("$login", $i+7, $type_zagon);
}
echo '</div>';
if($level < ($i+8)) {
echo '<div class="pole_img pole_kupit" style="top: -647px; left: 169px;">';
echo '<span class="text">Купить c '; echo $i+8; echo' уровня</span>';
} else {
echo '<div id="pole_';echo $i+8; echo '" class="pole_img '.kur_class("$login", $i+8, $type_zagon).'" style="top: -647px; left: 169px; cursor: pointer;">'.sobrati_kur("$login", $i+8, $type_zagon).'';
echo kura_href("$login", $i+8, $type_zagon);
}
echo '</div>';
?>
</div></div>
<? } ?>

<script> $('#pole<?php echo $_SESSION['zagon']['tab']['4']; ?>').css({'display':'block'}); </script>
<?php $_SESSION['zagon']['tab']['4'] = 1; ?>
</div></div>









<div class="clear"></div>
</div>



<script type="text/javascript"src="/js/jquery-1.9.1.min.js"></script>
<script src="/js/jquery.noty.packaged.min.js" type="text/javascript"></script>
<script type="text/javascript"src="/js/zagon.js"></script>