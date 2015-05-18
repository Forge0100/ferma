<center> <div class="tegname"><h2>Обмен средств</h2></div><br> </center>
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
$page = 'Обмен средств';
if(isset($_POST['amount'])) {
$sum = sf($_POST['amount']);
$date = time();
if($sum > 0) {
if($us_data['money_out'] >= $sum) {
$db->query("UPDATE tb_users SET money_out = money_out - ?i, money = money + ?i WHERE id = ?i", $sum, $sum, $usid);
$db->query("INSERT INTO tb_history SET ?u", array('user_id' => $usid, 'summa' => $sum, 'date' => $date, 'comment' => 'Обмен средств на сумму $sum', 'type' => 'convert'));
echo '<center><font color="green">Вы успешно обменяли средства</font></center><br>';
}else echo '<center><font color="red">Не достаточно средств на балансе</font></center><br>';

}else echo '<center><font color="red">Не верная сумма</font></center><br>';
}
?>

<p>
		Обменять денежные средства с баланса для вывода на баланс для оплаты.<br>
		Комиссия системы за обмен составляет <b>0%</b>.<br>
		
		</p>

		<form method="post" action="">
			<p><label title="Для добавления всей суммы, нажмите на цифры!" onclick= this.form.elements["amount"].value=<?=$us_data['money_out']; ?>>Сумма (Доступно: <span ><?=$us_data['money_out']; ?></span> руб)</label></p>
			<input style="margin-left:0px; width:45%;" type="text" size="15" value="" maxlength="7" name="amount">
			
			<label></label>
			<input class="menubtn" value="Обменять" type="submit" />

		</form>

		<div id="formsgifts" style="display: none"></div>