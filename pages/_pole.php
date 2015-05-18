<center>  <div class="tegname"><h2>Поле</h2></div><br> </center>

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
$page = 'Поле';
$row = $db->getRow("SELECT * FROM `tb_users` WHERE `username` = ?s", $login);
$level = $row["level"];
$udobrenie = $row["udob"];

$sql_p = $db->query("SELECT * FROM `tb_pole` WHERE `num` = '1' AND `username` = ?s", $login);

if($db->numRows($sql_p) == 0) {
$db->query("INSERT INTO `tb_pole` (`username`, `num`, `type`, `time`, `udob`, `pay`) VALUES (?s, '1', '0', '0', '0', '1') ", $login);
}

?>

<link rel="stylesheet" type="text/css" href="/css/pole.css" />
<a class="tooltip" href="javascript:void(0)">Поля [?]<span class="custom help" style="width: 450px;"><em>Информация</em>На полях вы можете посеять семена и получить корм для животных.<br>
Каждый посев забирает 2 ед. энергии.
Для посева семян и сбора урожая, кликайте по полю.</span></a>
<br><br>
<p style="border: 3px solid #0E82A7;border-radius: 8px;padding: 2%;">
Доступно 6 видов семян:<br />
<br> <a class="tooltip" href="javascript:void(0)">[?]<span class="custom help"><em>Пшеница</em>Необходимо для кормления кур в загонах!<br> Время созревания: 60 минут.<br> Можно использовать 1 энергию для уменьшения созревания на 30 минут. </span></a> Пшеница -> Цена посева - 0.01 руб. (Доступно с 1 уровня)<br />

<a class="tooltip" href="javascript:void(0)">[?]<span class="custom help"><em>Клевер</em>Необходимо для кормления бычков в загонах!<br> Время созревания: 90 минут.<br> Можно использовать 3 энергию для уменьшения созревания на 45 минут.</span></a> Клевер -> Цена посева - 0.02 руб. (Доступно с 4 уровня)<br />

<a class="tooltip" href="javascript:void(0)">[?]<span class="custom help"><em>Капуста</em>Необходимо для кормления коз в загонах!<br> Время созревания: 120 минут.<br> Можно использовать 4 энергию для уменьшения созревания на 60 минут.</span></a> Капуста -> Цена посева - 0.04 руб. (Доступно с 7 уровня)<br />

<a class="tooltip" href="javascript:void(0)">[?]<span class="custom help"><em>Свекла</em>Необходимо для кормления коров в загонах!<br> Время созревания: 270 минут.<br> Можно использовать 12 энергию для уменьшения созревания на 135 минут.</span></a> Свекла -> Цена посева - 0.10 руб. (Доступно с 10 уровня)<br />


<br>Цена покупки полей: 2 руб. <br>За покупку поля снимается 1 ед энергии, и начисляется 1 ед опыта.<br />
<br />


<b>Корм на вашем складе:</b><br>
Пшеница: <span id="span_korm1"><?=$row["pshenica"]?></span> шт. <br>Клевер: <span id="span_korm2"><?=$row["kukurudza"]?></span> шт. <br>Капуста: <span id="span_korm3"><?=$row["jachmen"]?></span> шт. <br>Свекла: <span id="span_korm4"><?=$row["svekla"]?></span> шт. <br>

</p><p>
<a class="tooltip" href="javascript:void(0)">[?]<span class="custom help"><em>Выбор семян</em>Перед нажатием на поле выберите какой вид семян хотите посеять!</span></a> Выберите тип семян, которые хотите посеять.<br>
<input type="radio" name="semena" value="1" checked>Пшеница
<?php
if($level >= '4') {echo '<input type="radio" name="semena" value="2"> Клевер&nbsp;&nbsp;&nbsp;';}
if($level >= '7') {echo '<input type="radio" name="semena" value="3"> Капуста&nbsp;&nbsp;';}
if($level >= '10') {echo '<input type="radio" name="semena" value="4"> Свекла&nbsp;&nbsp;';}


?>
<br><br>

<a class="tooltip" href="javascript:void(0)">[?]<span class="custom help"><em>Удобрить поля?</em> Если хотите удобрить поля при нажатии на поле, выбирайте да!</span></a> Удобрить поля?<br>
<input type="radio" name="udob" value="0" checked>Нет <input type="radio" name="udob" value="1">Да <br><br>
</p>
<script type="text/javascript">

		function DoBuy()
		{
			if (confirm("Вы хотите купить услугу на месяц ?"))
			{
				$.post("/ajax/auto_sbor.php", 
				{action: "buy",cat:"pole"},
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
			{action: "sbor",cat:"pole"},
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
<a href="javascript:void(0);" onclick="DoSbor();">
<span>Собрать / засеять</span>
</a>


<div id="menu_zagon">
	<ul>
		<li class="active" ><a href="/pole/"><span>Поле</span></a></li>
		<li><a href="/newproduct"><span>Загон Кур</span></a></li>
		<li><a href="/svin"><span>Загон Бычков</span></a></li>
		<li><a href="/ovta"><span>Загон Коз</span></a></li>
		<li><a href="/korova"><span>Загон Коров</span></a></li>
		
	</ul>
</div>
<script type="text/javascript" src="/js/pole_divs.js"></script>
<div class="answer">
	<b class="close">X</b><br>
</div>
<div id="tabs_pole">
	<ul>
	<?php
	$sql_pp = $db->query("SELECT * FROM `tb_pole` WHERE `username` = ?s", $login);
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
	<li><a href="#pole<?=$i; ?>"><span><?=$i; ?></span></a></li>
	<? } ?>

	</ul>
</div>
		
		
<div id="loadA"><div id="loadB">
<div id="tabs_pole_container">
	<span id="errors_pole" style="padding:5px 10px; background:#F98E8E; border-radius:5px;display:none;"></span>
	<span id="timers" style="padding:5px 10px; background:#F98E8E; border-radius:5px;display:none;"></span>
<?php
function getAllFields($level) {
if ($level == 0) return 0;
//if ($level >= 1&&$level <= 4) return 1 + getAllFields($level - 1);
//if ($level >= 5&&$level <= 9) return 2 + getAllFields($level - 1);
//if ($level >= 10&&$level <= 14) return 3 + getAllFields($level - 1);
return 4 + getAllFields($level - 1);
}
function getLevel($number_field) {
$lvl=1;
while($number_field>getAllFields($lvl)){
$lvl++;
}
return $lvl;
}
$q = $kl;
for ($k = 1; $k <= $q; $k++) {

if($k == 1) {$i = 1;}
elseif ($k > 1) {


$i = $i + 9;


}
?>
<div id="pole<?=$k; ?>" class="tab_content" style="display:<?if ($k==1) print "block;"; else print"none;";?>">
<div id="pole" unselectable="on" style="margin-left: 7px;">
<span style="font-size: 18px;position: absolute;color: #4756EA;margin-top: 8px;margin-left: 11px;">Поле № (<?=$k; ?>)</span>
<br>



<?php
 
if($level == 1 and $k == 1) {
echo '<div id="pole_';echo $i; echo '" class="pole_img '.pole_class("$login", $i).'" title="Кликай на поле для посева или сбора урожая!" style="top: 0px; left: 154px;">
<div class="click_div" onclick="pay_pol(';echo $i; echo ');"></div>
';
} else {
if(getAllFields($level) < ($i)) {
echo '<div class="pole_img pole_kupit" style="top: 0px; left: 154px;">';
echo '<span class="text">Купить c '; echo getLevel($i); echo' уровня</span>';
}else{

echo '<div id="pole_';echo $i; echo '" class="pole_img '.pole_class("$login", $i).'" title="Кликай на поле для посева или сбора урожая!" style="top: 0px; left: 154px;">';
echo '<div class="click_div" onclick="pay_pol(';echo $i; echo ');"></div>';
}


}
echo '</div>';
if(getAllFields($level) < ($i+1)) {
echo '<div class="pole_img pole_kupit" style="top: -57px; left: 83px;">';
echo '<span class="text">Купить c '; echo getLevel($i+1); echo' уровня</span>';
}else{

echo '<div id="pole_';echo $i+1; echo '" class="pole_img '.pole_class("$login", $i+1).'" title="Кликай на поле для посева или сбора урожая!" style="top: -57px; left: 83px;">';
echo '<div class="click_div" onclick="pay_pol(';echo $i+1; echo ');"></div>';
}
echo '</div>';
if(getAllFields($level) < ($i+2)) {

echo '<div class="pole_img pole_kupit" style="top: -114px; left: 12px;">';
echo '<span class="text">Купить c '; echo getLevel($i+2); echo' уровня</span>';
}else{

echo '<div id="pole_';echo $i+2; echo '" class="pole_img '.pole_class("$login", $i+2).'" title="Кликай на поле для посева или сбора урожая!" style="top: -114px; left: 12px;">';
echo '<div class="click_div" onclick="pay_pol(';echo $i+2; echo ');"></div>';
}
echo '</div>';
if(getAllFields($level) < ($i+3)) {
$new_lvl=getLevel($i,$level);
echo '<div class="pole_img pole_kupit" style="top: -265px; left: 232px;">';
echo '<span class="text">Купить c '; echo getLevel($i+3); echo' уровня</span>';
}else{

echo '<div id="pole_';echo $i+3; echo '" class="pole_img '.pole_class("$login", $i+3).'" title="Кликай на поле для посева или сбора урожая!" style="top: -265px; left: 232px;">';
echo '<div class="click_div" onclick="pay_pol(';echo $i+3; echo ');"></div>';
}
echo '</div>';
if(getAllFields($level) < ($i+4)) {
$new_lvl=getLevel($i,$level);
echo '<div class="pole_img pole_kupit" style="top: -324px; left: 162px;">';
echo '<span class="text">Купить c '; echo getLevel($i+4); echo' уровня</span>';
}else{

echo '<div id="pole_';echo $i+4; echo '" class="pole_img '.pole_class("$login", $i+4).'" title="Кликай на поле для посева или сбора урожая!" style="top: -324px; left: 162px;">';
echo '<div class="click_div" onclick="pay_pol(';echo $i+4; echo ');"></div>';
}
echo '</div>';
if(getAllFields($level) < ($i+5)) {
echo '<div class="pole_img pole_kupit" style="top: -381px; left: 91px;">';
echo '<span class="text">Купить c '; echo getLevel($i+5); echo' уровня</span>';
}else{

echo '<div id="pole_';echo $i+5; echo '" class="pole_img '.pole_class("$login", $i+5).'" title="Кликай на поле для посева или сбора урожая!" style="top: -381px; left: 91px;">';
echo '<div class="click_div" onclick="pay_pol(';echo $i+5; echo ');"></div>';
}
echo '</div>';
if(getAllFields($level) < ($i+6)) {
echo '<div class="pole_img pole_kupit" style="top: -530px; left: 310px;">';
echo '<span class="text">Купить c '; echo getLevel($i+6); echo' уровня</span>';
}else{

echo '<div id="pole_';echo $i+6; echo '" class="pole_img '.pole_class("$login", $i+6).'" title="Кликай на поле для посева или сбора урожая!" style="top: -530px; left: 310px;">';
echo '<div class="click_div" onclick="pay_pol(';echo $i+6; echo ');"></div>';
}
echo '</div>';
if(getAllFields($level)< ($i+7)) {
echo '<div class="pole_img pole_kupit" style="top: -588px; left: 239px;">';
echo '<span class="text">Купить c '; echo getLevel($i+7); echo' уровня</span>';
}else{

echo '<div id="pole_';echo $i+7; echo '" class="pole_img '.pole_class("$login", $i+7).'" title="Кликай на поле для посева или сбора урожая!" style="top: -588px; left: 239px;">';
echo '<div class="click_div" onclick="pay_pol(';echo $i+7; echo ');"></div>';
}
echo '</div>';
if(getAllFields($level) < ($i+8)) {
echo '<div class="pole_img pole_kupit" style="top: -647px; left: 169px;">';
echo '<span class="text">Купить c '; echo getLevel($i+8); echo' уровня</span>';
} else {
echo '<div id="pole_';echo $i+8; echo '" class="pole_img '.pole_class("$login", $i+8).'" title="Кликай на поле для посева или сбора урожая!" style="top: -647px; left: 169px;">';
echo '<div class="click_div" onclick="pay_pol(';echo $i+8; echo ');"></div>';
}
echo '</div>';
?>


</div></div>
<? } ?>
</div>

</div>









<div class="clear"></div>
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
<script type="text/javascript"src="/js/obr.js"></script>