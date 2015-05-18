<center> <div class="tegname"><h2>Восстановление пароля</h2></div> </center>
<br>
<?php
if(isset($_POST['user'])) {
$user = sf($_POST['user']);
if(isset($_SESSION['captcha']) && strtolower($_SESSION['captcha']) == strtolower($_POST['code'])){	
$q = $db->query("SELECT * FROM tb_users WHERE username = ?s", $user);
if($db->numRows($q) == 1) {
$w = $db->fetch($q);
	if($w["ban"] == 0) {

$chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
$max=10; 
$size=strlen($chars)-1;
$cpass=null; 

while($max--) 
    $cpass.=$chars[rand(0,$size)]; 
$pass = md5Password($cpass);
$db->query("UPDATE tb_users SET password = ?s WHERE username = ?s", $pass, $user);




			$subject = "Востановление пароля - (".$_SERVER['HTTP_HOST']." / ".$user.")";
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			$headers.= "From: support@".$_SERVER['HTTP_HOST']." \r\n";

			$text = "Здравствуйте <b>".$user."!</b><br />Вы запросили востановление пароля в сервисе <a href=\"http://".$_SERVER['HTTP_HOST']."/\" target=\"_blank\">http://".$_SERVER['HTTP_HOST']."</a><br />Ваш Логин: <b>".$user."</b><br />Ваш Новый Пароль: <b>".$cpass."</b><br /><br />С Уважением, администрация проекта ".$_SERVER['HTTP_HOST'];

			mail($w['email'], $subject, $text, $headers);
			
			echo '<center><font color="green">Новый пароль отправлен Вам на почту!</font></center>';
}else echo '<center><font color="red">Аккаунт заблокирован!</font></center>';
			}else echo '<center><font color="red">Пользователь не найден</font></center>';

}
}
?>


<form action="" method="post">
		<p>
		<input style="width: 45%;" name="user" placeholder="Введите ваш логин в игре" value="" type="text" size="20" required /></p>
		<p>
		<img style="width:80px;  margin-left: 13px;" align="middle" src="/captcha.php?<?php echo session_name()?>=<?php echo session_id()?>" name="capc" alt="" />
		<!--a href="#" onclick="this.src=this.src+'&amp;'+Math.round(Math.random())"><img src="/images/reload.gif" align="middle" border="0" alt="" /></a><br /-->
		<label></label>
		<input style="width:12%;" name="code" placeholder="Код" value="" type="text" size='15' maxlength='6' required /></p>
		<label></label>
		<input class="menubtn" value="Высылать пароль" type="submit" />  
	</form>