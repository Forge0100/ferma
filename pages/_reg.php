<center> <div class="tegname"><h2>Регистрация</h2></div> </center>
<br>
 <p>Если вы забыли свой пароль, воспользуйтесь ссылкой</p> "<a href="/remind/" title="">Забыли пароль?</a>".<br>
 <br>
<?

if(isset($_SESSION['id']) and isset($_SESSION['login'])) {

print "<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">

<script language=\"javascript\">top.location.href=\"/account/\";</script>
<title>Перенаправление</title>
</head>
<body bgcolor=\"#eeeeee\" topmargin=\"0\" leftmargin=\"0\">
Вы вошли в систему как <b>".$login."</b><br>
Через секунду вы будете перемещены на сайт.<br>
Если устали ждать жмите <a href=\"/account/\">здесь!</a>
</body>
</html>";
exit;
}
$page = 'Регистрация';
if(isset($_COOKIE['rid']) and $_COOKIE['rid'] > 0 and !empty($_COOKIE['rid'])) {
$ref_id = intval($_COOKIE['rid']);
} else { 
$ref_id = 0;
}

if(isset($_POST['username'])) {
//Делаем обработку и регистрируем!
$login = IsLogin($_POST['username']);
$pass = IsPassword($_POST['pass']);
$cpass = IsPassword($_POST['cpass']);
$passw = md5Password($pass);
$mail = IsMail($_POST['email']);
$ptaezniparol = ($_POST['ptaezniparol']);
$pol = intval($_POST['sex']);
$law = intval($_POST['law']);
$regip = $_SERVER['REMOTE_ADDR'];
$mailing = intval($_POST['mailing']);
//if (intval($_POST['sendmail']) > 0) {
//$sendmail = intval($_POST['sendmail']);
//} else { $sendmail = 0; }
$date_reg = time();



$uss = $db->query("SELECT * FROM tb_users WHERE username = ?s", $login);
$log_sum = $db->numRows($uss);

$uss1 = $db->query("SELECT * FROM tb_users WHERE email = ?s", $mail);
$mail_sum = $db->numRows($uss1);
	if((1==1)||isset($_SESSION['captcha']) && strtolower($_SESSION['captcha']) == strtolower($_POST['keystring'])){	
		
		if($login !== FALSE) {
		
			if($pass !== FALSE) {
			
				if($pass == $cpass) {
				
					if($mail !== FALSE) {
					
						if($law == 1) {
						
							if($log_sum == 0) {
							
								if($mail_sum == 0) {
								
								
									//Заносим в базу!
									$db->query("INSERT INTO tb_users SET ?u", array('username' => $login, 'password' => $passw, 'email' => $mail, 'plat_pass' => $ptaezniparol, 'pol' => $pol, 'date_reg' => $date_reg, 'ip_reg' => $regip, 'ref_id' => $ref_id, 'energy' => '100'));
									//$db->query("insert into tb_users ('username', 'password', 'email', 'plat_pass', 'pol', 'date_reg', 'ip_reg', 'ref_id', 'energy') values (?s, ?s, ?s, ?s, ?i, ?s, ?s, ?i, ?i)", $login, $passw, $mail, $ptaezniparol, $pol, $date_reg, $regip, $ref_id, '100');
									$w = $db->getRow("SELECT * FROM tb_stat_user_reg ORDER BY id DESC LIMIT 1");
									if(time() - $w['date'] > 86400 or (mysql_num_rows($q) == 0)) {
									$db->query("INSERT INTO tb_stat_user_reg (date, kol) VALUES (?s, '1')", time());
									
									}else{
									$db->query("UPDATE tb_stat_user_reg SET kol = kol + 1 WHERE id = ?i", $w['id']);
									
									}
			//if ($sendmail == 1) {	// Отправляем данные на почту					
			//$subject = "Поздравляем Вас с успешной регистрацией";
			//$headers  = 'MIME-Version: 1.0' . "\r\n";
			//$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			//$headers.= "From: support@fermadruzya.ru".$_SERVER['HTTP_HOST']." \r\n";

			//$text = "Здравствуйте <b>".$login."!</b><br />Поздравляем Вас с успешной регистрацией в сервисе <a href=\"http://".$_SERVER['HTTP_HOST']."/\" target=\"_blank\">http://".$_SERVER['HTTP_HOST']."</a><br />Ваш Login: <b>".$login."</b><br />Ваш пароль: <b>".$cpass."</b><br /><br />С Уважением, администрация проекта ".$_SERVER['HTTP_HOST'];

			//mail($mail, $subject, $text, $headers);
			//}					// Отправили	
									echo "<font color='green' style='font-size: 17px;'>Вы успешно зарегистрировались!<br><br>Ваш Логин: <b>$login</b> <br>Ваш пароль: <b>$cpass</b> <br>Ваш платежный пароль: <b>$ptaezniparol</b> <br><br></font><font color='red' style='font-size: 17px;'>* Не потеряйте платежный пароль!<br><br></font>";
									
									
								}else echo '<p style="color:#ff0f0f;">Такой E-mail уже зарегистрирован!</p>';
								
							}else echo '<p style="color:#ff0f0f;">Такой логин уже существует!</p>';
							
						}else echo '<p style="color:#ff0f0f;">Вы не согласились с правилами проекта!</p>';
						
					}else echo '<p style="color:#ff0f0f;">Не верный формат E-mail</p>';
					
				}else echo '<p style="color:#ff0f0f;">Пароли не совпадают!</p>';
				
			}else echo '<p style="color:#ff0f0f;">Пароль должен быть от 10 до 30 символов!</p>';
			
		}else echo '<p style="color:#ff0f0f;">Логин должен содержать от 3-х до 30 символов!</p>';
		
	} else echo '<p style="color:#ff0f0f;">Неверно введен проверочный код...</p></p>';
}

 $reff = $db->query("SELECT username FROM tb_users WHERE id = ?i", $ref_id);
 $ref_k = $db->numRows($reff);
 $ref = $db->fetch($reff);
?>

<a name="code"></a>

<form action="" method="POST" autocomplete="on" >
        
        <p>
		<input style="width: 45%;" name="username" value="" placeholder="Введите логин" required type="text" size='25' maxlength='30'></p>
        <p>
        <input style="width: 45%;" type="password" size="25" maxlength="30" placeholder="Введите пароль" required name="pass"></p>
        <p>
		<input style="width: 45%;" type="password" size="25" maxlength="30" placeholder="Повторите пароль" required name="cpass"></p>
		<input name="ptaezniparol" value="<? echo mt_rand(1000, 9999); ?>" readonly style="display: none;">
		<p style="  margin-left: 13px; border-radius: 3px;">
		<select maxlength="1" name="sex" required>
		
		<option  value="1">М</option>
		<option  value="2">Ж</option>
		</select></p>
		<p>
        <input style="width: 45%;" name="email" value="" placeholder="Введите емайл" required type="email" size='25' maxlength='50'></p>
		<p style="  margin-left: 13px;">Вас пригласил: <u><?PHP
		if($ref_k == 0) echo 'Сам пришел!';
		else echo $ref['username'];
		
		?></u></p>
		<p>
		<img style="width:80px;  margin-left: 13px;" title="Если Вы не видите число на картинке, нажмите на картинку мышкой" onclick="this.src=this.src+'&amp;'+Math.round(Math.random())" src="/captcha.php?<?php echo session_name()?>=<?php echo session_id()?>"><br>
		<input style="width:12%;" name="keystring" value="" type="text" size='10' placeholder="Код" required maxlength='6'></p>
        <br /><label></label>
		<input class="check" type="checkbox" name="law" value="1" required> <b>Я полностью принимаю условия <a href="/tos/" target="_blank">пользовательского соглашения</a>. </b><br>
		<input class="check" type="checkbox" name="mailing" value="1"> <b>Я согласен Получать новости на емайл.</b><br>
		<!--<input class="check" type="checkbox" name="sendmail" value="1"> <b>Выслать регистрационые данные на емайл.</b><br>-->
		<label></label>
        <input class="menubtn" value="Зарегистрироваться" type="submit">
    </form>

