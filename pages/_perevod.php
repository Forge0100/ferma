<center> <div class="tegname"><h2>Перевод средств</h2></div><br> </center>
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
$page = 'Перевод средств';

if(isset($_POST['usersent'])) {
$user = sf($_POST['usersent']);
$sum = sf($_POST['amount']);
$pay_pass = intval($_POST['pay_pass']);
$date = time();
if($user != $us_data['username']) {
if($sum > 0) {
if($us_data['plat_pass'] == $pay_pass) {
if($us_data['money'] >= $sum) {
$q = $db->query("SELECT * FROM tb_users WHERE username = ?s", $user);
if($db->numRows($q) == 1) {
$m = $sum - ($sum * 0.05);
$db->query("UPDATE tb_users SET money = money - ?i WHERE id = ?i", $sum, $usid);
$db->query("UPDATE tb_users SET money = money + ?i WHERE username = ?s", $m, $user);
$db->query("INSERT INTO tb_history SET ?u", array('user_id' => $usid, 'summa' => $sum, 'date' => $date, 'comment' => 'Перевод средств пользователю $user', 'type' => 'perevod'));
echo '<center><font color="green">Вы успешно отправили средства пользователю '.$user.'</font></center><br>';
}else echo '<center><font color="red">Пользователь не найден</font></center><br>';
}else echo '<center><font color="red">Недостаточно средств на балансе</font></center><br>';
}else echo '<center><font color="red">Не верный платежный пароль</font></center><br>';
}else echo '<center><font color="red">Не верная сумма</font></center><br>';
}else echo '<center><font color="red">Нельзя передать деньги самому себе</font></center><br>';
}
?>

<p>Передать средства другому пользователю с баланса для оплаты на баланс для оплаты.<br />
				<p color="#ff0000">Комиссия системы за перевод составляет <b>5%</b>.</p> </p>
				<br><br>
			<style>
			.custom{
				width: 300px!important;
			}
			</style>
				<form method="post" action="">
					<p>
					<input style="width: 45%;" type="text" size="15" placeholder="Пользователь" value="" maxlength="30" name="usersent"></p>
					<p>
					<input style="width: 45%;" type="text" size="15" placeholder="Сумма" value="" maxlength="7" name="amount"></p>
					<p>					
					<input style="width: 45%;" type="text" size="15" placeholder="Платежный пароль" value="" maxlength="4" name="pay_pass"><a style="margin-left:13px;" class="tooltip" href="javascript:void(0)">[?]<span class="custom help" style="width: 450px;"><em>Платежный пароль</em>
					Можно получить в раздел Пользователь -> Профиль.</span></a></p>
					<label></label>
					
					<input class="menubtn" value="Передать средства" type="submit">
				</form>
				<br><br>
					<div id="formsgifts" style="display: none"></div>