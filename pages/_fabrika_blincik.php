   <center>    <div class="tegname"><h2>Пекарня</h2></div><br>  </center>
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
<?php
$login = $_SESSION['login'];
$usid = $_SESSION['id'];
$page = 'Фабрика пирогов';
$row = $db->getRow("SELECT * FROM `tb_users` WHERE `username` = ?s", $login);
$level = $row["level"];
//$udobrenie = $row["udob"];

//$sql_p = mysql_query("SELECT * FROM `tb_fabrika_blin` WHERE `num` = '1' AND `username` = '$login'") or die(mysql_error());

$row1 = $db->getRow("SELECT `f1`, `f2`, `f3` FROM `tb_price`");
$enerr = $db->getRow("SELECT * FROM tb_energy WHERE id = 1");
?>

<link rel="stylesheet" type="text/css" href="css/pole1.css" />
<p style="border: 3px solid #0E82A7;border-radius: 8px;padding: 2%;">
<a class="tooltip" href="javascript:void(0)">Пекарня[?]<span class="custom help" style="width: 450px;"><em>Информация</em>		
На полях Вы можете купить пекарни.<br />
На одно поле можно поставить только одну пекарню.<br /> 
Пекарни можно купить с 40 уровня.<br />
Вы можете покупать пекарни только в порядке очереди.<br /> 
Каждое приготовление пирогов забирает свое количество энергии и дает количество опыта</span></a>
<br /><br />
Доступно 3 вида пекарен :<br />
<a class="tooltip" href="javascript:void(0)">[?]<span class="custom help"><em>Пекарня пирог с мясом</em>Для приготовления 200 пирогов необходимо 70 тесто и 200 фарша.<br> Время переработки: 24 часов.<br>Цена покупки: <?=$row1['f1']; ?> руб.<br>
Энергия(сбор): -<?=$enerr['p25']; ?> <br>
Энергия (приготовление): -<?=$enerr['p16']; ?> <br>
Опыт(Сбор): +<?=$enerr['p52']; ?> <br>
Опыт (приготовление): +<?=$enerr['p43']; ?> <br>
</span></a>
Пекарня "Пирог с мясом" (Доступно с 40 уровня) <br />

<a class="tooltip" href="javascript:void(0)">[?]<span class="custom help"><em>Пекарня Пирог с сыром</em>Для приготовления 200 пирогов необходимо 70 тесто и 200 сыра.<br> Время переработки: 24 часов.<br>Цена покупки: <?=$row1['f2']; ?> руб.<br>
Энергия(сбор): -<?=$enerr['p26']; ?> <br>
Энергия (приготовление): -<?=$enerr['p17']; ?> <br>
Опыт(Сбор): +<?=$enerr['p53']; ?> <br>
Опыт (приготовление): +<?=$enerr['p44']; ?> <br></span></a>
Пекарня "Пирог с сыром" (Доступно с 60 уровня) <br />

<a class="tooltip" href="javascript:void(0)">[?]<span class="custom help"><em>Пекарня Пирог с творогом</em>Для приготовления 200 пирогов необходимо 70 тесто и 200 творога.<br> Время переработки: 24 часов.<br>Цена покупки: <?=$row1['f3']; ?> руб.<br>
Энергия(сбор): -<?=$enerr['p27']; ?> <br>
Энергия (приготовление): -<?=$enerr['p18']; ?> <br>
Опыт(Сбор): +<?=$enerr['p54']; ?> <br>
Опыт (приготовление): +<?=$enerr['p45']; ?> <br></span></a>
Пекарня "Пирог с творогом" (Доступно с 80 уровня)<br /><br>
<br> Друг-реферер получает 10% от стоимости пекарни.<br />
<br>
 <font color="#FC0202">ВАЖНО!!! После 365 сборов пекарня рушится, после чего на её месте вы сможете поставить новую пекарню.</font> </p><br><br>

<br />	
<!--На вашем складе варежки: <span id="span_varejki"></?=$us_data['varezhki']; ?></span> ед. <a href="/magazin/">Купить>></a><br><br>-->


<?php

if($level >= '40') {echo '<input type="radio" name="fab" value="1" checked > Пирог с мясом&nbsp;&nbsp;&nbsp;';}
if($level >= '60') {echo '<input type="radio" name="fab" value="2"> Пирог с сыром&nbsp;&nbsp;';}
if($level >= '80') {echo '<input type="radio" name="fab" value="3"> Пирог с творогом&nbsp;&nbsp;';}


?>
<br><br>

<style>
#pole .pole_1 { top: 0px; left: 154px; cursor: pointer; }
#pole .pole_2 { top: -57px; left: 83px; cursor: pointer; }
#pole .pole_3 { top: -114px; left: 12px; cursor: pointer; }
#pole .pole_4 { top: -265px; left: 232px; cursor: pointer; }
#pole .pole_5 { top: -324px; left: 162px; cursor: pointer; }
#pole .pole_6 { top: -381px; left: 91px; cursor: pointer; }
#pole .pole_7 { top: -530px; left: 310px; cursor: pointer; }
#pole .pole_8 { top: -588px; left: 239px; cursor: pointer; }
#pole .pole_9 { top: -647px; left: 169px; cursor: pointer; }
.click_div { width: 90px; height: 45px; left: 32px; position: absolute; }
</style>
<script type="text/javascript" src="/js/pole_divs.js"></script>
<?php 
	$sql_pp = $db->query("SELECT * FROM `tb_fabrika_blin` WHERE `username` = ?s order by `num`", $login);
	//$sql_pp = mysql_query("SELECT * FROM `tb_fabrika` WHERE `username` = '$login' order by `num`") or die(mysql_error());
	$rows = $db->numRows($sql_pp);
		
	
	$pages = ceil($rows/9);
	$pages = $pages ? $pages : 1;
	if($rows > 0 and ((intval($rows) % 9) == 0)) $pages++;
	
	$matrix = $pages * 9;
	$array = array();
	for($i = 0, $j = 40; $i < $matrix; $i++, $j+=20)
	{
		$array[$j] = 0;
	}
	
	while ($row = $db->fetch($sql_pp)) {
		$array[$row['num']] = $row;
	}
	
	static $lvl_pole = 40; 
	static $z = 1;
?>
<div id="tabs_pole">
	<ul>
		<?php for($tab = 1; $tab <= $pages; $tab++) : ?>
		<li><a href="#pole<?php echo $tab; ?>"><span><?php echo $tab; ?></span></a></li>
		<?php endfor; ?>
	</ul>
</div>
<div id="loadA"><div id="loadB">
<div id="tabs_pole_container" style="height: 297px;">
<?php for($tab = 1; $tab <= $pages; $tab++) : ?>
<div id="pole<?php echo $tab; ?>" class="tab_content" style="display:<?php if ($tab == 1) print "block;"; else print"none;";?>">
	<div id="pole" unselectable="on" style="margin-left: 7px;">
		<span style="font-size: 18px;position: absolute;color: #4756EA;margin-left: 12px;">Поле № (<?php echo $tab; ?>)</span>
		
		<?php for($i = 0; $i < 9; $i++, $lvl_pole+=20, $z++) : ?>
			
			<?php if($array[$lvl_pole]['pay'] == 1) : ?>
			
			<div id="pole_<?php echo $lvl_pole; ?>" class="pole_img fabrika1 pole_<?php echo $i+1; ?>">
				<?php echo sobrati_blin($login, $lvl_pole); ?>
				<div class="click_div" style="color:#D2EFF6;" onclick="pay_pol_new(<?php echo $lvl_pole ?>, <?php echo $z; ?>, 1);"><?php //echo $array[$lvl_pole]['num']; ?></div>
			</div>	
			
			<?php elseif($level < $lvl_pole) : ?>
			
				<div id="pole_<?php echo $lvl_pole; ?>" class="pole_img pole_kupit pole_<?php echo $i+1; ?>">
					<span class="text">Купить c <?php echo $lvl_pole; ?> уровня</span>
				</div>
			
			<?php elseif($level >= $lvl_pole) : ?>
			
				<div id="pole_<?php echo $lvl_pole; ?>" class="pole_img pole_kupite pole_<?php echo $i+1; ?>">
					<div class="click_div" onclick="pay_pol_new(<?php echo $lvl_pole ?>, <?php echo $z; ?>, 0);"></div>
				</div>
			
			<?php endif; ?>
		
		<?php if($z == 3) $z = 0; endfor; ?>
	</div>
</div>

<?php endfor; ?>
</div>
</div>



<div class="clear"></div>
</div>

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
<script type="text/javascript"src="/js/obrfb.js"></script>