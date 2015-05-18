<center> <div class="tegname"><h2>Ярмарка</h2></div><br> </center>
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
$page = 'Ярмарка';
$rez = $db->getRow("SELECT * FROM tb_lavka WHERE id = 1");
$cena = $db->getRow("SELECT * FROM tb_price");

if(isset($_POST['prodati']) or isset($_POST['kupiti'])) {
//Продаем
if (isset($_POST['prodati'])) {
	$type = htmlspecialchars($_POST['type']);
	$kol = intval($_POST['kol']);
	
	//Пшеница
	if ($type == 'korm_1')
	{
		$cen = $cena['pshenica_b'];
		$sum = $kol * $cen;
		if($us_data['pshenica'] >= $kol) {
			if($kol >= 100) {
				if((10000 - $rez['pshenica']) >= $kol) {
					if($rez['rezerv'] >= $sum) {
						if($energy >= 1) { 
							$db->query("UPDATE tb_users SET pshenica = pshenica - ?i, money = money + ?i, energy = energy - '1' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
							$db->query("UPDATE tb_lavka SET rezerv = rezerv - ?i, pshenica = pshenica + ?i WHERE id = '1' LIMIT 1", $sum, $kol);
							echo '<font color="green">Вы успешно продали '.$kol.' пшеницы на сумму '.$sum.' руб.</font>';
							echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
						}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
					}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">В ярмарке больше нет места</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для продажи 100 пшеницы</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно пшеницы на складе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	}
	
	if ($type == 'korm_2') {//Клевер
	$cen = $cena['kukurudza_b'];
	$sum = $kol * $cen;
		if($us_data['kukurudza'] >= $kol) {
			if($kol >= 100) {
				if((10000 - $rez['kukurudza']) >= $kol) {
					if($rez['rezerv'] >= $sum) {
						if($energy >= 1) {
							$db->query("UPDATE tb_users SET kukurudza = kukurudza - ?i, money = money + ?i, energy = energy - '1' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
							$db->query("UPDATE tb_lavka SET rezerv = rezerv - ?i, kukurudza = kukurudza + ?i WHERE id = '1' LIMIT 1", $sum, $kol);
							echo '<font color="green">Вы успешно продали '.$kol.' клевера на сумму '.$sum.' руб.</font>';
							echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
						}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
					}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">В ярмрке больше нет места</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для продажи 100 клевера</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно клевера на складе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 'korm_3') {//Капуста
	$cen = $cena['jachmen_b'];
	$sum = $kol * $cen;
		if($us_data['jachmen'] >= $kol) {
			if($kol >= 100) {
				if((10000 - $rez['jachmen']) >= $kol) {
					if($rez['rezerv'] >= $sum) {
						if($energy >= 1) {
							$db->query("UPDATE tb_users SET jachmen = jachmen - ?i, money = money + ?i, energy = energy - '1' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
							$db->query("UPDATE tb_lavka SET rezerv = rezerv - ?i, jachmen = jachmen + ?i WHERE id = '1' LIMIT 1", $sum, $kol);
							echo '<font color="green">Вы успешно продали '.$kol.' капусты на сумму '.$sum.' руб.</font>';
							echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
						}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
					}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">В ярмарке больше нет места</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для продажи 100 капусты</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно капусты на складе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 'korm_4') {//Свекла
	$cen = $cena['svekla_b'];
	$sum = $kol * $cen;
		if($us_data['svekla'] >= $kol) {
			if($kol >= 100) {
				if((10000 - $rez['svekla']) >= $kol) {
					if($rez['rezerv'] >= $sum) {
						if($energy >= 1) {
							$db->query("UPDATE tb_users SET svekla = svekla - ?i, money = money + ?i, energy = energy - '1' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
							$db->query("UPDATE tb_lavka SET rezerv = rezerv - ?i, svekla = svekla + ?i WHERE id = '1' LIMIT 1", $sum, $kol);
							echo '<font color="green">Вы успешно продали '.$kol.' свеклы на сумму '.$sum.' руб.</font>';
							echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
						}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
					}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">В ярмарке больше нет места</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для продажи 100 свеклы</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно свеклы на складе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 'korm_5') {//Бобы
	$cen = $cena['bobi_b'];
	$sum = $kol * $cen;
		if($us_data['bobi'] >= $kol) {
			if($kol >= 100) {
				if((10000 - $rez['bobi']) >= $kol) {
					if($rez['rezerv'] >= $sum) {
						if($energy >= 1) {
							$db->query("UPDATE tb_users SET bobi = bobi - ?i, money = money + ?i, energy = energy - '1' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
							$db->query("UPDATE tb_lavka SET rezerv = rezerv - ?i, bobi = bobi + ?i WHERE id = '1' LIMIT 1", $sum, $kol);
							echo '<font color="green">Вы успешно продали '.$kol.' бобов на сумму '.$sum.' руб.</font>';
							echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
						}else echo '<font color="red">Недостаточно энергии! Скушайте блинчик!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
					}else echo '<font color="red">Резерв лавки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">В лавке больше нет места</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для продажи 100 бобов</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно бобов на складе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	
	if ($type == 'korm_6') {//Бобы
	$cen = $cena['tikva_b'];
	$sum = $kol * $cen;
		if($us_data['tikva'] >= $kol) {
			if($kol >= 100) {
				if((10000 - $rez['tikva']) >= $kol) {
					if($rez['rezerv'] >= $sum) {
						if($energy >= 1) {
							$db->query("UPDATE tb_users SET tikva = tikva - ?i, money = money + ?i, energy = energy - '1' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
							$db->query("UPDATE tb_lavka SET rezerv = rezerv - ?i, tikva = tikva + ?i WHERE id = '1' LIMIT 1", $sum, $kol);
							echo '<font color="green">Вы успешно продали '.$kol.' тыквы на сумму '.$sum.' руб.</font>';
							echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
						}else echo '<font color="red">Недостаточно энергии! Скушайте блинчик!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
					}else echo '<font color="red">Резерв лавки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">В лавке больше нет места</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для продажи 100 тыквы</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно тыквы на складе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	
	if ($type == 'product1_1') {//Яйцо
	$cen = $cena['yaco_b'];
	$sum = $kol * $cen;
		if($us_data['yaco'] >= $kol) {
			if($kol >= 100) {
				if((10000 - $rez['yaco']) >= $kol) {
					if($rez['rezerv'] >= $sum) {
						if($energy >= 1) {
							$db->query("UPDATE tb_users SET yaco = yaco - ?i, money_out = money_out + ?i, energy = energy - '5' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
							$db->query("UPDATE tb_lavka SET rezerv = rezerv - ?i, yaco = yaco + ?i WHERE id = '1' LIMIT 1", $sum, $kol);
							echo '<font color="green">Вы успешно продали '.$kol.' яиц на сумму '.$sum.' руб.</font>';
							echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
						}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
					}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">В ярмарке больше нет места</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для продажи 100 яиц</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно яиц на складе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 'product1_2') {//Мясо
	$cen = $cena['myaso_b'];
	$sum = $kol * $cen;
		if($us_data['myaso'] >= $kol) {
			if($kol >= 100) {
				if((10000 - $rez['myaso']) >= $kol) {
					if($rez['rezerv'] >= $sum) {
						if($energy >= 1) {
							$db->query("UPDATE tb_users SET myaso = myaso - ?i, money_out = money_out + ?i, energy = energy - '5' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
							$db->query("UPDATE tb_lavka SET rezerv = rezerv - ?i, myaso = myaso + ?i WHERE id = '1' LIMIT 1", $sum, $kol);
							echo '<font color="green">Вы успешно продали '.$kol.' мяса на сумму '.$sum.' руб.</font>';
							echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
						}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
					}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">В ярмарке больше нет места</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для продажи 100 мяса</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно мяса на складе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 'product1_3') {//Молоко козы
	$cen = $cena['m_o_b'];
	$sum = $kol * $cen;
		if($us_data['m_o'] >= $kol) {
			if($kol >= 100) {
				if((10000 - $rez['m_o']) >= $kol) {
					if($rez['rezerv'] >= $sum) {
						if($energy >= 1) {
							$db->query("UPDATE tb_users SET m_o = m_o - ?i, money_out = money_out + ?i, energy = energy - '5' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
							$db->query("UPDATE tb_lavka SET rezerv = rezerv - ?i, m_o = m_o + ?i WHERE id = '1' LIMIT 1", $sum, $kol);
							echo '<font color="green">Вы успешно продали '.$kol.' молока на сумму '.$sum.' руб.</font>';
							echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
						}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
					}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">В ярмарке больше нет места</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для продажи 100 молока</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно молока на складе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 'product1_4') {//Молоко Коровы
	$cen = $cena['m_k_b'];
	$sum = $kol * $cen;
		if($us_data['m_k'] >= $kol) {
			if($kol >= 100) {
				if((10000 - $rez['m_k']) >= $kol) {
					if($rez['rezerv'] >= $sum) {
						if($energy >= 1) {
							$db->query("UPDATE tb_users SET m_k = m_k - ?i, money_out = money_out + ?i, energy = energy - '5' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
							$db->query("UPDATE tb_lavka SET rezerv = rezerv - ?i, m_k = m_k + ?i WHERE id = '1' LIMIT 1", $sum, $kol);
							echo '<font color="green">Вы успешно продали '.$kol.' молока на сумму '.$sum.' руб.</font>';
							echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
						}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
					}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">В ярмарке больше нет места</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для продажи 100 молока</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно молока на складе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 'product2_1') {//Тесто
	$cen = $cena['testo_b'];
	$sum = $kol * $cen;
		if($us_data['testo'] >= $kol) {
			if($kol >= 1000) {
				if((10000 - $rez['testo']) >= $kol) {
					if($rez['rezerv'] >= $sum) {
						if($energy >= 1) {
							$db->query("UPDATE tb_users SET testo = testo - ?i, money_out = money_out + ?i, energy = energy - '5' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
							$db->query("UPDATE tb_lavka SET rezerv = rezerv - ?i, testo = testo + ?i WHERE id = '1' LIMIT 1", $sum, $kol);
							echo '<font color="green">Вы успешно продали '.$kol.' теста на сумму '.$sum.' руб.</font>';
							echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
						}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
					}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">В ярмарке больше нет места</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для продажи 1000 теста</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно теста на складе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 'product2_2') {//Фарш
	$cen = $cena['farsh_b'];
	$sum = $kol * $cen;
		if($us_data['farsh'] >= $kol) {
			if($kol >= 1000) {
				if((10000 - $rez['farsh']) >= $kol) {
					if($rez['rezerv'] >= $sum) {
						if($energy >= 1) {
							$db->query("UPDATE tb_users SET farsh = farsh - ?i, money_out = money_out + ?i, energy = energy - '5' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
							$db->query("UPDATE tb_lavka SET rezerv = rezerv - ?i, farsh = farsh + ?i WHERE id = '1' LIMIT 1", $sum, $kol);
							echo '<font color="green">Вы успешно продали '.$kol.' фарша на сумму '.$sum.' руб.</font>';
							echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
						}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
					}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">В ярмарке больше нет места</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для продажи 100 фарша</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно фарша на складе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 'product2_3') {//Сыр
	$cen = $cena['sir_b'];
	$sum = $kol * $cen;
		if($us_data['sir'] >= $kol) {
			if($kol >= 1000) {
				if((10000 - $rez['sir']) >= $kol) {
					if($rez['rezerv'] >= $sum) {
						if($energy >= 1) {
							$db->query("UPDATE tb_users SET sir = sir - ?i, money_out = money_out + ?i, energy = energy - '5' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
							$db->query("UPDATE tb_lavka SET rezerv = rezerv - ?i, sir = sir + ?i WHERE id = '1' LIMIT 1", $sum, $kol);
							echo '<font color="green">Вы успешно продали '.$kol.' сыра на сумму '.$sum.' руб.</font>';
							echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
						}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
					}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">В ярмарке больше нет места</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для продажи 100 сыра</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно сыра на складе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 'product2_4') {//Творог
	$cen = $cena['smetana_b'];
	$sum = $kol * $cen;
		if($us_data['smetana'] >= $kol) {
			if($kol >= 1000) {
				if((10000 - $rez['smetana']) >= $kol) {
					if($rez['rezerv'] >= $sum) {
						if($energy >= 1) {
							$db->query("UPDATE tb_users SET smetana = smetana - ?i, money_out = money_out + ?i, energy = energy - '5' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
							$db->query("UPDATE tb_lavka SET rezerv = rezerv - ?i, smetana = smetana + ?i WHERE id = '1' LIMIT 1", $sum, $kol);
							echo '<font color="green">Вы успешно продали '.$kol.' творога на сумму '.$sum.' руб.</font>';
							echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
						}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
					}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">В ярмарке больше нет места</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для продажи 100 творога</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно творога на складе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	
	
	//Покупаем
}elseif(isset($_POST['kupiti'])) {
$type = htmlspecialchars($_POST['type']);
	$kol = intval($_POST['kol']);
	
	
	
	if ($type == 'korm_1') {//Пшеница
	$cen = $cena['pshenica_p'];
	$sum = $kol * $cen;
		if($us_data['money'] >= $sum) {
			if($kol >= 1) {
				if($rez['pshenica'] >= $kol) {
				if($energy >= 1) {
					$db->query("UPDATE tb_users SET pshenica = pshenica + ?i, money = money - ?i, energy = energy - '1' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
					$db->query("UPDATE tb_lavka SET rezerv = rezerv + ?i, pshenica = pshenica - ?i WHERE id = '1' LIMIT 1", $sum, $kol);
					echo '<font color="green">Вы успешно купили '.$kol.' пшеницы на сумму '.$sum.' руб.</font>';
					echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
					}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для покупки 1 пшеницы</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно средств на балансе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 'korm_2') {//Клевер
	$cen = $cena['kukurudza_p'];
	$sum = $kol * $cen;
		if($us_data['money'] >= $sum) {
			if($kol >= 1) {
				if($rez['kukurudza'] >= $kol) {
				if($energy >= 1) {
					$db->query("UPDATE tb_users SET kukurudza = kukurudza + ?i, money = money - ?i, energy = energy - '1' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
					$db->query("UPDATE tb_lavka SET rezerv = rezerv + ?i, kukurudza = kukurudza - ?i WHERE id = '1' LIMIT 1", $sum, $kol);
					echo '<font color="green">Вы успешно купили '.$kol.' клевера на сумму '.$sum.' руб.</font>';
					echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
					}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для покупки 1 клевера</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно средств на балансе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 'korm_3') {//Капуста
	$cen = $cena['jachmen_p'];
	$sum = $kol * $cen;
		if($us_data['money'] >= $sum) {
			if($kol >= 1) {
				if($rez['jachmen'] >= $kol) {
				if($energy >= 1) {
					$db->query("UPDATE tb_users SET jachmen = jachmen + ?i, money = money - ?i, energy = energy - '1' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
					$db->query("UPDATE tb_lavka SET rezerv = rezerv + ?i, jachmen = jachmen - ?i WHERE id = '1' LIMIT 1", $sum, $kol);
					echo '<font color="green">Вы успешно купили '.$kol.' капусты на сумму '.$sum.' руб.</font>';
					echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
					}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для покупки 1 капусты</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно средств на балансе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 'korm_4') {//Свекла
	$cen = $cena['svekla_p'];
	$sum = $kol * $cen;
		if($us_data['money'] >= $sum) {
			if($kol >= 1) {
				if($rez['svekla'] >= $kol) {
				if($energy >= 1) {
					$db->query("UPDATE tb_users SET svekla = svekla + ?i, money = money - ?i, energy = energy - '1' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
					$db->query("UPDATE tb_lavka SET rezerv = rezerv + ?i, svekla = svekla - ?i WHERE id = '1' LIMIT 1", $sum, $kol);
					echo '<font color="green">Вы успешно купили '.$kol.' свеклы на сумму '.$sum.' руб.</font>';
					echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
					}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для покупки 1 свеклы</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно средств на балансе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 'korm_5') {//Бобы
	$cen = $cena['bobi_p'];
	$sum = $kol * $cen;
		if($us_data['moley'] >= $sum) {
			if($kol >= 1) {
				if($rez['bobi'] >= $kol) {
				if($energy >= 1) {
					$db->query("UPDATE tb_users SET bobi = bobi + ?i, money = money - ?i, energy = energy - '1' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
					$db->query("UPDATE tb_lavka SET rezerv = rezerv + ?i, bobi = bobi - ?i WHERE id = '1' LIMIT 1", $sum, $kol);
					echo '<font color="green">Вы успешно купили '.$kol.' бобов на сумму '.$sum.' руб.</font>';
					echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
					}else echo '<font color="red">Недостаточно энергии! Скушайте блинчик!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">Резерв лавки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для покупки 1 бобов</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно средств на балансе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	
	if ($type == 'korm_6') {//Бобы
	$cen = $cena['tikva_p'];
	$sum = $kol * $cen;
		if($us_data['money'] >= $sum) {
			if($kol >= 1) {
				if($rez['tikva'] >= $kol) {
				if($energy >= 1) {
					$db->query("UPDATE tb_users SET tikva = tikva + ?i, money = money - ?i, energy = energy - '1' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
					$db->query("UPDATE tb_lavka SET rezerv = rezerv + ?i, tikva = tikva - ?i WHERE id = '1' LIMIT 1", $sum, $kol);
					echo '<font color="green">Вы успешно купили '.$kol.' тыквы на сумму '.$sum.' руб.</font>';
					echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
					}else echo '<font color="red">Недостаточно энергии! Скушайте блинчик!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">Резерв лавки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для покупки 1 тыквы</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно средств на балансе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	
	if ($type == 'product1_1') {//Яйцо
	$cen = $cena['yaco_p'];
	$sum = $kol * $cen;
		if($us_data['money'] >= $sum) {
			if($kol >= 1) {
				if($rez['yaco'] >= $kol) {
				if($energy >= 1) {
					$db->query("UPDATE tb_users SET yaco_per = yaco_per + ?i, money = money - ?i, energy = energy - '5' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
					$db->query("UPDATE tb_lavka SET rezerv = rezerv + ?i, yaco = yaco - ?i WHERE id = '1' LIMIT 1", $sum, $kol);
					echo '<font color="green">Вы успешно купили '.$kol.' яиц на сумму '.$sum.' руб.</font>';
					echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
					}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для покупки 1 яиц</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно средств на балансе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 'product1_2') {//Мясо
	$cen = $cena['myaso_p'];
	$sum = $kol * $cen;
		if($us_data['money'] >= $sum) {
			if($kol >= 1) {
				if($rez['myaso'] >= $kol) {
				if($energy >= 1){
					$db->query("UPDATE tb_users SET myaso_per = myaso_per + ?i, money = money - ?i, energy = energy - '5' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
					$db->query("UPDATE tb_lavka SET rezerv = rezerv + ?i, myaso = myaso - ?i WHERE id = '1' LIMIT 1", $sum, $kol);
					echo '<font color="green">Вы успешно купили '.$kol.' мяса на сумму '.$sum.' руб.</font>';
					echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
					}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			}else echo '<font color="red">Минимум для покупки 1 мяса</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
		}else echo '<font color="red">Не достаточно средств на балансе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 'product1_3') {//Молоко Козы
	$cen = $cena['m_o_p'];
	$sum = $kol * $cen;
		if($us_data['money'] >= $sum) {
		
			if($kol >= 1) {
			
				if($rez['m_o'] >= $kol) {
				
					if($energy >= 1) {
				
						$db->query("UPDATE tb_users SET m_o_per = m_o_per + ?i, money = money - ?i, energy = energy - '5' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
						$db->query("UPDATE tb_lavka SET rezerv = rezerv + ?i, m_o = m_o - ?i WHERE id = '1' LIMIT 1", $sum, $kol);
						echo '<font color="green">Вы успешно купили '.$kol.' молока на сумму '.$sum.' руб.</font>';
						echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
					
					}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
					
				}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				
			}else echo '<font color="red">Минимум для покупки 1 молока</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			
		}else echo '<font color="red">Не достаточно средств на балансе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 'product1_4') {//Молоко Коровы
	$cen = $cena['m_k_p'];
	$sum = $kol * $cen;
		if($us_data['money'] >= $sum) {
		
			if($kol >= 1) {
			
				if($rez['m_k'] >= $kol) {
				
					if($energy >= 1) {
					
						$db->query("UPDATE tb_users SET m_k_per = m_k_per + ?i, money = money - ?i, energy = energy - '5' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
						$db->query("UPDATE tb_lavka SET rezerv = rezerv + ?i, m_k = m_k - ?i WHERE id = '1' LIMIT 1", $sum, $kol);
						echo '<font color="green">Вы успешно купили '.$kol.' молока на сумму '.$sum.' руб.</font>';
						echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
						
					}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
					
				}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				
			}else echo '<font color="red">Минимум для покупки 1 молока</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			
		}else echo '<font color="red">Не достаточно средств на балансе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 'product2_1') {//Тесто
	$cen = $cena['testo_p'];
	$sum = $kol * $cen;
		if($us_data['money'] >= $sum) {
		
			if($kol >= 1) {
			
				if($rez['testo'] >= $kol) {
				
					if($energy >= 1) {
					
						$db->query("UPDATE tb_users SET testo_per = testo_per + ?i, money = money - ?i, energy = energy - '5' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
						$db->query("UPDATE tb_lavka SET rezerv = rezerv + ?i, testo = testo - ?i WHERE id = '1' LIMIT 1", $sum, $kol);
						echo '<font color="green">Вы успешно купили '.$kol.' теста на сумму '.$sum.' руб.</font>';
						echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
						
					}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
					
				}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				
			}else echo '<font color="red">Минимум для покупки 1 теста</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			
		}else echo '<font color="red">Не достаточно средств на балансе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 'product2_2') {//Фарш
	$cen = $cena['farsh_p'];
	$sum = $kol * $cen;
		if($us_data['money'] >= $sum) {
		
			if($kol >= 1) {
			
				if($rez['farsh'] >= $kol) {
				
					if($energy >= 1) {
				
						$db->query("UPDATE tb_users SET farsh_per = farsh_per + ?i, money = money - ?i, energy = energy - '5' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
						$db->query("UPDATE tb_lavka SET rezerv = rezerv + ?i, farsh = farsh - ?i WHERE id = '1' LIMIT 1", $sum, $kol);
						echo '<font color="green">Вы успешно купили '.$kol.' фарша на сумму '.$sum.' руб.</font>';
						echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
					
					}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
					
				}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				
			}else echo '<font color="red">Минимум для покупки 1 фарша</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			
		}else echo '<font color="red">Не достаточно средств на балансе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 'product2_3') {//Сыр
	$cen = $cena['sir_p'];
	$sum = $kol * $cen;
		if($us_data['money'] >= $sum) {
		
			if($kol >= 1) {
			
				if($rez['sir'] >= $kol) {
				
					if($energy >= 1) {
				
						$db->query("UPDATE tb_users SET sir_per = sir_per + ?i, money = money - ?i, energy = energy - '5' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
						$db->query("UPDATE tb_lavka SET rezerv = rezerv + ?i, sir = sir - ?i WHERE id = '1' LIMIT 1", $sum, $kol);
						echo '<font color="green">Вы успешно купили '.$kol.' сыра на сумму '.$sum.' руб.</font>';
						echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
						
					}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
					
				}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				
			}else echo '<font color="red">Минимум для покупки 1 сыра</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			
		}else echo '<font color="red">Не достаточно средств на балансе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
	
	if ($type == 'product2_4') {//Творог
	$cen = $cena['smetana_p'];
	$sum = $kol * $cen;
		if($us_data['money'] >= $sum) {
		
			if($kol >= 1) {
			
				if($rez['smetana'] >= $kol) {
				
					if($energy >= 1) {
				
						$db->query("UPDATE tb_users SET smetana_per = smetana_per + ?i, money = money - ?i, energy = energy - '5' WHERE id = ?i AND username = ?s LIMIT 1", $kol, $sum, $usid, $login);
						$db->query("UPDATE tb_lavka SET rezerv = rezerv + ?i, smetana = smetana - ?i WHERE id = '1' LIMIT 1", $sum, $kol);
						echo '<font color="green">Вы успешно купили '.$kol.' творога на сумму '.$sum.' руб.</font>';
						echo '<br><a href="/lavka"><font color="red">Продолжить >>></font></a>';
						
					}else echo '<font color="red">Недостаточно энергии! Скушайте пирог!</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
					
				}else echo '<font color="red">Резерв ярмарки пуст</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
				
			}else echo '<font color="red">Минимум для покупки 1 творога</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
			
		}else echo '<font color="red">Не достаточно средств на балансе</font><br><a href="/lavka"><font color="red"><<< Назад</font></a>';
	
	}
}
}else {

?>
<p style="border: 3px solid #0E82A7;border-radius: 8px;padding: 2%;">
В Ярмарке Вы можете продать полученные продукты от животных и фабрик по переработке продуктов.<br />
				<br> А также купить продукцию для переработки и получения других продуктов! <br />
				Также можно продать корм полученный с полей и купить корм для своих животных.<br />
				<br> Минимальное количество для покупки и продажи 100 продуктов. Для продажи продуктов полученных с фабрик минимальное количество 1000.<br>
				При каждой покупке или продаже корма снимается 1 ед энергии. При каждой покупке или продаже продуктов снимается 5 ед энергии.<br><br>
				Хочешь получать процент от разницы между продажей и покупкой продуктов?<br> Купи <a href="/action">акции</a> и стань акционером ярмарки.<br><br>
				<a href="?action=stats">Статистика ярмарки</a></p> <br><br> 
							<style>		
				#birj_table{
					padding:5px;
					width: 250px;
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
		<table style="width:100%;">
			<tr style="background-color:#0E82A7!important">
				<td id="birj_table" style="border: 3px solid #0E82A7;">
				<b style="color:#ffffff">Продать продукты</b>
				<td id="birj_table" style="border: 3px solid #0E82A7;">
				<b style="color:#ffffff">Купить продукты</b>
				</td>
			</tr>
			<tr>
				<td id="birj_table" style="border: 3px solid #0E82A7;border-radius: 8px;padding: 2%;">
					<form method="post" action="?action=prodati" >
						<label>Выберите продукт</label>
						<select style="width: 100%;" name="type">
						<option value='product1_1'>Яйцо (Цена: <?=$cena['yaco_b']; ?> руб/ед.)</option>
						<option value='product1_2'>Мясо (Цена: <?=$cena['myaso_b']; ?> руб/ед.)</option>
						<option value='product1_3'>Молоко козы (Цена: <?=$cena['m_o_b']; ?> руб/ед.)</option>
						<option value='product1_4'>Молоко коровы (Цена: <?=$cena['m_k_b']; ?> руб/ед.)</option>
						<option disabled>-----</option>
						<option value='product2_1'>Тесто (Цена: <?=$cena['testo_b']; ?> руб/ед.)</option>
						<option value='product2_2'>Фарш (Цена: <?=$cena['farsh_b']; ?> руб/ед.)</option>
						<option value='product2_3'>Сыр (Цена: <?=$cena['sir_b']; ?> руб/ед.)</option>
						<option value='product2_4'>Творог (Цена: <?=$cena['smetana_b']; ?> руб/ед.)</option>
						<option disabled>---Корм---</option>
						<option value='korm_1'>Корм кур (Цена: <?=$cena['pshenica_b']; ?> руб/ед.)</option>
						<option value='korm_2'>Корм бычков (Цена: <?=$cena['kukurudza_b']; ?> руб/ед.)</option>
						<option value='korm_3'>Корм коз (Цена: <?=$cena['jachmen_b']; ?> руб/ед.)</option>
						<option value='korm_4'>Корм коров (Цена: <?=$cena['svekla_b']; ?> руб/ед.)</option>
						
						</select>
						<label>Количество </label>
						<input type="text" value="100" name="kol" size="10">
						<label></label>
						<input type="hidden" name="verify_prodati" value="3234627b9a8c70ee58d38f8d0d1cedcb">
						<input type="submit" style="padding: 5px 5px;"  name="prodati" value="Продать" class="menubtn">
					</form>
				</td>
				<td id="birj_table" style="border: 3px solid #0E82A7;border-radius: 8px;padding: 2%;">				
					<form method="post" action="?action=kupit" >
						<label>Выберите продукт</label>
						<select  style="width: 100%;" name="type">
						<option value='product1_1'>Яйцо (Цена: <?=$cena['yaco_p']; ?> руб/ед.)</option>
						<option value='product1_2'>Мясо (Цена: <?=$cena['myaso_p']; ?> руб/ед.)</option>
						<option value='product1_3'>Молоко козы (Цена: <?=$cena['m_o_p']; ?> руб/ед.)</option>
						<option value='product1_4'>Молоко коровы (Цена: <?=$cena['m_k_p']; ?> руб/ед.)</option>
						<option disabled>------</option>
						<option value='product2_1'>Тесто (Цена: <?=$cena['testo_p']; ?> руб/ед.)</option>
						<option value='product2_2'>Фарш (Цена: <?=$cena['farsh_p']; ?> руб/ед.)</option>
						<option value='product2_3'>Сыр (Цена: <?=$cena['sir_p']; ?> руб/ед.)</option> 
						<option value='product2_4'>творог (Цена: <?=$cena['smetana_p']; ?> руб/ед.)</option>
						<option disabled>---Корм---</option>
						<option value='korm_1'>Корм кур (Цена: <?=$cena['pshenica_p']; ?> руб/ед.)</option>
						<option value='korm_2'>Корм бычков (Цена: <?=$cena['kukurudza_p']; ?> руб/ед.)</option>
						<option value='korm_3'>Корм коз (Цена: <?=$cena['jachmen_p']; ?> руб/ед.)</option>
						<option value='korm_4'>Корм коров (Цена: <?=$cena['svekla_p']; ?> руб/ед.)</option>
						
						</select>
						<label>Количество </label>
						<input type="text" value="100" name="kol" size="10">
						
						<label></label>
						<input type="hidden" name="verify_kupiti" value="a1cfb8bd1b7a18d219d0444fe391bd5d">
						<input type="submit" style="padding: 5px 5px;" name="kupiti" value="Купить" class="menubtn">
					</form><br>
				</td>
			</tr>
			<tr style="background-color:#0E82A7!important">
				<td id="birj_table" style="border: 3px solid #0E82A7;">
				<b style="color:#ffffff">На вашем складе </b>
				<td id="birj_table" style="border: 3px solid #0E82A7;">
				<b style="color:#ffffff">На складе ярмарки </b>
				</td>
			</tr>
			<tr>
				<td id="table_prod" style="border: 3px solid #0E82A7;border-radius: 8px;padding: 2%;">
				<p >
				Продуктов для продажи:<br></p>
				Яйцо: <?=$us_data['yaco']; ?> ед.<br>
				Мясо: <?=$us_data['myaso']; ?> ед.<br>
				Молоко козы: <?=$us_data['m_o']; ?> ед.<br>
				Молоко коровы: <?=$us_data['m_k']; ?> ед.<br>
				Тесто: <?=$us_data['testo']; ?> ед.<br>
				Фарш: <?=$us_data['farsh']; ?> ед.<br>
				Сыр: <?=$us_data['sir']; ?> ед.<br>
				Творог: <?=$us_data['smetana']; ?> ед.<br>
				Корм кур: <?=$us_data['pshenica']; ?> ед.<br>
				Корм бычков: <?=$us_data['kukurudza']; ?> ед.<br>
				Корм коз: <?=$us_data['jachmen']; ?> ед.<br>
				Корм коров: <?=$us_data['svekla']; ?> ед.<br>
				
				
				<br>
				<p>
				Продуктов для переработки:</p><br>
				Яйцо: <?=$us_data['yaco_per']; ?> ед.<br>
				Мясо: <?=$us_data['myaso_per']; ?> ед.<br>
				Молоко козы: <?=$us_data['m_o_per']; ?> ед.<br>
				Молоко коровы: <?=$us_data['m_k_per']; ?> ед.<br>
				Тесто: <?=$us_data['testo_per']; ?> ед.<br>
				Фарш: <?=$us_data['farsh_per']; ?> ед.<br>
				Сыр: <?=$us_data['sir_per']; ?> ед.<br>
				творог: <?=$us_data['smetana_per']; ?> ед.<br>
				</td>
				<td id="table_prod" style="border: 3px solid #0E82A7;border-radius: 8px;padding: 2%;">
				<p>
					Резерв ярмарки: <?=$rez['rezerv']; ?> руб.<br><br></p>
					Продуктов для продажи:<br>
					Яйцо: <?=$rez['yaco']; ?> ед.<br>
					Мясо: <?=$rez['myaso']; ?> ед.<br>
					Молоко козы: <?=$rez['m_o']; ?> ед.<br>
					Молоко коровы: <?=$rez['m_k']; ?> ед.<br>
					Тесто: <?=$rez['testo']; ?> ед.<br>
					Фарш: <?=$rez['farsh']; ?> ед.<br>
					Сыр: <?=$rez['sir']; ?> ед.<br>
					Творог: <?=$rez['smetana']; ?> ед.<br>
					Корм кур: <?=$rez['pshenica']; ?> ед.<br>
					Корм бычков: <?=$rez['kukurudza']; ?> ед.<br>
					Корм коз: <?=$rez['jachmen']; ?> ед.<br>
					Корм коров: <?=$rez['svekla']; ?> ед.<br>
					
					<br>
				</td>
			</tr>
		</table>
		<?php } ?>