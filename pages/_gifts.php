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
?>
 <link rel="stylesheet" type="text/css" media="screen,projection,print" href="/css/wall.css?q=1.2">
 <a href="/gifts/add/0">Сделать подарок</a> | <a href="/gifts/my">Мои подарки</a> | <a href="/wall/">Моя стена</a><br><br>Отправка подарка снимает 100 ед Энергии. Цена подарка указана под ним.<br> Подарок будет висеть на стене пользователя в течение 7 дней, после того как он его примет.<br>
			
<?php
if($_GET['add'] != 0) {
$add = intval($_GET['add']);
$q = $db->query("SELECT * FROM tb_users WHERE id = ?i", $add);
if($db->numRows($q) == 1) {
$a = $db->fetch($q);
$lgg = $a['username'];
}else{
$lgg = '';
}
}else $lgg = '';

?>


<?php
if(isset($_POST['give'])) {
$touser = sf($_POST['touser']);
$giftid = intval($_POST['giftid']);
$msg = sf($_POST['message']);

$q = $db->query("SELECT * FROM tb_gifts WHERE id = ?i", $giftid);
if($db->numRows($q) == 1) {
$qq = $db->fetch($q);
if($us_data['money'] >= $qq['price']) {
if($us_data['energy'] >= 100) {
if($touser != $login) {
$w = $db->query("SELECT * FROM tb_users WHERE username = ?s", $touser);
if($db->numRows($w) == 1) {
$ww = $db->fetch($w);

$db->query("INSERT INTO tb_gifts_wait SET ?u", array('user_id_1' => $ww['id'], 'user_id_2' => $usid, 'login2' => $login, 'date' => time(), 'id_gift' => $giftid, 'status' => '0', 'msg' => $msg));
$db->query("UPDATE tb_users SET money = money - ?i, energy = energy - 100 WHERE id = ?i", $qq['price'], $usid);
echo '<center><font color="green">Ваш подарок отправлен</font></center>';


}else echo '<center><font color="red">Такого пользователя не существует!</font></center>';
}else echo '<center><font color="red">Нельзя отправлять подарки самому себе</font></center>';
}else echo '<center><font color="red">Не хватает энергии</font></center>';
}else echo '<center><font color="red">Недостаточно средств на счету</font></center>';
}else echo '<center><font color="red">Такого подарка не существует</font></center>';


}


if(isset($_POST['save'])) {
$id = intval($_POST['giftid']);
$w = $db->query("SELECT * FROM tb_gifts_wait WHERE id = ?i", $id);
if($db->numRows($w) == 1) {
$ww = $db->fetch($w);
if($ww['status'] == 0) {
$r = $db->getRow("SELECT * FROM tb_gifts WHERE id = ?i", $ww['id_gift']);
if($us_data['gifts'] != '') {
$ful_gift = $us_data['gifts'].','.$r['img'];
}else{
$ful_gift = $us_data['gifts'].''.$r['img'];
}
$db->query("UPDATE tb_users SET gifts = ?s WHERE id = ?i", $ful_gift, $usid);
$db->query("UPDATE tb_gifts_wait SET status = 1 WHERE id = ?i", $id);
echo '<center><font color="green">Подарок принят</font></center>';
}else echo '<center><font color="red">Данный подарок уже принят</font></center>';
}else echo '<center><font color="red">Такого подарка не существует</font></center>';
}

if(isset($_POST['saveno'])) {
$id = intval($_POST['giftid']);
$db->query("DELETE FROM tb_gifts_wait WHERE id = ?i AND user_id_1 = ?i", $id, $usid);

}
?>


<?php
if(isset($_GET['my'])) {
?>
<h3>Ожидают подтверждения</h3>
<?php
$q = $db->query("SELECT * FROM tb_gifts_wait WHERE user_id_1 = ?i AND status = 0", $usid);
if($db->numRows($q) == 0) {
?>
Вы еще не получили подарки!
<? } else { 

while($qq = $db->fetch($q)) {
$r = $db->getRow("SELECT * FROM tb_gifts WHERE id = ?i", $qq['id_gift']);
$img = $r['img'];
?>

<div class="gift_display_pay">
											<label><img src="/gifts/<?=$img;?>"><br>
											<?=$qq['msg'];?>
											<br>
											<form method="post" action="">
											<input type="hidden" name="giftid" value="<?=$qq['id'];?>"> 
											<input type="submit" name="save" value="Принять">
											</form>
											<form method="post" action="">
											<input type="hidden" name="giftid" value="<?=$qq['id'];?>"> 
											<input type="submit" name="saveno" value="Отклонить">
											</form>
											</label>
										</div>

<? } ?>
<? } ?>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<h3>Мои полученные подарки</h3>
<?php



$ff = explode(",", $us_data['gifts']);															  
$c = count($ff);
if($c == 1) {
echo 'Вы еще не получили подарки!<br>';
}else{
for($i = 0; $i <= ($c-1); $i++) {
?>
	<img title="<?=$ee['username'];?>" src="/gifts/<?=$ff[$i];?>">
<?												 
 }
 }
 
?>

<br>
<br>
<br>
<br>
<br>
<br>
<br>

<h3>Мои отправленные подарки</h3>
<?php
$qe = $db->query("SELECT * FROM tb_gifts_wait WHERE user_id_2 = ?i", $usid);
if($db->numRows($qe) == 0) {
echo 'Вы еще не отправили подарки!<br>';
}else {
while($eq = $db->fetch($qe)) {
$r = $db->getRow("SELECT * FROM tb_gifts WHERE id = ?i", $eq['id_gift']);
$img = $r['img'];
switch($eq['status']) {
case 0: $st = '<font color="red">Не принят</font>'; break;
case 1: $st = '<font color="green">Принят</font>'; break;

}
?>

<div class="gift_display_pay">
											<label><img src="/gifts/<?=$img;?>"><br>
											Статус: <?=$st;?>
											
											</label>
										</div>

<?php
}

}
?>



<?php
return;
}

?>
			
							<form action="" method="post">
							<label>Кому:</label>
							<input type="text" name="touser" value="<?=$lgg;?>">
							<label>Выберите подарок:</label>
							<?php
							$g = $db->query("SELECT * FROM tb_gifts ORDER BY id DESC");
							while($f = $db->fetch($g)) {
							?>
							<div class="gift_display_pay">
											<label><img src="/gifts/<?=$f['img'];?>"><br>
											<input type="radio" name="giftid" value="<?=$f['id'];?>"> <?=$f['price'];?> руб</label>
										</div>
							<? } ?>			
										
										
										
										
										<div class="clear"></div>
								
								<label>Можете написать пару слов (до 50 символов)</label>
								<input type="text" maxlength="50" name="message" value="">
								<label></label>								
								<input type="submit" name="give" class="buttonmail" value="Подарить">
								</form>	
 
 
 
 
 
 
 
 
 
 
 
 
 <div id="formsgifts" style="display: none"></div>