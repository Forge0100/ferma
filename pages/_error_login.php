<script type="text/javascript">
jQuery(document).ready(function(){
setInterval("jQuery('#loadBA').load('#div #loadGA');"); //У меня интервал обновления блока - минута
});
</script>

<?php
	if (isset($_POST['user'])) {
		$login = IsLogin($_POST['user']);
		$pass = IsPassword($_POST['pass']);
		
		
		
		$cpass = md5Password($pass);
		$us = $db->query("SELECT * FROM tb_users WHERE username = ?s AND password = ?s", $login, $cpass);
		$usq = $db->numROws($us);
		$log_data = $db->fetch($us);
		$date = time();
		$ip_l = $_SERVER['REMOTE_ADDR'];
		if(isset($_SESSION['captcha']) && strtolower($_SESSION['captcha']) == strtolower($_POST['keystring'])){

	
		
			if($login !== FALSE) {
			
				if($pass !== FALSE) {
				
					if($usq == 1) {
					
					   if($log_data["ban"] == 0) {
						
						$_SESSION["login"] = $log_data["username"];
						$_SESSION["id"] = $log_data["id"];
						$login = $_SESSION['login'];
						$usid = $_SESSION['id'];
						$db->query("UPDATE tb_users SET date_login = ?s, ip_login = ?s WHERE id = ?i", $date, $ip_l, $usid);
						$db->query("INSERT INTO tb_history SET ?u", array('user_id' => $usid, 'ip' => $ip_l, 'date' => $date, 'comment' => $_SERVER['HTTP_USER_AGENT'], 'type' => 'vhod'));
						//Header("Location: /account");
						print "<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">

<script language=\"javascript\">setTimeout('location.replace(\"/news/\")', 500);</script>

<title>Перенаправление</title>
</head>
<body bgcolor=\"#eeeeee\" topmargin=\"0\" leftmargin=\"0\">
<h1>АВТОРИЗАЦИЯ</h1>Вы вошли в систему как <b>".$login."</b><br>
Через секунду вы будете перемещены на сайт.<br>
Если устали ждать жмите <a href=\"/news/\">здесь!</a>
</body>
</html>";
						}else echo '<p><div class="tegname"><h2>АВТОРИЗАЦИЯ</h2></div><br><b>Отказано в доступе!</b><br><span = style="color:red">Ваш аккаунт заблокирован!</span></p>';
					
					}else echo '<p><div class="tegname"><h2>АВТОРИЗАЦИЯ</h2></div><br><b>Отказано в доступе!</b><br><span = style="color:red">Неправильный логин или пароль!</span></p>';
					
				}else echo '<p><div class="tegname"><h2>АВТОРИЗАЦИЯ</h2></div><br><b>Отказано в доступе!</b><br><span = style="color:red">Не верный формат пароля!</span></p>';
				
			}else echo '<p><div class="tegname"><h2>АВТОРИЗАЦИЯ</h2></div><br><b>Отказано в доступе!</b><br><span = style="color:red">Не верный формат логина!</span></p>';
			
			}else echo '<p><div class="tegname"><h2>АВТОРИЗАЦИЯ</h2></div><br><b>Отказано в доступе!</b><br><span = style="color:red">Неверно введен проверочный код!</span></p>';
	
			
	} else echo '<p><h1>АВТОРИЗАЦИЯ</h1><b>Отказано в доступе!</b><br><span = style="color:red">Не известная ошибка</span></p>';

?>