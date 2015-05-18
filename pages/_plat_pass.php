<center> <div class="tegname"><h2>Профиль</h2></div> </center>
<br>
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
$page = 'Профиль';
?>

                           
                                <a href="/profile">Смена данных</a> | <a href="/plat_pass">Получение/Смена платежного пароля</a> | <a href="/re_pass">Смена пароля от игры</a><br>


								<h3>Платежный пароль</h3>
								
								<?php
if(isset($_POST['re_pay_pass'])) {
$platpass = rand(1000, rand(4585, 9898));
$dd = time() + (60*60*24*7);
$email = $us_data['email'];
$text = 'Здравствуйте <b>'.$_SESSION['login'].'!</b><br />Вы запросили востановление платежного пароля в сервисе <a href=\'http://'.$_SERVER['HTTP_HOST'].'/\' target=\'_blank\'>http://'.$_SERVER['HTTP_HOST'].'</a><br />Ваш новый платежный пароль <b>'.$platpass.'</b><br>Заметьте, что данный платежный пароль начнет действовать по истечению 7 дней с момента его изменения!';
$db->query("UPDATE tb_users SET plat_pass = ?s, date_plat_pass = ?s WHERE id = ?i", $platpass, $dd, $usid);
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			$headers.= "From: support@".$_SERVER['HTTP_HOST']." \r\n";
mail($email, 'Новый платежный пароль  - ('.$_SERVER['HTTP_HOST'].' / '.$_SESSION['login'].')', $text, $headers);
echo '<br><center><font color="green">Новый платежный пароль отправлен вам на почту!</font></center>';
Header("Refresh: 2, /profile");
}
?>
								
								<br>
				Платежный пароль – это дополнительная защита учетной записи от взлома и кражи средств. Платежный пароль используется для вывода средств из проекта и перевода средств другому пользователю.<br>
				<br>
				<form action="" method="post">
							<input class="menubtn" name="re_pay_pass" type="submit" value="Восстановить платежный пароль" /> 
							</form>
							<font color="#ff0000">
							<br>
							Внимание! При восстановлении старый пароль будет недействителен. Процедура восстановления займет 7 суток. Не используйте эту функцию, если Вы знаете свой платежный пароль.</font>			 	<div id="formsgifts" style="display: none"></div>