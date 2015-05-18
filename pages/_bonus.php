<center> <div class="tegname"><h2>Бонус</h2></div><br> </center>
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
$page = 'Бонус';

if(isset($_POST['amount'])) {
$sum = sf($_POST['amount']);

if($sum > 0) {
if($us_data['money'] >= $sum) {
$db->query("UPDATE tb_bonus_rezerv SET summa = summa + ?i, vsego = vsego + ?i WHERE id = 1", $sum, $sum);
$db->query("UPDATE tb_users SET money = money - ?i WHERE id = ?i", $sum, $usid);
$db->query("INSERT INTO tb_bonus_add SET ?u", array('user_id' => $usid, 'login' => $login, 'sum' => $sum, 'date' => time()));
echo '<center><font color="green">Вы успешно пополнили резерв бонуса</font></center><br>';
Header("Refresh: 2, /bonus");
exit();
}else echo '<center><font color="red">Не достаточно средств на балансе</font></center><br>';
}else echo '<center><font color="red">Не корректная сумма</font></center><br>';
}


$rez = $db->getRow("SELECT * FROM tb_bonus_rezerv WHERE id = 1");

if(isset($_GET['add'])) {

?>
<style>
		.donate{
			padding: 10px!important;
			margin-left: 10px!important;
			margin-top: 10px!important;
			width: 200px;
			border:6px #21aedb ridge;
			float: left;
			text-align: center;
			position: relative;
		}
		</style>
		<h3>Пополнить резерв бонусов <a href="/bonus/"><<Бонус</a></h3>
			<div class="donate">
				<b>Резерв бонусов</b><br />
		Пополнено на: <?=$rez['vsego'];?> руб<br>
		В наличии: <?=$rez['summa'];?> руб<br>
		<form method="post" action="">
			<input type="text" style="margin-top: 5px;" size="10" value="10" maxlength="7" name="amount" />	
			<label></label>
			<input class="buttonmail" value="Пополнить" type="submit" />
		</form>
		</div>
		<div class="clear"></div>
		<br>
			
				<h3>Последние 30 пополенений</h3>
					<table  border="1" style="width:100%;">
						<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);">
							<th align="center" width="150"  style="background: #5A8CFA;"><font color="#FFFFFF">Фермер</font></th>
							<th align="center" width="100" style="background: #5A8CFA;"><font color="#FFFFFF">Сумма</font></th>
							<th align="center" width="187" style="background: #5A8CFA;"><font color="#FFFFFF">Дата</font></th>
						</tr>
						<?php
						$a = $db->query("SELECT * FROM tb_bonus_add ORDER BY id DESC LIMIT 30");
						while($s = $db->fetch($a)) {
						?>
					<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);" align="center">
						<td style="  border: 1px solid rgba(90, 140, 250, 0.56);"><a href="/wall/user/<?=$s['id'];?>" title="Смотреть стену фермера <?=$s['login'];?>!"><?=$s['login'];?></a></td>
						<td style="  border: 1px solid rgba(90, 140, 250, 0.56);"><?=$s['sum'];?></td>
						<td style="  border: 1px solid rgba(90, 140, 250, 0.56);"><?=date("d.m.Y H:i", $s['date']);?></td>
					</tr>
					<?php } ?>
					</table>
				 	

<?php
return;
}




$time = time();
$bonussumma = 0.03;
if(isset($_POST['get'])) {
	if($us_data['energy'] >= 2) {
	
$code = sf($_POST['code']);
if(isset($_SESSION['captcha']) && strtolower($_SESSION['captcha']) == strtolower($code)){


$w = $db->query("SELECT * FROM tb_bonus WHERE user_id = ?i ORDER BY id DESC LIMIT 1", $usid);
if($db->numRows($w) > 0) {
$e = $db->fetch($w);
if($e['date'] > (time() - 3600)) {
echo '<center><font color="red">Вы уже получали бонус за последний час!</font></center><br>';
}elseif($rez['summa'] < 0.03) {
echo '<center><font color="red">Резерв бонуса пуст...</font></center><br>';
}else{
$db->query("INSERT INTO tb_bonus SET ?u", array('login' => $login, 'user_id' => $usid, 'date' => $time, 'sum' => '0.03'));
$db->query("UPDATE tb_users SET money = money + ?i, energy = energy - 2 WHERE id = ?i", $bonussumma, $usid);
$db->query("UPDATE tb_bonus_rezerv SET summa = summa - ?i WHERE id = 1", $bonussumma);
$db->query("INSERT INTO tb_history SET ?u", array('user_id' => $usid, 'summa' => '0.03', 'date' => $date, 'comment' => 'Получил бонус 0.03', 'type' => 'bonus'));
echo '<center><font color="green">Вы успешно получили бонус!</font></center><br>';
Header("Refresh: 2, /bonus");
}

}elseif($rez['summa'] < 0.03) {
echo '<center><font color="red">Резерв бонуса пуст...</font></center><br>';

}else{
$db->query("INSERT INTO tb_bonus SET ?u", array('login' => $login, 'user_id' => $usid, 'date' => $time, 'sum' => '0.03'));
$db->query("UPDATE tb_users SET money = money + ?i, energy = energy - 2 WHERE id = ?i", $bonussumma, $usid);
$db->query("UPDATE tb_bonus_rezerv SET summa = summa - ?i WHERE id = 1", $bonussumma);
$db->query("INSERT INTO tb_history SET ?u", array('user_id' => $usid, 'summa' => '0.03', 'date' => $date, 'comment' => 'Получил бонус 0.03', 'type' => 'bonus'));
echo '<center><font color="green">Вы успешно получили бонус!</font></center><br>';
Header("Refresh: 2, /bonus");
}
}else echo '<center><font color="red">Не верный код с картинки!</font></center><br>';

} else echo '<center><font color="red">Недостаточно энергии! Покушайте пирог!</font></center></br>';
}

?> 

 <p>Каждый час вы можете получать бонус на баланс оплаты в размере 0.03 руб.<br> При сборе бонусов у вас списывается 2 ед энергии.<br> 
			Резерв бонусов: <?=$rez['summa'];?> руб. <a href="/bonus/add">Пополнить>></a><br><h3>Получить бонус</h3><p>				
				<form method="post" action="">
					<input type="hidden" name="verify" value="76133da129bd70a30c6d940f2a3f2f4f">
					<label>Введите код:</label>
					<img style="width:80px;margin-left:13px;" title="Если Вы не видите число на картинке, нажмите на картинку мышкой" onclick="this.src=this.src+'&amp;'+Math.round(Math.random())" src="../captcha.php?<?php echo session_name()?>=<?php echo session_id()?>">	
					<label></label>
					<input style="width:12%;" name="code" placeholder="Код" required value="" type="text" size='10' maxlength='4'>
					<label></label>					
					<input type="submit"  name="get" value="Получить" class="menubtn">
				</form>
			
				<h3>Последние 20 пополнений резерва бонусов</h3>
					<table  border="1" style="width:100%;">
						<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);">
							<th align="center" width="150" style="background: #5A8CFA;"><font color="#FFFFFF">Фермер</font></th>
							<th align="center" width="100"style="background: #5A8CFA;"><font color="#FFFFFF">Сумма</font></th>
							<th align="center" width="187"style="background: #5A8CFA;"><font color="#FFFFFF">Дата</font></th>
						</tr>
						<?php
						$a = $db->query("SELECT * FROM tb_bonus_add ORDER BY id DESC LIMIT 20");
						while($s = $db->fetch($a)) {
						?>
					<tr  style="  border: 1px solid rgba(90, 140, 250, 0.56);" align="center">
						<td style="  border: 1px solid rgba(90, 140, 250, 0.56);"><a href="/wall/user/<?=$s['id'];?>" title="Смотреть стену фермера <?=$s['login'];?>!"><?=$s['login'];?></a></td>
						<td style="  border: 1px solid rgba(90, 140, 250, 0.56);"><?=$s['sum'];?></td>
						<td style="  border: 1px solid rgba(90, 140, 250, 0.56);"><?=date("d.m.Y H:i", $s['date']);?></td>
					</tr>
					<?php } ?>
					</table>
	</table>
					
			<h3>Последние 10 полученных бонусов</h3>
				<table  border="1" style="width:100%;">
					<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);">
						<th align="center" width="150" style="background: #5A8CFA;"><font color="#FFFFFF">Фермер</font></th>
						<th align="center" width="100" style="background: #5A8CFA;"><font color="#FFFFFF">Сумма</font></th>
						<th align="center" width="187" style="background: #5A8CFA;"><font color="#FFFFFF">Дата</font></th>
					</tr>
					<?php
					$d = $db->query("SELECT * FROM tb_bonus ORDER BY id DESC LIMIT 10");
					while($ss = $db->fetch($d)){
					?>
				<tr  style="  border: 1px solid rgba(90, 140, 250, 0.56);" align="center">
					<td style="  border: 1px solid rgba(90, 140, 250, 0.56);"><a href="/wall/user/<?=$ss['user_id']; ?>" title="Смотреть стену фермера <?=$ss['login']; ?>!"><?=$ss['login']; ?></a></td>
					<td style="  border: 1px solid rgba(90, 140, 250, 0.56);"><?=$ss['sum']; ?></td>
					<td style="  border: 1px solid rgba(90, 140, 250, 0.56);"><?=date("d.m.Y H:i", $ss['date']); ?></td>
				</tr>
				<?php } ?>
	</table>	 	<div id="formsgifts" style="display: none"></div>