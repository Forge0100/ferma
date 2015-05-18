<center> <div class="tegname"><h2>Пополнение баланса</h2></div><br> </center>
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

$page = 'Пополнение баланса';
?>

<p>
	<a href="http://vilpay.com" target="_blank"><img src="/images/payeer.png" width="150" height="66" border="0"></a><br>
	Для пополнения баланса, введите сумму пополнения. Нажмите кнопку "Оплатить". Для регистрации в системе <a href="http://vilpay.com" target="_blank">VilPay.com</a> нажмите на <a href="http://vilpay.com" target="_blank">ссылку</a>.
	После оплаты, сумма будет добавлена к Вашему балансу автоматически.<br><br>
	<b>Платежные системы:</b> QiWi Wallet, Яндекс.Деньги, W1, Liqpay.com, Perfect Money, Liberty Reserve, Payeer, VISA, MasterCard, 2СO, МТС, Мегафон, Сбербанк, Альфа-Банк, ВТБ24, Русский Стандарт, Связной Банк, Промсвязьбанк и другие...
</p>

<?php

require_once('cpayeer.php');
$setp = $db->getRow("SELECT * FROM tb_conf_site WHERE id = 1");

if(isset($_POST['amount'])) {
$sum	= sprintf ("%01.2f", str_replace(',', '.', $_POST['amount']));
$ps = intval($_POST['ps']);

if($sum >= 0.1) {
if($ps) {
$db->query("INSERT INTO tb_enter SET ?u", array('user_id' => $usid, 'login' => $login, 'summa' => $sum, 'date' => time(), 'status' => '0'));
$lid = $db->insertId();

// Oopay
if($ps == 1) {
	header("Location: /oplata/ooopay/payeer.php?amount=".$_POST['amount'] );
// Payeer
}elseif($ps == 2) {
	header("Location: /oplata/payeer/payeer.php?amount=".$_POST['amount'] );
// Free-kassa
}elseif ($ps == 3) {
	header("Location: /oplata/freekassa/payeer.php?amount=".$_POST['amount'] );
}						
								
}else echo '<center><font color="red">Укажите платежную систему</font></center>';
}else echo '<center><font color="red">Минимум для пополнения 0.1 руб.</font></center>';

}

?>
<form method="post" action="">
	<p>
		<input style="margin-left: 0px;width:12%;" type="text" size="15" placeholder="Сумма" value="0.1" maxlength="7" name="amount"></p>
		<label></label>
		<p style="margin-left:13px;">Платежная система:
		<select name="ps">
			<option value="1">Ooopay.org
			
			<option value="2">Payeer.com
			
			<option value="3">freekassa.com
			
			<!-- <option value="4">interkassa.com
			
			<option value="5">webmoney.ru -->
		</select>
	</p>
	
	<br><br>

	<!-- <p>
		Системы, которые отключены от блока "Плат система"
		<option value="1">freekassa.com
		<option value="3">interkassa.com
	</p> -->

	<br><br>
		
    <input class="menubtn" value="Пополнить" type="submit" />
</form>
<br>
<form action="https://merchant.webmoney.ru/lmi/payment.asp" method="POST">
	<input type="hidden" name="LMI_PAYMENT_AMOUNT" value="1.00">
	<input type="hidden" name="LMI_PAYMENT_DESC_BASE64" value="0JfQsNGA0LDQsdCw0YLRi9Cy0LDQuSDQuNCz0YDQsNGP">
	<input type="hidden" name="LMI_PAYEE_PURSE" value="R205726746647">
	<input type="submit" class="wmbtn" style="font-famaly:Verdana, Helvetica, sans-serif!important;padding:0 10px;height:30px;font-size:12px!important;border:1px solid #538ec1!important;background:#a4cef4!important;color:#fff!important;" value=" &#1086;&#1087;&#1083;&#1072;&#1090;&#1080;&#1090;&#1100; 1000 WMR ">
</form>
