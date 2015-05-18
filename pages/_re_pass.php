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
 <a href="/profile">Смена данных</a> | <a href="/plat_pass">Получение/Смена платежного пароля</a> | <a href="/re_pass">Смена пароля от игры</a><br>				<h3>Смена пароля:</h3>
  <br>
 <?php
 if(isset($_POST['currentpass'])) {
 $oldpass = sf($_POST['currentpass']);
 $pass1 = sf($_POST['pass1']);
 $pass2 = sf($_POST['pass2']);
 $mdpassold = md5Password($oldpass);
 
 if($mdpassold == $us_data['password']) {
 if($pass1 == $pass2) {
 $newpass = md5Password($pass2);
 $db->query("UPDATE tb_users SET password = ?s WHERE id = ?s", $newpass, $usid);
 echo '<center><font color="green">Пароль успешно изменен! Перенаправление...</font></center>';
 Header("Refresh: 2, /profile");
 }else echo '<center><font color="red">Новый пароль и повтор пароля не совпадают!</font></center>';
 
 }else echo '<center><font color="red">Старый пароль не верный</font></center>';
 
 }
 
 ?>
				<form action="" method="post">
<p>
				<input type='password' style="width: 45%;"placeholder="Текущий пароль" maxlength="30" name='currentpass' required />
</p><p>
				<input pattern="[0-9A-Za-z]{6,20}" required="" style="width: 45%;"placeholder="Новый пароль" title="Пароль должно иметь от 6 до 20 символов (только латинские буквы и цифры)" type='password' maxlength="30" name='pass1' />
</p><p>
				<input pattern="[0-9A-Za-z]{6,20}" required="" style="width: 45%;"placeholder="Новый пароль (Подтверждение)" title="Пароль должно иметь от 6 до 20 символов (только латинские буквы и цифры)" type='password' maxlength="30" name='pass2' />
				</p>
				<input class="menubtn" type='submit' value='Изменить' /> 
				</form>         
 	<div id="formsgifts" style="display: none"></div>