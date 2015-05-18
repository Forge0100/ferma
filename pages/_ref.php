<center> <div class="tegname"><h2>Друг-реферер</h2></div><br> </center>
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
$page = 'Мои рефералы';
error_reporting(1);
$r = $db->getRow("SELECT * FROM tb_users WHERE id = ?i", $us_data['ref_id']);

if($r['ava'] != '') $ava = $r['ava'];
else $ava = 'images/noavatar.png';

$qq = $db->query("SELECT * FROM tb_users WHERE ref_id = ?i", $_SESSION['id']);
?>
<h3>Ваш друг-реферер</h3>
<?php
if($db->numRows($rr) == 1){
?>
<br>
	<a href="/wall/user/<?=$r['id'];?>"><img width="150" height="150" src="/<?=$ava;?>" title="Перейти на стену <?=$r['username'];?> " style="float: left; margin-right: 10px;"></a>			
			<b>Логин:</b> <?=$r['username']; ?><br>
			<b>Уровень:</b> <?=$r['level']; ?><br>
			<b>Email:</b> <?=$r['email']; ?><br>
			<a href="/pm/to/<?=$r['username']; ?>" title="Написать рефереру по внутреней почте!"><img src="../images/mail0.png" alt="">Отправить сообщение</a><br>
			<br><br><br><br><br><br>
			<?php }else{?>
			<br>
			У вас нет друга-реферера!
			<?php } ?>
			<br>
			<br>
			<hr style="border: 1px #0e82a7 solid;">
			<h3>У вас друзей: <?=mysql_num_rows($qq);?></h3>
<br>
<?php
$re = $db->query("SELECT * FROM tb_users WHERE ref_id = ?i", $_SESSION['id']);
if($db->numRows($re) == 0) {
echo 'У вас нет друзей!';

}else{
while($ref = $db->fetch($re)) {
if($ref['ava'] != '') $ava = $ref['ava'];
else $ava = 'images/noavatar.png';
?>
<a href="/wall/user/<?=$ref['id'];?>"><img width="150" height="150" src="/<?=$ava;?>" title="Перейти на стену <?=$ref['username']; ?> " style="float: left; margin-right: 10px;"></a>
		<b>Логин:</b> <?=$ref['username']; ?><br>
		<b>Уровень:</b> <?=$ref['level']; ?><br>
		<b>Email:</b> <?=$ref['email']; ?><br>
		<b>Последний вход:</b> <?=date("d.m.Y H:i", $ref['date_login']); ?><br>
		<b>Примерный доход:</b> <?=$ref['ref_money']; ?> руб<br>
		
		<a href="/pm/to/<?=$ref['username']; ?>" title="Написать соседу по внутреней почте!"><img src="../images/mail0.png" alt="">Отправить сообщение</a><br>
		<br><br>

		<br><br><br><br><hr style="border: 1px #0e82a7 solid;"><br>
		<?php }
}		?>
		<br><br>