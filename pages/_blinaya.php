<center> <div class="tegname"><h2>Пироговая</h2></div><br> </center>
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
$page = 'Блинная';
if(isset($_POST['sell']) or isset($_POST['kupit']) or isset($_POST['snat'])) {


if(isset($_POST['sell'])) {
$type = valideint($_POST['type']);
$koll = valideint($_POST['koll']);

$date = time();
	switch($type) {
	case 1: $bl = 'blin_myaso_by'; break;
	case 2: $bl = 'blin_sir_by'; break;
	case 3: $bl = 'blin_smetana_by'; break;
	}
	switch($type) {
case 1: $nameblin = 'с мясом'; break;
case 2: $nameblin = 'с сыром'; break;
case 3: $nameblin = 'с сметаной'; break;
}
		if ($us_data[$bl] >= $koll) {
		if($koll > 0) {
		
		///////Если уже на бирже есть такой тип бинчика от данного юзверя
			$kk = $db->query("SELECT * FROM tb_blinaya WHERE user_id = ?i AND type = ?i", $usid, $type);
			if($db->numRows($kk) >= 1) {
			$kkk = $db->fetch($kk);
			$idd = $kkk['id'];
			$kol1 = $kkk['koll'];
			$kol2 = $koll + $kol1;
			$db->query("UPDATE tb_users SET ?n = ?n - ?i, energy = energy - 1 WHERE id = ?i", $bl, $bl, $koll, $usid);
			$db->query("INSERT INTO tb_blinaya SET ?u", array('user_id' => $usid, 'koll' => $kol2, 'type' => $type, 'date' => $date));
			$db->query("DELETE FROM tb_blinaya WHERE id = ?i", $idd);
			echo '<font color="green">Вы успешно выставили пироги на биржу</font><br><a href="/blinaya"><font color="red">Продолжить >>></font></a>';
			} else { ///// Если нету
			$db->query("UPDATE tb_users SET ?n = ?n - ?i, energy = energy - 1 WHERE id = ?i", $bl, $bl, $koll, $usid);
			$db->query("INSERT INTO tb_blinaya SET ?u", array('user_id' => $usid, 'koll' => $koll, 'type' => $type, 'date' => $date));
			echo '<font color="green">Вы успешно выставили пироги на биржу</font><br><a href="/blinaya"><font color="red">Продолжить >>></font></a>';
			}
			$db->query("INSERT INTO tb_history SET ?u", array('user_id' => $usid, 'summa' => $sum, 'date' => $date, 'comment' => 'Выставил на биржу $koll пирогов $nameblin', 'type' => 'blincik'));
		} else echo '<font color="red">ERROR!!!<br>Укажите колличество больше нуля(0)</font><br><a href="/blinaya"><font color="red"><<< Назад</font></a>';
		} else echo '<font color="red">ERROR!!!<br>Не достаточно пирогов на складе для продажи</font><br><a href="/blinaya"><font color="red"><<< Назад</font></a>';
}

if (isset($_POST['kupit'])) {
$idd = valideint($_POST['id']);
$type = valideint($_POST['type']);
$koll = intval($_POST['kol']);

switch($type) {
case 1: $blin = 'blin_myaso'; $cena = 1.35; break;
case 2: $blin = 'blin_sir'; $cena = 1.85; break;
case 3: $blin = 'blin_smetana'; $cena = 3.20; break;
}
switch($type) {
case 1: $nameblin = 'с мясом'; break;
case 2: $nameblin = 'с сыром'; break;
case 3: $nameblin = 'с творогом'; break;
}
$sum = $koll * $cena;
	if($koll >= 1) {
		if($us_data['money'] >= $sum) {
			$rs1 = $db->getRow("SELECT * FROM tb_blinaya WHERE type = ?i AND koll >= ?i ORDER BY date ASC LIMIT 1", $type, $koll);
			
			$id = $rs1['id'];
			$user_id = $rs1['user_id'];
			$kolvo = $rs1['koll'];
			
			if($kolvo < $koll) {
			echo '<font color="red">ERROR!!!<br>В данной очереди нет столько пирогов!</font><br><a href="/blinaya"><font color="red"><<< Назад</font></a>';
			} else {
			
			$admin_percent = 0.01 * $koll;
			$merchant_percent = $sum - $admin_percent;
			$date = time();
			$db->query("update `tb_users` set `money_out` = `money_out` + ?i where `id` = '1'", $admin_percent);
			
			$db->query("INSERT INTO tb_history SET ?u", array('user_id' => '1', 'summa' => $admin_percent, 'date' => $date, 'comment' => 'Покупка пирогов, рефералом $login', 'type' => 'ref'));
			$db->query("INSERT INTO tb_history SET ?u", array('user_id' => $user_id, 'summa' => $merchant_percent, 'date' => $date, 'comment' => 'Покупка пирогов, рефералом $login', 'type' => 'ref'));
			
			$db->query("UPDATE tb_users SET ?n = ?n + ?i, money = money - ?i WHERE id = ?i", $blin, $blin, $koll, $sum, $usid);
			$db->query("UPDATE tb_users SET money_out = money_out + ?i WHERE id = ?i", $merchant_percent, $user_id);
			$db->query("INSERT INTO tb_history SET ?u", array('user_id' => $usid, 'summa' => $sum, 'date' => $date, 'comment' => 'Купил $koll пирогов $nameblin', 'type' => 'blincik'));
			if($koll == $kolvo) {
			$db->query("DELETE FROM tb_blinaya WHERE id = ?i", $id);
			} else {
			$db->query("UPDATE tb_blinaya SET koll = koll - ?i WHERE type = ?i AND id = ?i LIMIT 1", $koll, $type, $id);
			}
		echo  '<font color="green">Вы успешно купили пироги</font><br><a href="/blinaya"><font color="red">Продолжить >>></font></a>';
		
		}
		}else echo '<font color="red">ERROR!!!<br>Не достаточно средств на балансе!</font><br><a href="/blinaya"><font color="red"><<< Назад</font></a>';
	}else  echo '<font color="red">ERROR!!!<br>Не верно указано колличество пирогов</font><br><a href="/blinaya"><font color="red"><<< Назад</font></a>';

}

if(isset($_POST['snat'])) {
$kolvo = intval($_POST['kolvo']);
$snat = intval($_POST['snat']);
$type = intval($_POST['type']);

switch ($type) {
case 1: $blin = 'blin_myaso_by'; break;
case 2: $blin = 'blin_sir_by'; break;
case 3: $blin = 'blin_smetana_by'; break;
}

$qq = $db->query("SELECT * FROM tb_blinaya WHERE type = ?i AND user_id = ?i", $type, $usid);
$qqw = $db->fetch($qq);
$id = $qqw['id'];
if($db->numRows($qq) >= 1) {
if($kolvo > 0) {
	if($kolvo <= $qqw['koll']) {
		if($kolvo == $qqw['koll']) {
		$db->query("UPDATE tb_users SET ?n = ?n + ?i WHERE id= ?i", $blin, $blin, $kolvo, $usid);
		$db->query("DELETE FROM tb_blinaya WHERE id = ?i", $id);
		} else {
		$db->query("UPDATE tb_users SET ?n = ?n + ?i WHERE id= ?i", $blin, $blin, $kolvo, $usid);
		$db->query("UPDATE tb_blinaya SET koll = koll - ?i WHERE id = ?i", $kolvo, $id);
		}
		echo '<font color="green">Вы успешно сняли пироги с биржи</font><br><a href="/blinaya"><font color="red">Продолжить >>></font></a>';
	}else echo '<font color="red">ERROR!!!<br>Вы указали больше чем имеется у вас на бирже!</font><br><a href="/blinaya"><font color="red"><<< Назад</font></a>';
}else echo '<font color="red">ERROR!!!<br>Укажите колличество больше нуля(0)!</font><br><a href="/blinaya"><font color="red"><<< Назад</font></a>';
}else echo '<font color="red">ERROR!!!<br>У вас нет ставки на бирже!</font><br><a href="/blinaya"><font color="red"><<< Назад</font></a>';


}


} else {



?>



<p style="border: 3px solid #0E82A7;
  border-radius: 8px;
  padding: 2%;">В пироговой Вы можете купить или продать пироги. <br>Для пополнения энергии нужно кушать пироги.<br>
	Есть 3 типа пирогов:<br>
	Пирог с мясом - цена: 1.35 руб, дает энергии: 135 ед. <br>
	Пирог с сыром - цена: 1.85 руб, дает энергии: 185 ед.<br>
	Пирог с творогом - цена: 3.20 руб, дает энергии: 320 ед.<br><br>
<p><br>
	У вас Пирогов:<br>
	<u>Для употребления:</u>
<script type="text/javascript">
function send1(mode)
{
//Получаем параметры
var text = $('#text').val()

 // Отсылаем паметры
 $.ajax({
 type: "POST",
 url: "/ajax/blin.php",
 data: {text:text, mode:mode},
 //При удачном завершение запроса - выводим то, что нам вернул PHP
 success: function(html) {
 //предварительно очищаем нужный элемент страницы
 $("#response").empty();
//и выводим ответ php скрипта
 $("#response").append(html);
 }
 });
}
</script>


<script type="text/javascript">
function send2(mode)
{
//Получаем параметры
var text = $('#text1').val()

 // Отсылаем паметры
 $.ajax({
 type: "POST",
 url: "/ajax/blin.php",
 data: {text:text, mode:mode},
 //При удачном завершение запроса - выводим то, что нам вернул PHP
 success: function(html) {
 //предварительно очищаем нужный элемент страницы
 $("#response").empty();
//и выводим ответ php скрипта
 $("#response").append(html);
 }
 });
}
</script>

<script type="text/javascript">
function send3(mode)
{
//Получаем параметры
var text = $('#text2').val()

 // Отсылаем паметры
 $.ajax({
 type: "POST",
 url: "/ajax/blin.php",
 data: {text:text, mode:mode},
 //При удачном завершение запроса - выводим то, что нам вернул PHP
 success: function(html) {
 //предварительно очищаем нужный элемент страницы
 $("#response").empty();
//и выводим ответ php скрипта
 $("#response").append(html);
 }
 });
}
</script>
<div id="response"></div>
	<p>Пирог с мясом: <span id="bliny_1"><?=$us_data['blin_myaso']; ?></span> шт. <b>	
<input id="text" value="1" name="blin" type="hidden">
<input style="padding: 5px 5px;" onclick="send1('one');" class="menubtn" value="Кушать" type="button">
<input style="padding: 5px 5px;" onclick="send1('all');" class="menubtn" value="Съесть всё" type="button">
</b></p><br>



	<p>Пирог с сыром: <span id="bliny_2"><?=$us_data['blin_sir']; ?></span> шт. <b>	
<input id="text1" value="2" name="blin" type="hidden">
<input style="padding: 5px 5px;" onclick="send2('one');" class="menubtn" value="Кушать" type="button">
<input style="padding: 5px 5px;" onclick="send2('all');" class="menubtn" value="Съесть всё" type="button">
</b></p><br>



	<p>Пирог с творогом: <span id="bliny_3"><?=$us_data['blin_smetana']; ?></span> шт. <b>	
<input id="text2" value="3" name="blin" type="hidden">
<input style="padding: 5px 5px;" onclick="send3('one');" class="menubtn" value="Кушать" type="button">
<input style="padding: 5px 5px;" onclick="send3('all');" class="menubtn" value="Съесть всё" type="button">
</b></p><br>

<p>
	<u>Для продажи:</u><br><br>
	Пирог с мясом: <span id="bliny_prodati_1"><?=$us_data['blin_myaso_by']; ?></span> шт. <br><br>
	Пирог с сыром: <span id="bliny_prodati_2"><?=$us_data['blin_sir_by']; ?></span> шт. <br><br>
	Пирог с творогом: <span id="bliny_prodati_3"><?=$us_data['blin_smetana_by']; ?></span> шт. <br><br>
	
	
	<script type="text/javascript" src="../js/noty/jquery.noty.js"></script>
	<script type="text/javascript" src="../js/noty/layouts/top.js"></script>
	<script type="text/javascript" src="../js/noty/themes/default.js"></script>

	
	<?php
	if($us_data['level'] < 3) {
	?>
	<p>Продать пироги</p> <b>Продать пироги Вы сможете после того, как получите 30 уровень.</b><br><p>Купить пироги</p><table>
	
	<?php } else { ?>
	<br>
	<center><h3>Продажа пирогов</h3></center>
	<table align="center" style="width:500px;">
	<form method="post" action="">
	<input type="hidden" name="sell">
	<tr>
	<td>Кол-во</td><td><input type="text" style="width:50%;" name="koll" value="100">
	
	</tr>
	<br>
	<tr>
	<td>Тип</td><td><select name="type">
	<option value="1">С мясом (<?=$us_data['blin_myaso_by']; ?> ед.)
	<option value="2">С сыром (<?=$us_data['blin_sir_by']; ?> ед.)
	<option value="3">С творогом (<?=$us_data['blin_smetana_by']; ?> ед.)
	</select></td>
	</tr>
	<br>
	<tr>
	<td colspan="2"><input style="padding: 5px 5px;" type="submit" class="menubtn" value="Продать"></td>
	</tr>
	</form>
	</table>
	<br>
	<?php } ?>
	<br>
	<center><p>Покупка пирогов</p></center>
	<table align="center" style="width:100%;border: 1px solid rgba(90, 140, 250, 0.56);">
				<tr>
					<th width="150" style="background: #5A8CFA;border: 1px solid rgba(90, 140, 250, 0.56);color: #fff;">Пирог</th>
					<th width="80" style="background: #5A8CFA;border: 1px solid rgba(90, 140, 250, 0.56);color: #fff;">Количество</th>
					<th width="100" style="background: #5A8CFA;border: 1px solid rgba(90, 140, 250, 0.56);color: #fff;">Цена (руб.)</th>
					<th width="180" style="background: #5A8CFA;border: 1px solid rgba(90, 140, 250, 0.56);color: #fff;">Купить</th>
				</tr>
				
				<?php
				$blin_st = $db->query("SELECT * FROM tb_blinaya WHERE user_id != ?i ORDER BY id ASC", $usid);
				
				if(mysqli_num_rows($blin_st) == 0) {
				?>
				
				<tr>
				
				<td colspan="4" style="color:#514454; text-align:center;">Очередь пуста...</td>
				</tr>
				<?php
				
				} else {
				while($blin_stq = $db->fetch($blin_st)) {
				
				if($blin_stq['type'] == 1) $name = 'мясом';
				if($blin_stq['type'] == 2) $name = 'сыром';
				if($blin_stq['type'] == 3) $name = 'творогом';
				if($blin_stq['type'] == 1) { $cen = 1.35; }
				if($blin_stq['type'] == 2) { $cen = 1.85; }
				if($blin_stq['type'] == 3) { $cen = 3.20; }
				?>
				<tr id="trid_4591">
						<td style="border: 1px solid rgba(90, 140, 250, 0.56);">Пирог с <?=$name; ?>
						
						</td>
						<td style="border: 1px solid rgba(90, 140, 250, 0.56);" id="tdid_4591"><?=$blin_stq['koll']; ?></td>
						<td style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=$cen; ?></td>
						<td style="border: 1px solid rgba(90, 140, 250, 0.56);"><form method="post" id="kupit_birja" action="">
							<input type="hidden" name="id" value="<?=$blin_stq['id']; ?>">
							<input type="hidden" name="type" value="<?=$blin_stq['type']; ?>">
							<input style="width: 60%; text-align: center;" type="text" size="5" name="kol"  value="<?=$blin_stq['koll']; ?>">
							<input style="padding: 5px 5px;" class="menubtn" name="kupit"  type="submit" value="Купить">
							</form></td>
						</tr>
						
						<?php } } ?></table><br>Общая очередь:<br>
						<table style="width:100%;border: 1px solid rgba(90, 140, 250, 0.56);">
				<tr>
					<th width="150" style="background: #5A8CFA;border: 1px solid rgba(90, 140, 250, 0.56);color: #fff;">Пирог</th>
					<th width="80" style="background: #5A8CFA;border: 1px solid rgba(90, 140, 250, 0.56);color: #fff;">Количество</th>
					<th width="100" style="background: #5A8CFA;border: 1px solid rgba(90, 140, 250, 0.56);color: #fff;">Цена (руб.)</th>
					<th width="150" style="background: #5A8CFA;border: 1px solid rgba(90, 140, 250, 0.56);color: #fff;">Дата добавл.</th>
					
					<th width="150" style="background: #5A8CFA;border: 1px solid rgba(90, 140, 250, 0.56);color: #fff;">Снять</th>
					
				</tr>
				<?php
				$blin_q = $db->query("SELECT * FROM tb_blinaya ORDER BY id ASC");
				
				while($blin_sq = $db->fetch($blin_q)) {
			
				if($blin_sq['type'] == 1) $name = 'мясом';
				if($blin_sq['type'] == 2) $name = 'сыром';
				if($blin_sq['type'] == 3) $name = 'творогом';
				if($blin_sq['type'] == 1) { $cen = 1.35; }
				if($blin_sq['type'] == 2) { $cen = 1.85; }
				if($blin_sq['type'] == 3) { $cen = 3.20; }
				?>
				<tr id="trid_4591">
						<td style="border: 1px solid rgba(90, 140, 250, 0.56);">Пирог с <?=$name; ?>
						<?php 
						if($blin_sq['user_id'] == $usid) {echo '<br> <font color="red">Моя ставка!</font>';}
						?>
						</td>
						<td style="border: 1px solid rgba(90, 140, 250, 0.56);" id="tdid_<?=$blin_sq['id']; ?>"><?=$blin_sq['koll']; ?></td>
						<td style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=$cen; ?></td>
						<td style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=date('Y-m-d H:i', $blin_sq['date']); ?></td>
						
						<?php
						if($blin_sq['user_id'] == $usid) {
						?>
						<td style="border: 1px solid rgba(90, 140, 250, 0.56);"><form method="post" action="">
						<input type="hidden" name="snat" value="<?=$blin_sq['id']; ?>">
						<input type="hidden" name="type" value="<?=$blin_sq['type']; ?>">
						
						<input style="text-align: center;" name="kolvo" type="text" size="5" value="100">
						<input style="padding: 5px 5px; display: block; margin: 0 auto;" class="menubtn" style="margin-left: 9%;padding: 4px 37px;" type="submit" value="Снять">
						
						</form></td>
						<?php } else { ?>
						<td>&nbsp;</td>
						<?php } ?>
						</tr>
						
				<?php } ?>
						</table><br> 	<div id="formsgifts" style="display: none"></div>
</p>						
						<?php } ?>