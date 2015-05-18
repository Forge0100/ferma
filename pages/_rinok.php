<center>  <div class="tegname"><h2>Скотский рынок</h2></div><br> </center>
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
$page = 'Рынок';
?>
<?php
error_reporting (1);
//Цены
$row = $db->getRow("SELECT `id`, `level`, `reyting` FROM `tb_users` WHERE `id` = ?i", $usid);
$user_id = $row['id'];
$level = $row["level"];
$rating = $row["reyting"];

$islvlup = false;
$cena = $db->getRow("SELECT * FROM tb_price");
$ref_id = $us_data['ref_id']; 
$date = time();
//$refname = mysql_fetch_assoc(mysql_query("SELECT `username` FROM tb_users WHERE id = '$ref_id'")) or die(mysql_error());

if (isset($_POST['type_j'])) {
 if($_POST['type_j'] == 'kurita') {
$kol = intval($_POST['kol']);
$cen = $cena['kurita'];
$ful_price = $kol * $cen;


	if($us_data['money'] >= ($kol * $cen)) {
	
		if($us_data['energy'] >= $kol) {
			
		  if($kol > 0) {
			$rating = $rating + $kol;
			$db->query("UPDATE tb_users SET money = money - ?i, kurita = kurita + ?i, energy = energy - ?i, reyting = ?i WHERE id = ?i", $ful_price, $kol, $kol, $rating, $usid);
			if($lvlup = IsLevelUp($level, $rating, $user_id)) 
			{
				$islvlup = "Поздравляем вы перешли на уровень ($lvlup)";
			}
			$ref_sum = $ful_price * 0.05;
			$db->query("UPDATE `tb_users` SET `money_out` = `money_out` + ?i, `ref_money` = `ref_money` + ?i WHERE id = ?i LIMIT 1", $ref_sum, $ref_sum, $ref_id);
			$rez_lavka = $ful_price * 0.01;
			
			$admin = $ref_sum + $rez_lavka;
			$db->query("update `tb_users` set `money_out` = `money_out` + ?i where `id` = '1'", $admin);
			$db->query("insert into `tb_history` SET ?u", array('user_id' => '1', 'summa' => $admin, 'date' => $date, 'comment' => 'Покупка животных: курица, рефералом $login', 'type' => 'ref'));
			
			$rez = $ful_price - $admin;
			$db->query("UPDATE `tb_lavka` SET `rezerv` = `rezerv` + ?i WHERE id = 1", $rez);
			//mysql_query("INSERT INTO tb_history (user_id, summa, date, comment, type) VALUES ('$ref_id', '$ref_sum', '$date', 'Покупка животных рефералом $login', 'ref')") or die(mysql_error());
			$db->query("insert into `tb_history` SET ?u", array('user_id' => $usid, 'summa' => $ful_price, 'date' => $date, 'comment' => 'Покупка животных у системы', 'type' => 'pocupka'));
			$db->query("INSERT INTO tb_stat_z SET ?u", array('date' => time(), 'login' => $login, 'type' => '1', 'kol' => $kol));
			$q = $db->query("SELECT * FROM tb_stat_and ORDER BY id DESC LIMIT 1");
									$w = $db->fetch($q);
									if(time() - $w['date'] > 86400 or ($db->numRows($q) == 0)) {
									$db->query("INSERT INTO tb_stat_and (date, q1, q2, q3, q4, q5, q6) VALUES (?s, ?i, '0', '0', '0', '0', '0')", time(), $kol);
									
									}else{
									$db->query("UPDATE tb_stat_and SET q1 = q1 + ?i WHERE id = ?i", $kol, $w['id']);
									
									}
			
			echo '<font color="green">Вы успешно купили '.$kol.' куриц!</font> <a href="/rinok">>>> Продолжить!</a>';
			
		  }else echo '<font color="red">Не верное колличество куриц!</font> <a href="/rinok"><<< Назад!</a>';	
			
		}else echo '<font color="red">Не достаточно энергии!</font> <a href="/rinok"><<< Назад!</a>';
		
	}else echo '<font color="red">Не достаточно средств для покупки!</font> <a href="/rinok"><<< Назад!</a>';
	
 
 }
 
 
  if($_POST['type_j'] == 'svinya') {
$kol = intval($_POST['kol']);
$cen = $cena['svinya'];
$ful_price = $kol * $cen;
	if($us_data['money'] >= ($kol * $cen)) {
	
		if($us_data['energy'] >= $kol) {
		if($kol > 0) {
			$rating = $rating + $kol;
			$db->query("UPDATE tb_users SET money = money - ?i, svinya = svinya + ?i, energy = energy - ?i, reyting = ?i WHERE id = ?i", $ful_price, $kol, $kol, $rating, $usid);
			if($lvlup = IsLevelUp($level, $rating, $user_id)) 
			{
				$islvlup = "Поздравляем вы перешли на уровень ($lvlup)";
			}
			$ref_sum = $ful_price * 0.05;
			$db->query("UPDATE `tb_users` SET `money_out` = `money_out` + ?i, `ref_money` = `ref_money` + ?i WHERE id = ?i LIMIT 1", $ref_sum, $ref_sum, $ref_id);
			$rez_lavka = $ful_price * 0.01;
			
			$admin = $ref_sum + $rez_lavka;
			$db->query("update `tb_users` set `money_out` = `money_out` + ?i where `id` = '1'", $admin);
			$db->query("insert into `tb_history` SET ?u", array('user_id' => '1', 'summa' => $admin, 'date' => $date, 'comment' => 'Покупка животных: бычок, рефералом $login', 'type' => 'ref'));
			
			$rez = $ful_price - $admin;
			$db->query("UPDATE `tb_lavka` SET `rezerv` = `rezerv` + ?i WHERE id = 1", $rez);
			//mysql_query("INSERT INTO tb_history (user_id, summa, date, comment, type) VALUES ('$ref_id', '$ref_sum', '$date', 'Покупка животных рефералом $login', 'ref')") or die(mysql_error());
			$db->query("insert into `tb_history` SET ?u", array('user_id' => $usid, 'summa' => $ful_price, 'date' => $date, 'comment' => 'Покупка животных у системы', 'type' => 'pocupka'));
			$db->query("INSERT INTO tb_stat_z SET ?u", array('date' => time(), 'login' => $login, 'type' => '2', 'kol' => $kol));
			$q = $db->query("SELECT * FROM tb_stat_and ORDER BY id DESC LIMIT 1");
									$w = $db->fetch($q);
									if(time() - $w['date'] > 86400 or ($db->numRows($q) == 0)) {
									$db->query("INSERT INTO tb_stat_and (date, q1, q2, q3, q4, q5, q6) VALUES (?s, '0', ?i, '0', '0', '0', '0')", time(), $kol);
									
									}else{
									$db->query("UPDATE tb_stat_and SET q2 = q2 + ?i WHERE id = ?i", $kol, $w['id']);
									
									}
			
			echo '<font color="green">Вы успешно купили '.$kol.' бычков</font> <a href="/rinok">>>> Продолжить!</a>';
			 }else echo '<font color="red">Не верное колличество бычков!</font> <a href="/rinok"><<< Назад!</a>';	
		}else echo '<font color="red">Не достаточно энергии!</font> <a href="/rinok"><<< Назад!</a>';
		
	}else echo '<font color="red">Не достаточно средств для покупки!</font> <a href="/rinok"><<< Назад!</a>';
	
 
 }
 
 
 
   if($_POST['type_j'] == 'ovta') {
$kol = intval($_POST['kol']);
$cen = $cena['ovta'];
$ful_price = $kol * $cen;
	if($us_data['money'] >= ($kol * $cen)) {
	
		if($us_data['energy'] >= $kol) {
		if($kol > 0) {
			$rating = $rating + $kol;
			$db->query("UPDATE tb_users SET money = money - ?i, ovta = ovta + ?i, energy = energy - ?i, reyting = ?i WHERE id = ?i", $ful_price, $kol, $kol, $rating, $usid);
			if($lvlup = IsLevelUp($level, $rating, $user_id)) 
			{
				$islvlup = "Поздравляем вы перешли на уровень ($lvlup)";
			}
			$ref_sum = $ful_price * 0.05;
			$db->query("UPDATE `tb_users` SET `money_out` = `money_out` + ?i, `ref_money` = `ref_money` + ?i WHERE id = ?i LIMIT 1", $ref_sum, $ref_sum, $ref_id);
			$rez_lavka = $ful_price * 0.01;
			
			$admin = $ref_sum + $rez_lavka;
			$db->query("update `tb_users` set `money_out` = `money_out` + ?i where `id` = '1'", $admin);
			$db->query("insert into `tb_history` SET ?u", array('user_id' => '1', 'summa' => $admin, 'date' => $date, 'comment' => 'Покупка животных: бычок, рефералом $login', 'type' => 'ref'));
			
			$rez = $ful_price - $admin;
			$db->query("UPDATE `tb_lavka` SET `rezerv` = `rezerv` + ?i WHERE id = 1", $rez);
			//mysql_query("INSERT INTO tb_history (user_id, summa, date, comment, type) VALUES ('$ref_id', '$ref_sum', '$date', 'Покупка животных рефералом $login', 'ref')") or die(mysql_error());
			$db->query("insert into `tb_history` SET ?u", array('user_id' => $usid, 'summa' => $ful_price, 'date' => $date, 'comment' => 'Покупка животных у системы', 'type' => 'pocupka'));
			$db->query("INSERT INTO tb_stat_z SET ?u", array('date' => time(), 'login' => $login, 'type' => '3', 'kol' => $kol));
			$q = $db->query("SELECT * FROM tb_stat_and ORDER BY id DESC LIMIT 1");
									$w = $db->fetch($q);
									if(time() - $w['date'] > 86400 or ($db->numRows($q) == 0)) {
									$db->query("INSERT INTO tb_stat_and (date, q1, q2, q3, q4, q5, q6) VALUES (?s, '0', '0', ?i, '0', '0', '0')", time(), $kol);
									
									}else{
									$db->query("UPDATE tb_stat_and SET q3 = q3 + ?i WHERE id = ?i", $kol, $w['id']);
									
									}
			echo '<font color="green">Вы успешно купили '.$kol.' коз</font> <a href="/rinok">>>> Продолжить!</a>';
			 }else echo '<font color="red">Не верное колличество коз!</font> <a href="/rinok"><<< Назад!</a>';	
		}else echo '<font color="red">Не достаточно энергии!</font> <a href="/rinok"><<< Назад!</a>';
		
	}else echo '<font color="red">Не достаточно средств для покупки!</font> <a href="/rinok"><<< Назад!</a>';
	
 
 }
 
 
 
    if($_POST['type_j'] == 'karova') {
$kol = intval($_POST['kol']);
$cen = $cena['karova'];
$ful_price = $kol * $cen;
	if($us_data['money'] >= ($kol * $cen)) {
	
		if($us_data['energy'] >= $kol) {
		if($kol > 0) {
			$rating = $rating + $kol;
			$db->query("UPDATE tb_users SET money = money - ?i, karova = karova + ?i, energy = energy - ?i, reyting = ?i WHERE id = ?i", $ful_price, $kol, $kol, $rating, $usid);
			if($lvlup = IsLevelUp($level, $rating, $user_id)) 
			{
				$islvlup = "Поздравляем вы перешли на уровень ($lvlup)";
			}
			$ref_sum = $ful_price * 0.05;
			$db->query("UPDATE `tb_users` SET `money_out` = `money_out` + ?i, `ref_money` = `ref_money` + ?i WHERE id = ?i LIMIT 1", $ref_sum, $ref_sum, $ref_id);
			$rez_lavka = $ful_price * 0.01;
			
			$admin = $ref_sum + $rez_lavka;
			$db->query("update `tb_users` set `money_out` = `money_out` + ?i where `id` = '1'", $admin);
			$db->query("insert into `tb_history` SET ?u", array('user_id' => '1', 'summa' => $admin, 'date' => $date, 'comment' => 'Покупка животных: бычок, рефералом $login', 'type' => 'ref'));
			
			$rez = $ful_price - $admin;
			$db->query("UPDATE `tb_lavka` SET `rezerv` = `rezerv` + ?i WHERE id = 1", $rez);
			//mysql_query("INSERT INTO tb_history (user_id, summa, date, comment, type) VALUES ('$ref_id', '$ref_sum', '$date', 'Покупка животных рефералом $login', 'ref')") or die(mysql_error());
			$db->query("insert into `tb_history` SET ?u", array('user_id' => $usid, 'summa' => $ful_price, 'date' => $date, 'comment' => 'Покупка животных у системы', 'type' => 'pocupka'));
			$db->query("INSERT INTO tb_stat_z SET ?u", array('date' => time(), 'login' => $login, 'type' => '4', 'kol' => $kol));
			$q = $db->query("SELECT * FROM tb_stat_and ORDER BY id DESC LIMIT 1");
									$w = $db->fetch($q);
									if(time() - $w['date'] > 86400 or ($db->numRows($q) == 0)) {
									$db->query("INSERT INTO tb_stat_and (date, q1, q2, q3, q4, q5, q6) VALUES (?s, '0', '0', '0', ?i, '0', '0')", time(), $kol);
									
									}else{
									$db->query("UPDATE tb_stat_and SET q4 = q4 + ?i WHERE id = ?i", $kol, $w['id']);
									
									}
			echo '<font color="green">Вы успешно купили '.$kol.' коров</font> <a href="/rinok">>>> Продолжить!</a>';
			 }else echo '<font color="red">Не верное колличество коров!</font> <a href="/rinok"><<< Назад!</a>';	
		}else echo '<font color="red">Не достаточно энергии!</font> <a href="/rinok"><<< Назад!</a>';
		
	}else echo '<font color="red">Не достаточно средств для покупки!</font> <a href="/rinok"><<< Назад!</a>';
	
 
 }
 
 
     if($_POST['type_j'] == 'lama') {
$kol = intval($_POST['kol']);
$cen = $cena['lama'];
$ful_price = $kol * $cen;
	if($us_data['money'] >= ($kol * $cen)) {
	
		if($us_data['energy'] >= $kol) {
		if($kol > 0) {
			$rating = $rating + $kol;
			$db->query("UPDATE tb_users SET money = money - ?i, lama = lama + ?i, energy = energy - ?i, reyting = ?i WHERE id = ?i", $ful_price, $kol, $kol, $rating, $usid);
			if($lvlup = IsLevelUp($level, $rating, $user_id)) 
			{
				$islvlup = "Поздравляем вы перешли на уровень ($lvlup)";
			}
			$ref_sum = $ful_price * 0.05;
			$db->query("UPDATE `tb_users` SET `money_out` = `money_out` + ?i, `ref_money` = `ref_money` + ?i WHERE id = ?i LIMIT 1", $ref_sum, $ref_sum, $ref_id);
			$rez_lavka = $ful_price * 0.01;
			
			$admin = $ref_sum + $rez_lavka;
			$db->query("update `tb_users` set `money_out` = `money_out` + ?i where `id` = '1'", $admin);
			$db->query("insert into `tb_history` SET ?u", array('user_id' => '1', 'summa' => $admin, 'date' => $date, 'comment' => 'Покупка животных: бычок, рефералом $login', 'type' => 'ref'));
			
			$rez = $ful_price - $admin;
			$db->query("UPDATE `tb_lavka` SET `rezerv` = `rezerv` + ?i WHERE id = 1", $rez);
			//mysql_query("INSERT INTO tb_history (user_id, summa, date, comment, type) VALUES ('$ref_id', '$ref_sum', '$date', 'Покупка животных рефералом $login', 'ref')") or die(mysql_error());
			$db->query("insert into `tb_history` SET ?u", array('user_id' => $usid, 'summa' => $ful_price, 'date' => $date, 'comment' => 'Покупка животных у системы', 'type' => 'pocupka'));
			$db->query("INSERT INTO tb_stat_z SET ?u", array('date' => time(), 'login' => $login, 'type' => '5', 'kol' => $kol));
			$q = $db->query("SELECT * FROM tb_stat_and ORDER BY id DESC LIMIT 1");
									$w = $db->fetch($q);
									if(time() - $w['date'] > 86400 or ($db->numRows($q) == 0)) {
									$db->query("INSERT INTO tb_stat_and (date, q1, q2, q3, q4, q5, q6) VALUES (?s, '0', '0', '0', '0', ?i, '0')", time(), $kol);
									
									}else{
									$db->query("UPDATE tb_stat_and SET q5 = q5 + ?i WHERE id = ?i", $kol, $w['id']);
									
									}
			echo '<font color="green">Вы успешно купили '.$kol.' лам</font> <a href="/rinok">>>> Продолжить!</a>';
			 }else echo '<font color="red">Не верное колличество лам!</font> <a href="/rinok"><<< Назад!</a>';	
		}else echo '<font color="red">Не достаточно энергии!</font> <a href="/rinok"><<< Назад!</a>';
		
	}else echo '<font color="red">Не достаточно средств для покупки!</font> <a href="/rinok"><<< Назад!</a>';
	
 
 }
 
 
 
 
 if($_POST['type_j'] == 'slon') {
$kol = intval($_POST['kol']);
$cen = $cena['slon'];
$ful_price = $kol * $cen;
	if($us_data['money'] >= ($kol * $cen)) {
	
		if($us_data['energy'] >= $kol) {
		if($kol > 0) {
			$rating = $rating + $kol;
			$db->query("UPDATE tb_users SET money = money - ?i, slon = slon + ?i, energy = energy - ?i, reyting = ?i WHERE id = ?i", $ful_price, $kol, $kol, $rating, $usid);
			if($lvlup = IsLevelUp($level, $rating, $user_id)) 
			{
				$islvlup = "Поздравляем вы перешли на уровень ($lvlup)";
			}
			$ref_sum = $ful_price * 0.05;
			$db->query("UPDATE `tb_users` SET `money_out` = `money_out` + ?i, `ref_money` = `ref_money` + ?i WHERE id = ?i LIMIT 1", $ref_sum, $ref_sum, $ref_id);
			$rez_lavka = $ful_price * 0.01;
			
			$admin = $ref_sum + $rez_lavka;
			$db->query("update `tb_users` set `money_out` = `money_out` + ?i where `id` = '1'", $admin);
			$db->query("insert into `tb_history` SET ?u", array('user_id' => '1', 'summa' => $admin, 'date' => $date, 'comment' => 'Покупка животных: бычок, рефералом $login', 'type' => 'ref'));
			
			$rez = $ful_price - $admin;
			$db->query("UPDATE `tb_lavka` SET `rezerv` = `rezerv` + ?i WHERE id = 1", $rez);
			//mysql_query("INSERT INTO tb_history (user_id, summa, date, comment, type) VALUES ('$ref_id', '$ref_sum', '$date', 'Покупка животных рефералом $login', 'ref')") or die(mysql_error());
			$db->query("insert into `tb_history` SET ?u", array('user_id' => $usid, 'summa' => $ful_price, 'date' => $date, 'comment' => 'Покупка животных у системы', 'type' => 'pocupka'));
			$db->query("INSERT INTO tb_stat_z SET ?u", array('date' => time(), 'login' => $login, 'type' => '6', 'kol' => $kol));
			$q = $db->query("SELECT * FROM tb_stat_and ORDER BY id DESC LIMIT 1");
									$w = $db->fetch($q);
									if(time() - $w['date'] > 86400 or ($db->numRows($q) == 0)) {
									$db->query("INSERT INTO tb_stat_and (date, q1, q2, q3, q4, q5, q6) VALUES (?s, '0', '0', '0', '0', '0', ?i)", time(), $kol);
									
									}else{
									$db->query("UPDATE tb_stat_and SET q6 = q6 + ?i WHERE id = ?i", $kol, $w['id']);
									
									}
			echo '<font color="green">Вы успешно купили '.$kol.' слонов</font> <a href="/rinok">>>> Продолжить!</a>';
			 }else echo '<font color="red">Не верное колличество слонов!</font> <a href="/rinok"><<< Назад!</a>';	
		}else echo '<font color="red">Не достаточно энергии!</font> <a href="/rinok"><<< Назад!</a>';
		
	}else echo '<font color="red">Не достаточно средств для покупки!</font> <a href="/rinok"><<< Назад!</a>';
	
 
 }


} else {
?>

<style>
.buttonssilka {
color: #502e24;
text-decoration: underline;	
cursor: pointer;
font-size: 12px;
}

.buttonssilka:hover {
color: #8e4733;
text-decoration: none;
cursor: pointer;
font-size: 12px;
}
</style>

<script language="JavaScript"> 
function show(obj) { 
if (document.getElementById(obj).style.display == 'none') 
document.getElementById(obj).style.display = 'block'; 
else document.getElementById(obj).style.display = 'none'; 
} 
</script> 
<span id="123456" style="display: block;">
<h3>Выберите животное</h3>




		<div>
			<div class="bgmain5n">
				<div class="bgmainc1">
					<span onclick="show('1');show('123456')"><a onclick="return false" ><img title="" alt="" style="cursor: pointer;" src="/animals/kurita.png"></a></span>
					
				</div>
				<div class="bgmain5nn">
					 <?=$cena['kurita']; ?>p
				</div>
			</div>
			<div class="bgmain5n">
				<div class="bgmainc1">
					<span onclick="show('2');show('123456')"><a onclick="return false" ><img title="" alt="" style="cursor: pointer;" src="/animals/svinya.png"></a></span>
				</div>
				<div class="bgmain5nn">
					<?=$cena['svinya']; ?>p
				</div>
			</div>
			<div class="bgmain5n">
				<div class="bgmainc1">
					<span onclick="show('3');show('123456')"><a onclick="return false" ><img title="" alt="" style="cursor: pointer;" src="/animals/ovta.png"></a></span>
				</div>
				<div class="bgmain5nn">
					<?=$cena['ovta']; ?>p
				</div>
			</div>
			<div class="bgmain5n">
				<div class="bgmainc1">
					<span onclick="show('4');show('123456')"><a onclick="return false" ><img title="" alt="" style="cursor: pointer;" src="/animals/karova.png"></a></span>
				</div>
				<div class="bgmain5nn">
					<?=$cena['karova']; ?>p
				</div>
			</div>
			
			</div>
			</div>
			</span>
			
			<span id="1" style="display: none;">
			<hr>
					<h3>Покупка кур</h3>		
					
					<div class="bgmain5n">
			<div class="bgmainc1">
				<img title="" alt="" src="/animals/kurita.png">
			</div>
			<div class="bgmain5nn">
				<?=$cena['kurita']; ?>р			</div>
		</div>
		<div class="forma">
		
		<b>У вас в наличии:</b><br />
		Кур: <?=$us_data['kurita']; ?><br>
		Стоимость: <?=$cena['kurita']; ?> руб<br>
					
		<form method="post" action="?ac=kurita">
		<label>Количество</label>
			<input type="text" name="kol" value="1" size="5" maxlength="5">
			<input type="hidden" name="type_j" value="kurita">
			<label></label>
			<input type="submit" name="buy_system" value="Купить" class="menubtn">
		</form>
		<br>Сосед-реферер получает 5% от покупки животных.<br> За покупку животного забирается 1 ед энергии и дается 1 ед опыта.<br>
		</div>
		<br>
		<input type="submit" class="buttonssilka" onclick="show('1');show('123456')" value="<<< Назад к выбору животных">
		</span>
		
		
					<span id="2" style="display: none;">
			<hr>
					<h3>Покупка Свиней</h3>		
					
					<div class="bgmain5n">
			<div class="bgmainc1">
				<img title="" alt="" src="/animals/svinya.png">
			</div>
			<div class="bgmain5nn">
				<?=$cena['svinya']; ?>р			</div>
		</div>
		<div class="forma">
		
		<b>У вас в наличии:</b><br />
		Свиней: <?=$us_data['svinya']; ?><br>
		Стоимость: <?=$cena['svinya']; ?> руб<br>
					
		<form method="post" action="?ac=svin">
		<label>Количество</label>
			<input type="text" name="kol" value="1" size="5" maxlength="5">
			<input type="hidden" name="type_j" value="svinya">
			<label></label>
			<input type="submit" name="buy_system" value="Купить" class="menubtn">
		</form>
		<br>Сосед-реферер получает 5% от покупки животных.<br> За покупку животного забирается 1 ед энергии и дается 1 ед опыта.<br>
		</div>
		<br>
		<input type="submit" class="buttonssilka" onclick="show('2');show('123456')" value="<<< Назад к выбору животных">
		</span>
		
		
		
					<span id="3" style="display: none;">
			<hr>
					<h3>Покупка Овец</h3>		
					
					<div class="bgmain5n">
			<div class="bgmainc1">
				<img title="" alt="" src="/animals/ovta.png">
			</div>
			<div class="bgmain5nn">
				<?=$cena['ovta']; ?>р			</div>
		</div>
		<div class="forma">
		
		<b>У вас в наличии:</b><br />
		Овец: <?=$us_data['ovta']; ?><br>
		Стоимость: <?=$cena['ovta']; ?> руб<br>
					
		<form method="post" action="?ac=ovta">
		<label>Количество</label>
			<input type="text" name="kol" value="1" size="5" maxlength="5">
			<input type="hidden" name="type_j" value="ovta">
			<label></label>
			<input type="submit" name="buy_system" value="Купить" class="menubtn">
		</form>
		<br>Сосед-реферер получает 5% от покупки животных.<br> За покупку животного забирается 1 ед энергии и дается 1 ед опыта.<br>
		</div>
		<br>
		<input type="submit" class="buttonssilka" onclick="show('3');show('123456')" value="<<< Назад к выбору животных">
		</span>
		
		
		
					<span id="4" style="display: none;">
			<hr>
					<h3>Покупка Коров</h3>		
					
					<div class="bgmain5n">
			<div class="bgmainc1">
				<img title="" alt="" src="/animals/karova.png">
			</div>
			<div class="bgmain5nn">
				<?=$cena['karova']; ?>р			</div>
		</div>
		<div class="forma">
		
		<b>У вас в наличии:</b><br />
		Коров: <?=$us_data['karova']; ?><br>
		Стоимость: <?=$cena['karova']; ?> руб<br>
					
		<form method="post" action="?ac=korova">
		<label>Количество</label>
			<input type="text" name="kol" value="1" size="5" maxlength="5">
			<input type="hidden" name="type_j" value="karova">
			<label></label>
			<input type="submit" name="buy_system" value="Купить" class="menubtn">
		</form>
		<br>Сосед-реферер получает 5% от покупки животных.<br> За покупку животного забирается 1 ед энергии и дается 1 ед опыта.<br>
		</div>
		<br>
		<input type="submit" class="buttonssilka" onclick="show('4');show('123456')" value="<<< Назад к выбору животных">
		</span>
		
		
		
		
					
		
		
	<?php } ?>	
	
<?php if($islvlup) : ?>	
<link rel="stylesheet" href="/simplemodal/demo.css?v=2">
<script type="text/javascript" src="/simplemodal/demo.js"></script>
<div class="overlay-container">
		<div class="window-container zoomin">
			<h3><?php echo $islvlup; ?></h3> 
			<div align=center>

				<span class="closeWindow">Закрыть</span>
			</div>
		</div>
	</div>		
<?php endif; ?>		
