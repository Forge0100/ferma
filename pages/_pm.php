<center> <div class="tegname"><h2>Внутренняя почта</h2></div><br> </center>
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
}?>
<?php
$page = 'Внутренняя почта';
?>
<style>
.bloas5ec {
width: 100%;
border-bottom: 1px solid #0F92CC;
}
</style>
<?php
			$piaadem = $db->numRows($db->query("SELECT * FROM tb_pm_in WHERE user_id_1 = ?i AND status = 0", $usid));
			
			?>
			

<a href="/pm/" class="menubtn">Написать письмо</a>  <a href="/pm/in" class="menubtn">Входящие <?php
		if($piaadem != '0') {
		echo "<font color='#fff'>$piaadem</font>"; 
		}else{
		echo '';
		}
       ?></a>  <a href="/pm/out" class="menubtn">Исходящие</a><br><br>


<?php
if(isset($_GET['viewin'])) {
$id = intval($_GET['viewin']);
$q = $db->query("SELECT * FROM tb_pm_in WHERE id = ?i AND user_id_1 = ?i", $id, $usid);
if($db->numRows($q) == 1) {
$db->query("UPDATE tb_pm_in SET status = 1 WHERE id = ?i AND user_id_1 = ?i", $id, $usid);
$db->query("UPDATE tb_pm_out SET status = 1 WHERE id = ?i AND user_id_1 = ?i", $id, $usid);
$qq = $db->fetch($q);



if(isset($_POST['otvet'])) {
$msg = sf($_POST['message']);
if(!empty($msg) ) {
$to_user = $qq['login_2'];
$theme = 'RE:'.$qq['theme'];
$db->query("UPDATE tb_users SET energy = energy - '10' WHERE id = ?i", $usid);
$db->query("INSERT INTO tb_pm_in SET ?u", array('user_id_1' => $qq['user_id_2'], 'user_id_2' => $usid, 'login_1' => $to_user, 'login_2' => $login, 'theme' => $theme, 'text' => $msg, 'date' => time(), 'status' => '0'));
			
			$db->query("INSERT INTO tb_pm_out SET ?u", array('user_id_1' => $usid, 'user_id_2' => $qq['user_id_2'], 'login_1' => $login, 'login_2' => $to_user, 'theme' => $theme, 'text' => $msg, 'date' => time(), 'status' => '0'));
			echo '<font color="green">Ваше сообщение успешно доставлено пользователю</font><br><br>';
			Header("Refresh: 2, /pm");
}else echo '<font color="red">Введите текст сообщения</font><br><br>';

}
?>
Логин отправителя: <b><?=$qq['login_2']; ?></b><br>
Дата: <b><?=date("d.m.Y H:i", $qq['date']); ?></b><br>
Тема: <b><?=$qq['theme']; ?></b><br>
Сообщение:<br><b><font color="#1A8E00"><?=$qq['text']; ?></font></b><br>
<br>
<div class="bloas5ec"></div>
<label>Ответить</label>
<form method="post" action="">
				
				<input style="display: none;" name="to_user" value="<?=$qq['login_2']; ?>" type="text" size="20" maxlength="50" disabled />
				
				<input style="display: none;" name="tema" value="RE:<?=$qq['theme']; ?>" type="text" size="20" maxlength="150" disabled />
				
				<textarea placeholder="Текст сообщения" name="message" rows="5" cols="40"></textarea>
				<br>
				<input class="buttonmail" name="otvet" type="submit" value="Отправить сообщение" />
			</form>
<?php
}else echo '<font color="red">Такого письма не существует или это не ваше письмо</font><br>';
return;
}

?>


<?php
if(isset($_GET['in'])) {
$w = $db->query("SELECT * FROM tb_pm_in WHERE user_id_1 = ?i ORDER BY id DESC", $usid);
if(isset($_POST['dellin'])) {
$qqq = $db->fetch($w);
$dellin = intval($_POST['id']);
if($qqq['user_id_1'] == $usid) {
$db->query("DELETE FROM tb_pm_in WHERE id = ?i AND user_id_1 = ?i", $dellin, $usid);

}

}
if(mysql_num_rows($w) == 0) {
echo 'Уважаемый фермер! У вас нет входящих сообщении!<br><br>';
}else{
?>
<table>
					<tr style="background-color: #fff;">
						<th width="150">Дата</th>
						<th width="100"><font color="#FFFFFF">Получатель</font></th>
						<th width="200"><font color="#FFFFFF">Тема</font></th>
						<th width="200"><font color="#FFFFFF">Статус</font></th>
						<th width="100"><font color="#FFFFFF">Действие</font></th>
						<!--th width="10"><font color="#FFFFFF">Удалить</font></th-->
					</tr>
<?php
while($ww = mysql_fetch_assoc($w)) {

switch($ww['status']) {
case 0: $st = '<img style="vertical-align:middle;" src="/images/mail1.png" title="Письмо не прочитано!">'; break;
case 1: $st = '<img style="vertical-align:middle;" src="/images/mail0.png" title="Письмо прочитано!">'; break;

}
?>

					
					<tr style="background-color: #fff;"><td align='center'><?=date("d.m.Y H:i", $ww['date']); ?></td>
					<td align='center'><?=$ww['login_2'];?></td>
					<td align='center'><?=$ww['theme'];?></td>
					<td align="center"><?=$st;?> </td>
					<td align='center'><a class="buttonmail" style="padding: 4px 10px 4px 10px; width: 63px;" href="/pm/viewin/<?=$ww['id'];?>">Просмотр</a>
					<form action="" method="post">
					<input type="hidden" name="id" value="<?=$ww['id'];?>">
					<input type="submit" style="padding: 4px 10px 4px 10px; width: 85px; margin-top: 4px;" value="Удалить" class="buttonmail" name="dellin">
					</form>
					</td>
					<!--td align='center'>
					<form action="" method="post">
					<input type="hidden" name="id" value="<?=$ww['id'];?>">
					<input type="submit" style="padding: 4px 10px 4px 10px; width: 85px; margin-top: 4px;" value="Удалить" class="buttonmail" name="dellin">
					</form>
					</td-->
					</tr>
	

<?php
}
?>
</table><br>

<?php
}
?>

<img style="vertical-align:middle;" src="/images/mail1.png" title="Письмо не прочитано!"> - Письмо не прочитано!<br>
<img style="vertical-align:middle;" src="/images/mail0.png" title="Письмо прочитано!"> - Письмо прочитано!<br>
					На Странице показывает 10 писем.<br>
<?php
return;
}
?>


<?php
if(isset($_GET['viewout'])) {
$id = intval($_GET['viewout']);
$q = $db->query("SELECT * FROM tb_pm_out WHERE id = ?i AND user_id_1 = ?i", $id, $usid);
if($db->numRows($q) == 1) {
$qq = $db->fetch($q);




?>
Кому: <b><?=$qq['login_2']; ?></b><br>
Дата: <b><?=date("d.m.Y H:i", $qq['date']); ?></b><br>
Тема: <b><?=$qq['theme']; ?></b><br>
Сообщение:<br><b><font color="#1A8E00"><?=$qq['text']; ?></font></b><br>

<?php
}else echo '<font color="red">Такого письма не существует или это не ваше письмо</font><br>';
return;
}

?>


<?php
if(isset($_GET['out'])) {
$w = $db->query("SELECT * FROM tb_pm_out WHERE user_id_1 = ?i ORDER BY id DESC", $usid);
if(isset($_POST['dellout'])) {
$qqq = $db->fetch($w);
$dellin = intval($_POST['id']);
if($qqq['user_id_1'] == $usid) {
$db->query("DELETE FROM tb_pm_out WHERE id = ?i AND user_id_1 = ?i", $dellin, $usid);

}

}
if(mysql_num_rows($w) == 0) {
echo 'Исходящих сообщений нет<br><br>';
}else{
?>

	<table>
					<tr style="background-color: #fff;">
						<th width="150">Дата</th>
						<th width="100"><font color="#FFFFFF">Получатель</font></th>
						<th width="200"><font color="#FFFFFF">Тема</font></th>
						<th width="200"><font color="#FFFFFF">Статус</font></th>
						<th width="100"><font color="#FFFFFF">Действие</font></th>
						<!--th width="10"><font color="#FFFFFF">Удалить</font></th-->
					</tr>
<? 
while($ww = mysql_fetch_assoc($w)) {
switch($ww['status']) {
case 0: $st = '<img style="vertical-align:middle;" src="/images/mail1.png" title="Письмо не прочитано!">'; break;
case 1: $st = '<img style="vertical-align:middle;" src="/images/mail0.png" title="Письмо прочитано!">'; break;

}
?>

				
					<tr style="background-color: #fff;"><td align='center'><?=date("d.m.Y H:i", $ww['date']); ?></td>
					<td align='center'><?=$ww['login_2'];?></td>
					<td align='center'><?=$ww['theme'];?></td>
					<td align="center"><?=$st; ?></td>
					<td align='center'> <a class="buttonmail" style="padding: 4px 10px 4px 10px; width: 63px;" href="/pm/viewout/<?=$ww['id'];?>">Просмотр</a>
					<form action="" method="post">
					<input type="hidden" name="id" value="<?=$ww['id'];?>">
					<input type="submit" style="padding: 4px 10px 4px 10px; width: 85px; margin-top: 4px;" value="Удалить" class="buttonmail" name="dellout">
					</form>
					</td>
					<!--td align='center'>
					<form action="" method="post">
					<input type="hidden" name="id" value="<?=$ww['id'];?>">
					<input type="submit" value="Удалить" class="buttonmail" name="dellout">
					</form>
					</td--></tr>
	

<?php
}
?>
</table><br>
<?php
}
?>

<img style="vertical-align:middle;" src="/images/mail1.png" title="Письмо не прочитано!"> - Письмо не прочитано!<br>
<img style="vertical-align:middle;" src="/images/mail0.png" title="Письмо прочитано!"> - Письмо прочитано!<br>
					На Странице показывает 10 писем.<br>
<?php
return;
}
?>

<?php
if(isset($_POST['message'])) {
$msg = sf($_POST['message']);
$theme = sf($_POST['tema']);
$to_user = sf($_POST['to_user']);

$q = $db->query("SELECT * FROM tb_users WHERE username = ?s", $to_user); 
if($to_user != $login) {
if($theme != '') {
if($msg != '') {
if($db->numRows($q) == 1) {
if($us_data['energy'] >= 10) {
if(strlen($theme) <= 150) {
$qq = $db->fetch($q);
$db->query("UPDATE tb_users SET energy = energy - '10' WHERE id = ?i", $usid);

$db->query("INSERT INTO tb_pm_in SET ?u", array('user_id_1' => $qq['id'], 'user_id_2' => $usid, 'login_1' => $to_user, 'login_2' => $login, 'theme' => $theme, 'text' => $msg, 'date' => time(), 'status' => '0'));
$db->query("INSERT INTO tb_pm_out SET ?u", array('user_id_1' => $usid, 'user_id_2' => $qq['id'], 'login_1' => $login, 'login_2' => $to_user, 'theme' => $theme, 'text' => $msg, 'date' => time(), 'status' => '0'));
			
			echo '<font color="green">Ваше сообщение успешно доставлено пользователю</font><br>';
			echo '<a href="/pm"><<< Вернуься назад</a><br>';
return;
}else echo '<font color="red">Поле тема содержит больше 150 символов</font><br><br>';
}else echo '<font color="red">Не хватает энергии</font><br><br>';
}else echo '<font color="red">Такого пользователя не существует</font><br><br>';
}else echo '<font color="red">Поле СООБЩЕНИЕ пустое</font><br><br>';
}else echo '<font color="red">Поле ТЕМА пустое</font><br><br>';
}else echo '<font color="red">Отправлять сообщения самому себе нельзя</font><br><br>';


}


if(isset($_GET['to'])){
$user = sf($_GET['to']);

}else $user = '';

?>



	<p style="margin-left:13px;">Запрещено:<br>
			- Отправлять сообщения содержащие ненормативную лексику;<br>
			- Оскорблять других пользователей проекта;<br>
			- Отправлять сообщения рекламного характера;<br>
			- Массовая отправка сообщений одного содержания.<br><br>
			Стоимость отправки сообщения - <b>10 ед энергии</b></p><br>			 
			<form method="post" action="">
				<p>
				<input style="width: 45%;" name="to_user" value="<?=$user; ?>" type="text" placeholder="Пользователь" size="20" maxlength="50" /></p>
				<p>
				<input style="width: 45%;" name="tema" value="" placeholder="Тема" type="text" size="20" maxlength="150" /></p>
				<p style="margin-left:13px;">
				<textarea style="background:#fff;" name="message" placeholder="Текст сообщения" rows="5" cols="40"></textarea></p>
				<br>
				<input class="menubtn" type="submit" value="Отправить сообщение" />
			</form>
			 	<div id="formsgifts" style="display: none"></div>