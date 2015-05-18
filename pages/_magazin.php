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
$page = 'Магазин';
$rez = $db->getRow("SELECT * FROM tb_lavka WHERE id = 1");
$cena = $db->getRow("SELECT * FROM tb_price");
$date = time();

if(isset($_POST['kupiti']) or isset($_POST['prodati'])) {


if(isset($_POST['prodati'])) {
$type = intval($_POST['type']);
$kol = intval($_POST['kol']);

	if ($type == 4) {//Udobrenie
	//$cen = $cena['sir_p'];
	$sum = $kol * $cena['udob_p'];
		if($us_data['udobrenie'] >= $kol) {
			if($kol >= 100) {
				if($us_data['energy'] >= 10) {
					$db->query("UPDATE tb_users SET udobrenie = udobrenie - ?i, energy = energy - '10', reyting = reyting +'1' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $usid, $login);
					$qq = $db->query("SELECT * FROM tb_magazin WHERE type = '4' AND user_id = ?i", $usid);
					if($db->numRows($qq) > 0) {
					$ww = $db->fetch($qq);
					$kol_u = $ww['koll'];
					$id_u = $ww['id'];
					$kolll = $kol + $kol_u;
					$db->query("INSERT INTO tb_magazin SET ?u", array('type' => $type, 'koll' => $kolll, 'date' => $date, 'user_id' => $usid, 'status' => '0'));
					$db->query("DELETE FROM tb_magazin WHERE id = ?i", $id_u);
					} else {
					$db->query("INSERT INTO tb_magazin SET ?u", array('type' => $type, 'koll' => $kol, 'date' => $date, 'user_id' => $usid, 'status' => '0'));
					}
					//mysql_query("INSERT INTO tb_magazin (type, koll, date, user_id) VALUE ('$type', '$kol', '$date', '$usid')") or die(mysql_error());
					echo '<font color="green">Вы успешно выставили в очередь на продажу '.$kol.' удобрений на сумму '.$sum.' руб.</font>';
					echo '<br><a href="/magazin"><font color="red">Продолжить >>></font></a>';
				}else echo '<font color="red">Не достаточно энергии</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для продажи 100 коробок удобрений</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно удобрений на складе</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
	
	}
	
	
	if ($type == 1) {//Meh
	//$cen = $cena['sir_p'];
	$sum = $kol * $cena['meh_p'];
		if($us_data['meh'] >= $kol) {
			if($kol >= 100) {
				if($us_data['energy'] >= 10) {
					$db->query("UPDATE tb_users SET meh = meh - ?i, energy = energy - '10', reyting = reyting +'1' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $usid, $login);
					$qq = $db->query("SELECT * FROM tb_magazin WHERE type = '1' AND user_id = ?i", $usid);
					if($db->numRows($qq) > 0) {
					$ww = $db->fetch($qq);
					$kol_u = $ww['koll'];
					$id_u = $ww['id'];
					$kolll = $kol + $kol_u;
					$db->query("INSERT INTO tb_magazin SET ?u", array('type' => $type, 'koll' => $kolll, 'date' => $date, 'user_id' => $usid, 'status' => '0'));
					$db->query("DELETE FROM tb_magazin WHERE id = ?i", $id_u);
					} else {
					$db->query("INSERT INTO tb_magazin SET ?u", array('type' => $type, 'koll' => $kol, 'date' => $date, 'user_id' => $usid, 'status' => '0'));
					}
					//mysql_query("INSERT INTO tb_magazin (type, koll, date, user_id) VALUE ('$type', '$kol', '$date', '$usid')");
					echo '<font color="green">Вы успешно выставили в очередь на продажу '.$kol.' меха на сумму '.$sum.' руб.</font>';
					echo '<br><a href="/magazin"><font color="red">Продолжить >>></font></a>';
				}else echo '<font color="red">Не достаточно энергии</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для продажи 100 меха</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно меха на складе</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 2) {//Навоз
	//$cen = $cena['sir_p'];
	$sum = $kol * $cena['navoz_p'];
		if($us_data['navoz'] >= $kol) {
			if($kol >= 100) {
				if($us_data['energy'] >= 10) {
					$db->query("UPDATE tb_users SET navoz = navoz - ?i, energy = energy - '10', reyting = reyting +'1' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $usid, $login);
					$qq = $db->query("SELECT * FROM tb_magazin WHERE type = '2' AND user_id = ?i", $usid);
					if($db->numRows($qq) > 0) {
					$ww = $db->fetch($qq);
					$kol_u = $ww['koll'];
					$id_u = $ww['id'];
					$kolll = $kol + $kol_u;
					$db->query("INSERT INTO tb_magazin SET ?u", array('type' => $type, 'koll' => $kolll, 'date' => $date, 'user_id' => $usid, 'status' => '0'));
					$db->query("DELETE FROM tb_magazin WHERE id = ?i", $id_u);
					} else {
					$db->query("INSERT INTO tb_magazin SET ?u", array('type' => $type, 'koll' => $kol, 'date' => $date, 'user_id' => $usid, 'status' => '0'));
					}
					//mysql_query("INSERT INTO tb_magazin (type, koll, date, user_id) VALUE ('$type', '$kol', '$date', '$usid')");
					echo '<font color="green">Вы успешно выставили в очередь на продажу '.$kol.' навоза на сумму '.$sum.' руб.</font>';
					echo '<br><a href="/magazin"><font color="red">Продолжить >>></font></a>';
				}else echo '<font color="red">Не достаточно энергии</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для продажи 100 навоза</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно навоза на складе</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
	
	}
	
	
	if ($type == 3) {//Варежки
	//$cen = $cena['sir_p'];
	$sum = $kol * $cena['varezki_p'];
		if($us_data['varezhki'] >= $kol) {
			if($kol >= 100) {
				if($us_data['energy'] >= 10) {
					$db->query("UPDATE tb_users SET varezhki = varezhki - ?i, energy = energy - '10', reyting = reyting +'1' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $usid, $login);
					$qq = $db->query("SELECT * FROM tb_magazin WHERE type = '3' AND user_id = ?i", $usid);
					if($db->numRows($qq) > 0) {
					$ww = $db->fetch($qq);
					$kol_u = $ww['koll'];
					$id_u = $ww['id'];
					$kolll = $kol + $kol_u;
					$db->query("INSERT INTO tb_magazin SET ?u", array('type' => $type, 'koll' => $kolll, 'date' => $date, 'user_id' => $usid, 'status' => '0'));
					$db->query("DELETE FROM tb_magazin WHERE id = ?i", $id_u);
					} else {
					$db->query("INSERT INTO tb_magazin SET ?u", array('type' => $type, 'koll' => $kol, 'date' => $date, 'user_id' => $usid, 'status' => '0'));
					}
					//mysql_query("INSERT INTO tb_magazin (type, koll, date, user_id) VALUE ('$type', '$kol', '$date', '$usid')");
					echo '<font color="green">Вы успешно выставили в очередь на продажу '.$kol.' варежек на сумму '.$sum.' руб.</font>';
					echo '<br><a href="/magazin"><font color="red">Продолжить >>></font></a>';
				}else echo '<font color="red">Не достаточно энергии</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для продажи 100 вырежек</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно вырежек на складе</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
	
	}
	
}

if(isset($_POST['kupiti'])) {
$type = intval($_POST['type']);
$kol = intval($_POST['kol']);


	if ($type == 4) {//Udobrenie
	//$cen = $cena['sir_p'];
	$sum = $kol * $cena['udob_b'];
	$sum1 = $kol * $cena['udob_p'];
	$koll = intval($kol * 2000);
		if($us_data['money'] >= $sum) {
			if($kol >= 1) {
				//if($rez['sir'] >= $kol) {
				if($us_data['energy'] >= 10) {
				$res = $db->query("SELECT * FROM tb_magazin WHERE type = '4' AND koll >= ?i AND user_id != ?i ORDER BY date ASC LIMIT 1", $kol, $usid);
				$res1 = $db->fetch($res);
					if($kj = $db->numRows($res) > 0) {
						$kol_type4 = $res1['koll'];
						$id_type4 = $res1['id'];
						$user_id_type4 = $res1['user_id'];
							$db->query("UPDATE tb_users SET money = money - ?i, udob = udob + ?i, energy = energy - '1', reyting = reyting + '1' WHERE id = ?i AND username = ?s LIMIT 1", $sum, $koll, $usid, $login);
							$db->query("UPDATE tb_users SET money_out = money_out + ?i WHERE id = ?i LIMIT 1", $sum1, $user_id_type4);
							$db->query("UPDATE tb_magazin SET koll = koll - ?i WHERE id = ?i", $kol, $id_type4);
							
							$res3 = $db->getRow("SELECT * FROM tb_magazin WHERE id = ?i LIMIT 1", $id_type4);
						if($res3['koll'] <= 0 ) {
						$db->query("DELETE FROM tb_magazin WHERE id = ?i LIMIT 1", $id_type4);
						
						}
							echo '<font color="green">Вы успешно купили '.$kol.' удобрений на сумму '.$sum.' руб.</font>';
							echo '<br><a href="/magazin"><font color="red">Продолжить >>></font></a>';
					}else echo '<font color="red">В очереди магазина нет данного товара или колличество меньше нужного! Зайдите позже или попробуйте купить меньше удобрений!</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">Не достаточно энергии</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
				//}else echo '<font color="red">Резерв лавки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для покупки 1 коробка удобрений</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно средств на балансе</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
	
	}
	
	
	
	if ($type == 3) {//Варежки
	//$cen = $cena['sir_p'];
	$sum = $kol * $cena['varezki_b'];
	$sum1 = $kol * $cena['varezki_p'];
	//$koll = intval($_POST['kol'] * 2000);
		if($us_data['money'] >= $sum) {
			if($kol >= 1) {
				//if($rez['sir'] >= $kol) {
				if($us_data['energy'] >= 10) {
				$res = $db->query("SELECT * FROM tb_magazin WHERE type = '3' AND koll >= ?i AND user_id != ?i ORDER BY date ASC LIMIT 1", $kol, $usid);
				$res1 = $db->fetch($res);
					if($kj = $db->numRows($res) > 0) {
						$kol_type4 = $res1['koll'];
						$id_type4 = $res1['id'];
						$user_id_type4 = $res1['user_id'];
							$db->query("UPDATE tb_users SET money = money - ?i, varezhki_per = varezhki_per + ?i, energy = energy - '10', reyting = reyting + '1' WHERE id = ?i AND username = ?s LIMIT 1", $sum, $koll, $usid, $login);
							$db->query("UPDATE tb_users SET money_out = money_out + ?i WHERE id = ?i LIMIT 1", $sum1, $user_id_type4);
							$db->query("UPDATE tb_magazin SET koll = koll - ?i WHERE id = ?i", $kol, $id_type4);
							
							$res3 = $db->getRow("SELECT * FROM tb_magazin WHERE id = ?i LIMIT 1", $id_type4);
						if($res3['koll'] <= 0 ) {
						$db->query("DELETE FROM tb_magazin WHERE id = ?i LIMIT 1", $id_type4);
						
						}
							echo '<font color="green">Вы успешно купили '.$kol.' варежек на сумму '.$sum.' руб.</font>';
							echo '<br><a href="/magazin"><font color="red">Продолжить >>></font></a>';
					}else echo '<font color="red">В очереди магазина нет данного товара или колличество меньше нужного! Зайдите позже или попробуйте купить меньше удобрений!</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">Не достаточно энергии</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
				//}else echo '<font color="red">Резерв лавки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для покупки 1 варежек</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно средств на балансе</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
	
	}
	
	
	
	if ($type == 2) {//Navoz
	//$cen = $cena['sir_p'];
	$sum = $kol * $cena['navoz_b'];
	$sum1 = $kol * $cena['navoz_p'];
	//$koll = intval($_POST['kol'] * 2000);
		if($us_data['money'] >= $sum) {
			if($kol >= 1) {
				//if($rez['sir'] >= $kol) {
				if($us_data['energy'] >= 10) {
				$res = $db->query("SELECT * FROM tb_magazin WHERE type = '2' AND koll >= ?i AND user_id != ?i ORDER BY date ASC LIMIT 1", $kol, $usid);
				$res1 = $db->fetch($res);
					if($kj = $db->numRows($res) > 0) {
						$kol_type4 = $res1['koll'];
						$id_type4 = $res1['id'];
						$user_id_type4 = $res1['user_id'];
							$db->query("UPDATE tb_users SET money = money - ?i, navoz_per = navoz_per + ?i, energy = energy - '10', reyting = reyting + '1' WHERE id = ?i AND username = ?s LIMIT 1", $sum, $koll, $usid, $login);
							$db->query("UPDATE tb_users SET money_out = money_out + ?i WHERE id = ?i LIMIT 1", $sum1, $user_id_type4);
							$db->query("UPDATE tb_magazin SET koll = koll - ?i WHERE id = ?i", $kol, $id_type4);
							
							$res3 = $db->getRow("SELECT * FROM tb_magazin WHERE id = ?i LIMIT 1", $id_type4);
						if($res3['koll'] <= 0 ) {
						$db->query("DELETE FROM tb_magazin WHERE id = ?i LIMIT 1", $id_type4);
						
						}
							echo '<font color="green">Вы успешно купили '.$kol.' навоза на сумму '.$sum.' руб.</font>';
							echo '<br><a href="/magazin"><font color="red">Продолжить >>></font></a>';
					}else echo '<font color="red">В очереди магазина нет данного товара или колличество меньше нужного! Зайдите позже или попробуйте купить меньше удобрений!</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">Не достаточно энергии</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
				//}else echo '<font color="red">Резерв лавки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для покупки 1 навоза</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно средств на балансе</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
	
	}
	
	
	if ($type == 1) {//Мех
	//$cen = $cena['sir_p'];
	$sum = $kol * $cena['meh_b'];
	$sum1 = $kol * $cena['meh_p'];
	//$koll = intval($_POST['kol'] * 2000);
		if($us_data['money'] >= $sum) {
			if($kol >= 1) {
				//if($rez['sir'] >= $kol) {
				if($us_data['energy'] >= 10) {
				$res = $db->query("SELECT * FROM tb_magazin WHERE type = '1' AND koll >= ?i AND user_id != ?i ORDER BY date ASC LIMIT 1", $kol, $usid);
				$res1 = $db->fetch($res);
					if($kj = $db->numRows($res) > 0) {
						$kol_type4 = $res1['koll'];
						$id_type4 = $res1['id'];
						$user_id_type4 = $res1['user_id'];
							$db->query("UPDATE tb_users SET money = money - ?i, meh_per = meh_per + ?i, energy = energy - '10', reyting = reyting + '1' WHERE id = ?i AND username = ?s LIMIT 1", $sum, $koll, $usid, $login);
							$db->query("UPDATE tb_users SET money_out = money_out + ?i WHERE id = ?i LIMIT 1", $sum1, $user_id_type4);
							$db->query("UPDATE tb_magazin SET koll = koll - ?i WHERE id = ?i", $kol, $id_type4);
							
							$res3 = $db->getRow("SELECT * FROM tb_magazin WHERE id = ?i LIMIT 1", $id_type4);
						if($res3['koll'] <= 0 ) {
						$db->query("DELETE FROM tb_magazin WHERE id = ?i LIMIT 1", $id_type4);
						
						}
							echo '<font color="green">Вы успешно купили '.$kol.' меха на сумму '.$sum.' руб.</font>';
							echo '<br><a href="/magazin"><font color="red">Продолжить >>></font></a>';
					}else echo '<font color="red">В очереди магазина нет данного товара или колличество меньше нужного! Зайдите позже или попробуйте купить меньше удобрений!</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">Не достаточно энергии</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
				//}else echo '<font color="red">Резерв лавки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для покупки 1 меха</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно средств на балансе</font><br><a href="/magazin"><font color="red"><<< Назад</font></a>';
	
	}
	
}


//Конец покупки или продажи

} else {


$rr = $db->getRow("SELECT SUM(koll) AS summeh FROM tb_magazin WHERE type = 1"); //Meh
$rr1 = $db->getRow("SELECT SUM(koll) AS sumnavoz FROM tb_magazin WHERE type = 2"); //Navoz
$rr2 = $db->getRow("SELECT SUM(koll) AS sumvarezh FROM tb_magazin WHERE type = 3"); //Navoz
$rr3 = $db->getRow("SELECT SUM(koll) AS sumudob FROM tb_magazin WHERE type = 4"); //Navoz

$sum_full_m = ($rr['summeh'] * $cena['meh_p']) + ($rr1['sumnavoz'] * $cena['navoz_p']) + ($rr2['sumvarezh'] * $cena['varezki_p']) + ($rr3['sumudob'] * $cena['udob_p']);
?>



В Магазине Вы можете купить или продать навоз, мех, удобрение и варежки.<br>
		Минимальное количество для покупки продуктов 1 ед.<br>
		Минимальное количество для продажи продуктов 100 ед.<br>
		Каждая продажа или покупка забирает 10 ед энергии. А также выставление или снятие ставки с очереди забирает 10 ед энергии.<br>
		
		Одна коробка содержит 2000 ед удобрения<br>			
		<a href="?action=stats">Статистика магазина</a><br><br> 
			<style>

	#birj_table{
		padding:5px;
		width: 240px;
		vertical-align: top!important;
	}
	#table_prod{
		padding-left: 20px;
		padding-top: 5px;
		padding-bottom: 5px;
		vertical-align: top!important;
		text-align: left!important;
	}
	</style>
		<script type="text/javascript" src="/js/noty/jquery.noty.js"></script>
	<script type="text/javascript" src="/js/noty/layouts/top.js"></script>
	<script type="text/javascript" src="/js/noty/themes/default.js"></script>

	
	<script type="text/javascript" src="/js/pole_divs.js"></script>
	<div id="tabs_pole">
		<ul>
			<li class="active"><a href="#mag1"><span>Мех</span></a></li>
			<li><a href="#mag2"><span>Навоз</span></a></li>
			<li><a href="#mag3"><span>Варежки</span></a></li>
			<li><a href="#mag4"><span>Удобрение</span></a></li>
		</ul>
	</div>
	<div class="answer">
			<b class="close">X</b><br />
			</div>
	<div id="tabs_pole_container" style="margin-top: 33px;">
	
				<div id="mag1" class="tab_content">
		<table>
			<tr style="background-color:#0E82A7!important">
				<td id="birj_table">
				<b style="color:#ffffff">Продать продукты</b>
				<td id="birj_table">
				<b style="color:#ffffff">Купить продукты</b>
				</td>
			</tr>
			<tr>
				<td id="birj_table">
				<!------------------------------------------------------->
									<form method="post" id='prodati_1' class="prodatimagazin" action="?action=prodati">					
						<label>Цена продажи Меха: <?=$cena['meh_p']; ?> руб/ед.</label>
						<input type="hidden" name="type" value="1">
						<label>Количество </label>
						<input type="text" value="1" name="kol" size="10">
						<label></label>
						<input type="submit"  name="prodati" value="Продать" class="buttonmail">
					</form>
				
								</td>
				<td id="birj_table">
<!------------------------------------------------------->				
					<form method="post" id='kupit_1' class="kupitimagazin" action="?action=kupit">
						<label>Цена покупки Меха: <?=$cena['meh_b']; ?> руб/ед.</label>
						<input type="hidden" name="type" value="1">
						<label>Количество </label>
						<input type="text" value="1" name="kol" size="10">
						<label></label>
						<input type="submit" name="kupiti" value="Купить" class="buttonmail">
					</form><br>
				</td>
			</tr>
			<tr style="background-color:#0E82A7!important">
				<td id="birj_table">
				<b style="color:#ffffff">На вашем складе </b>
				<td id="birj_table">
				<b style="color:#ffffff">Склад магазина</b>
				</td>
			</tr>
			<tr>
				<td id="table_prod">
				<b>Продуктов для продажи:</b><br>
				Меха: <span id='prod_1'><?=$us_data['meh']; ?></span> ед.<br>		
				<br>
				<b>Продуктов для использования:</b><br>
				Меха: <span id='prodc_1'><?=$us_data['meh_per']; ?></span> ед.<br>
				</td>
				<td id="table_prod">
					<b>Магазин может продать на сумму <?=$sum_full_m; ?> руб:</b><br>
					Из этой суммы:<br>
					Меха: <?=$rr['summeh']; ?> ед.<br>
					Навоза: <?=$rr1['sumnavoz']; ?> ед.<br>
					Варежки: <?=$rr2['sumvarezh']; ?> ед.<br>
					Коробок Удобрения: <?=$rr3['sumudob'];?> ед.<br>
					<br>
				</td>
			</tr>
		</table>
		<br>Очередь:<br><br>
			<table style="width: 100%;">
				<tr>
					<th width="150">Продукт</th>
					<th width="80">Количество</th>
					<th width="150">Дата</th>
				</tr>
				<?php
				$meh = $db->query("SELECT * FROM tb_magazin WHERE type = '1' LIMIT 100");
				if($ff = $db->numRows($meh) <= 0) {
				?>
				<tr id="trid_">
						<td colspan="3">Очередь пуста</td>
						
						</tr>
				<?php
				} else {
				while($meh1 = $db->fetch($meh)) {
				?>
				<tr id="trid_<?=$meh1['id']; ?>">
						<td>Мех <?php
						if($meh1['user_id'] == $usid) { echo '<font color="red"><br>Моя очередь</font>';}
						
						?></td>
						<td id="tdid_1355"><?=$meh1['koll']; ?></td>
						<td><?=date('Y-m-d H:i', $meh1['date']); ?></td>
						</tr>
						<? } }?>
						</table><br>		</div>
				<div id="mag2" class="tab_content">
		<table>
			<tr style="background-color:#0E82A7!important">
				<td id="birj_table">
				<b style="color:#ffffff">Продать продукты</b>
				<td id="birj_table">
				<b style="color:#ffffff">Купить продукты</b>
				</td>
			</tr>
			<tr>
				<td id="birj_table">
				<!------------------------------------------------------->
									<form method="post" id='prodati_2' class="prodatimagazin" action="?action=prodati">					
						<label>Цена продажи Навоза: <?=$cena['navoz_p']; ?> руб/ед.</label>
						<input type="hidden" name="type" value="2">
						<label>Количество </label>
						<input type="text" value="1" name="kol" size="10">
						<label></label>
						<input type="submit"  name="prodati" value="Продать" class="buttonmail">
					</form>
					<!------------------------------------------------------->
				
								</td>
				<td id="birj_table">	
<!------------------------------------------------------->				
					<form method="post" id='kupit_2' class="kupitimagazin" action="?action=kupit">
						<label>Цена покупки Навоза: <?=$cena['navoz_b']; ?> руб/ед.</label>
						<input type="hidden" name="type" value="2">
						<label>Количество </label>
						<input type="text" value="1" name="kol" size="10">
						<label></label>
						<input type="submit" name="kupiti" value="Купить" class="buttonmail">
					</form>
					<!------------------------------------------------------->
					<br>
				</td>
			</tr>
			<tr style="background-color:#0E82A7!important">
				<td id="birj_table">
				<b style="color:#ffffff">На вашем складе </b>
				<td id="birj_table">
				<b style="color:#ffffff">Склад магазина</b>
				</td>
			</tr>
			<tr>
				<td id="table_prod">
				<b>Продуктов для продажи:</b><br>
				Навоза: <span id='prod_2'><?=$us_data['navoz']; ?></span> ед.<br>		
				<br>
				<b>Продуктов для использования:</b><br>
				Навоза: <span id='prodc_2'><?=$us_data['navoz_per']; ?></span> ед.<br>
				</td>
				<td id="table_prod">
					<b>Магазин может продать на сумму <?=$sum_full_m; ?>  руб:</b><br>
					Из этой суммы:<br>
					Меха: <?=$rr['summeh']; ?> ед.<br>
					Навоза: <?=$rr1['sumnavoz']; ?> ед.<br>
					Варежки: <?=$rr2['sumvarezh']; ?> ед.<br>
					Коробок Удобрения: <?=$rr3['sumudob'];?> ед.<br>
					<br>
				</td>
			</tr>
		</table>
		<br>Очередь:<br><br>
			<table style="width: 100%;">
				<tr>
					<th width="150">Продукт</th>
					<th width="80">Количество</th>
					<th width="150">Дата</th>
				</tr><?php
				$nav = $db->query("SELECT * FROM tb_magazin WHERE type = '2' LIMIT 100");
				if($ff = $db->numRows($nav) <= 0) {
				?>
				<tr id="trid_">
						<td colspan="3">Очередь пуста</td>
						
						</tr>
				<?php
				} else {
				while($nav1 = $db->fetch($nav)) {
				?>
				<tr id="trid_<?=$nav1['id']; ?>">
						<td>Навоз <?php
						if($nav1['user_id'] == $usid) { echo '<font color="red"><br>Моя очередь</font>';}
						
						?></td>
						<td id="tdid_1355"><?=$nav1['koll']; ?></td>
						<td><?=date('Y-m-d H:i', $nav1['date']); ?></td>
						</tr>
						<? } }?></table><br>		</div>
				<div id="mag3" class="tab_content">
		<table>
			<tr style="background-color:#0E82A7!important">
				<td id="birj_table">
				<b style="color:#ffffff">Продать продукты</b>
				<td id="birj_table">
				<b style="color:#ffffff">Купить продукты</b>
				</td>
			</tr>
			<tr>
				<td id="birj_table">
									<b>Выставить в очередь:</b>
									<!------------------------------------------------------->
					<form method="post" id='prodati_3' class="prodatimagazin" action="?action=prodati">					
						<label>Цена продажи Варежки: <?=$cena['varezki_p']; ?> руб/ед.</label>
						<input type="hidden" name="type" value="3">
						<label>Количество </label>
						<input type="text" value="1" name="kol" size="10">
						<label></label>
						<input type="submit"  name="prodati" value="Продать" class="buttonmail">
					</form>
							<!------------------------------------------------------->
							</td>
				<td id="birj_table">	
<!------------------------------------------------------->				
					<form method="post" id='kupit_3' class="kupitimagazin" action="?action=kupit">
						<label>Цена покупки Варежки: <?=$cena['varezki_b']; ?> руб/ед.</label>
						<input type="hidden" name="type" value="3">
						<label>Количество </label>
						<input type="text" value="1" name="kol" size="10">
						<label></label>
						<input type="submit" name="kupiti" value="Купить" class="buttonmail">
					</form><br>
					<!------------------------------------------------------->
				</td>
			</tr>
			<tr style="background-color:#0E82A7!important">
				<td id="birj_table">
				<b style="color:#ffffff">На вашем складе </b>
				<td id="birj_table">
				<b style="color:#ffffff">Склад магазина</b>
				</td>
			</tr>
			<tr>
				<td id="table_prod">
				<b>Продуктов для продажи:</b><br>
				Варежки: <span id='prod_3'><?=$us_data['varezhki']; ?></span> ед.<br>		
				<br>
				<b>Продуктов для использования:</b><br>
				Варежки: <span id='prodc_3'><?=$us_data['varezhki_per']; ?></span> ед.<br>
				</td>
				<td id="table_prod">
					<b>Магазин может продать на сумму <?=$sum_full_m; ?>  руб:</b><br>
					Из этой суммы:<br>
					Меха: <?=$rr['summeh']; ?> ед.<br>
					Навоза: <?=$rr1['sumnavoz']; ?> ед.<br>
					Варежки: <?=$rr2['sumvarezh']; ?> ед.<br>
					Коробок Удобрения: <?=$rr3['sumudob'];?> ед.<br>
					<br>
				</td>
			</tr>
		</table>
		<br>Очередь:<br><br>
			<table style="width: 100%;">
				<tr>
					<th width="150">Продукт</th>
					<th width="80">Количество</th>
					<th width="150">Дата</th>
				</tr><?php
				$var = $db->query("SELECT * FROM tb_magazin WHERE type = '3' LIMIT 100");
				if($ff = $db->numRows($var) <= 0) {
				?>
				<tr id="trid_">
						<td colspan="3">Очередь пуста</td>
						
						</tr>
				<?php
				} else {
				while($var1 = $db->fetch($var)) {
				?>
				<tr id="trid_<?=$var1['id']; ?>">
						<td>Варежки <?php
						if($var1['user_id'] == $usid) { echo '<font color="red"><br>Моя очередь</font>';}
						
						?></td>
						<td id="tdid_1355"><?=$var1['koll']; ?></td>
						<td><?=date('Y-m-d H:i', $var1['date']); ?></td>
						</tr>
						<? } }?></table><br>		</div>
				<div id="mag4" class="tab_content">
		<table>
			<tr style="background-color:#0E82A7!important">
				<td id="birj_table">
				<b style="color:#ffffff">Продать продукты</b>
				<td id="birj_table">
				<b style="color:#ffffff">Купить продукты</b>
				</td>
			</tr>
			<tr>
				<td id="birj_table">
									<b>Выставить в очередь:</b>
									<!------------------------------------------------------->
					<form method="post" id='prodati_4' class="prodatimagazin" action="?action=prodati">					
						<label>Цена продажи Коробок Удобрения: <?=$cena['udob_p']; ?> руб/ед.</label>
						<input type="hidden" name="type" value="4">
						<label>Количество </label>
						<input type="text" value="1" name="kol" size="10">
						<label></label>
						<input type="submit"  name="prodati" value="Продать" class="buttonmail">
					</form>
					<!------------------------------------------------------->
								</td>
				<td id="birj_table">	
<!------------------------------------------------------->				
					<form method="post" id='kupit_4' class="kupitimagazin" action="?action=kupit">
						<label>Цена покупки Коробок Удобрения: <?=$cena['udob_b']; ?> руб/ед.</label>
						<input type="hidden" name="type" value="4">
						<label>Количество </label>
						<input type="text" value="1" name="kol" size="10">
						<label></label>
						<input type="submit" name="kupiti" value="Купить" class="buttonmail">
					</form><br>
					<!------------------------------------------------------->
				</td>
			</tr>
			<tr style="background-color:#0E82A7!important">
				<td id="birj_table">
				<b style="color:#ffffff">На вашем складе </b>
				<td id="birj_table">
				<b style="color:#ffffff">Склад магазина</b>
				</td>
			</tr>
			<tr>
				<td id="table_prod">
				<b>Продуктов для продажи:</b><br>
				Коробок Удобрения: <span id='prod_4'><?=$us_data['udobrenie']; ?></span> ед.<br>		
				<br>
				<b>Продуктов для использования:</b><br>
				Коробок Удобрения: <span id='prodc_4'><?=$us_data['udob']; ?></span> ед.<br>
				</td>
				<td id="table_prod">
					<b>Магазин может продать на сумму <?=$sum_full_m; ?>  руб:</b><br>
					Из этой суммы:<br>
					Меха: <?=$rr['summeh']; ?> ед.<br>
					Навоза: <?=$rr1['sumnavoz']; ?> ед.<br>
					Варежки: <?=$rr2['sumvarezh']; ?> ед.<br>
					Коробок Удобрения: <?=$rr3['sumudob'];?> ед.<br>
					<br>
				</td>
			</tr>
		</table>
		<br>Очередь:<br>
		<br>
		<table style="width: 100%;">
				<tr>
					<th width="150">Продукт</th>
					<th width="80">Количество</th>
					<th width="150">Дата</th>
				</tr><?php
				$udob = $db->query("SELECT * FROM tb_magazin WHERE type = '4' LIMIT 100");
				if($ff = $db->numRows($udob) <= 0) {
				?>
				<tr id="trid_">
						<td colspan="3">Очередь пуста</td>
						
						</tr>
				<?php
				} else {
				while($udob1 = $db->fetch($udob)) {
				?>
				<tr id="trid_<?=$udob1['id']; ?>">
						<td>Короб.Удобрений <?php
						if($udob1['user_id'] == $usid) { echo '<font color="red"><br>Моя очередь</font>';}
						
						?></td>
						<td id="tdid_1355"><?=$udob1['koll']; ?></td>
						<td><?=date('Y-m-d H:i', $udob1['date']); ?></td>
						</tr>
						<? } }?></table><br>		</div>
			</div>
			
			<? } ?>