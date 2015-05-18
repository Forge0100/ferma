<center>  <div class="tegname"><h2>Тех. Поддержка</h2></div><br>  </center>
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
<?php
$login = $_SESSION['login'];
$usid = $_SESSION['id'];
?>

<style>
.buttonssilka {
color: #502e24;
text-decoration: underline;	
cursor: pointer;
font-size: 12px;
}

.buttonssilka:hover {
color: #8e4733;
text-decoration: none;
cursor: pointer;
font-size: 12px;
}
</style>

  <?php
			$qqq = $db->numRows($db->query("SELECT * FROM tb_support WHERE user_id = ?i", $usid));
			
			?>
			
	  <?php
			$qqqotv = $db->numRows($db->query("SELECT * FROM tb_support WHERE user_id = ?i AND status = 1", $usid));
			
			?>		
 <a href="/support/add">Создать тикет</a> | <a href="/support/view">Ваши тикеты (<span title="Всего тикетов"><?=$qqq; ?></span>/<span title="Ответов"><?=$qqqotv; ?></span>)</a><br><br>		
  
  
  <?php
  if(isset($_POST['add'])){
  $tema = sf($_POST['tema']);
  $text = sf($_POST['vopros']);
  if(!empty($tema)) {
  if(!empty($text)) {
  $db->query("INSERT INTO tb_support SET ?u", array('user_id' => $usid, 'login' => $login, 'theme' => $tema, 'date' => time(), 'status' => '0'));
  $lid = mysql_insert_id();
  $db->query("INSERT INTO tb_support_id SET ?u", array('id_tik' => $lid, 'user_id' => $usid, 'login' => $login, 'text' => $text, 'date' => time()));
  echo '<center><font color="green">Ваше сообщение успешно отправлено</font></center></br>';
  Header("Refresh: 2, /support/view");
  }else echo 'Введите текст обращения</br>';
  }else echo 'Введите тему обращения</br>';
  }
  if(isset($_GET['add'])) {
  
  ?>
  
<form method="post" action="">
<p>
<input style="width:45%; margin-left:0px;" name="tema" placeholder="Тема" value="" type="text" size="50" maxlength="150" /></p>
<p>
<textarea name="vopros" placeholder="Текст сообщения" rows="5" cols="40"></textarea></p>
<br>
<input class="menubtn" type="submit" name="add" value="Создать тикет" />
</form>
  
  
  <?php
  return;
  }
  ?>
  
  
  <?php
  if(isset($_GET['view'])) {
?>

                            		<table>
			<tr style="background-color: #fff;">
				<th width="100"><font color="#FFFFFF">№ тикета</font></th>
				<th width="350"><font color="#FFFFFF">Название</font></th>
				<th width="200"><font color="#FFFFFF">Время создания</font></th>
				<th width="150"><font color="#FFFFFF">Статус</font></th>
			</tr>
<?php
$q = $db->query("SELECT * FROM tb_support WHERE user_id = ?i ORDER BY id DESC", $usid);

while($w = $db->fetch($q)) {
$qsdaf = $w['status'];
$ideluk = $w['id'];
$themeeluk = $w['theme'];
switch($w['status']) {
case 0: $st = 'Ожидает ответа'; break;
case 1: $st = '<b><font color="green">Есть сообщения</font></b>'; break;
case 4: $st = 'Закрыт'; break;
case 5: $st = 'Прочитано'; break;
}
?>


			   <?php
  if(isset($_POST['opent'])) {
  $id = intval($_POST['opentid']);

 
  $q = $db->query("SELECT * FROM tb_support WHERE id = ?i AND user_id = ?i", $id, $usid);
	if($db->numRows($q) == 1) {
	
	 $db->query("UPDATE tb_support SET status = 5 WHERE id = ?i", $id);
	Header("Refresh: 2, /support/id/$id");
	
	}else echo '<center><font color="red">azazazazazaz</font></center></br>';
  
 
  
  
  }
  
  ?>

			<tr style="background-color: #fff;"><td align='center'>#<?=$w['id']; ?></td>
			<!--td><a href="/support/id/<-?=$w['id']; ?>"><-?=$w['theme']; ?></a></td-->
			
		<td align='center'>

			<?php
		if($qsdaf == '1') {
		echo "<form method='post' action=''>
								 
									<input type='hidden' name='opentid' value='$ideluk'>
									<input class='buttonssilka' type='submit' title='Открыть' name='opent' value='$themeeluk' />

			</form>"; 
		}else{
		echo "<a title='Открыть' href='/support/id/$ideluk'>$themeeluk</a>";
		}
       ?>
		
			</td>
			<td align='center'><?=date("d.m.Y в H:i:s", $w['date']); ?></td>
			<td align='center'><?=$st; ?></td></tr>
			
<?php } ?>
			</table><br>	


<?php  
  return;
  }
  
  ?>
  
  <?php
  if(isset($_POST['otvet'])) {
  $id = intval($_POST['vol']);
  $text = sf($_POST['vopros']);
  if(!empty($text)) {
  $q = $db->query("SELECT * FROM tb_support WHERE id = ?i AND user_id = ?i", $id, $usid);
	if($db->numRows($q) == 1) {
	 $db->query("UPDATE tb_support SET status = 0 WHERE id = ?i", $id);
	$db->query("INSERT INTO tb_support_id SET ?u", array('id_tik' => $id, 'user_id' => $usid, 'login' => $login, 'text' => $text, 'date' => time()));
	echo '<center><font color="green">Ваше сообщение отправлено!</font></center></br>';
	Header("Refresh: 1, /support/view");
	}else echo '<center><font color="red">Такова тикета не существует, или это не ваш тикет</font></center></br>';
  
  }else echo '<center><font color="red">Введите текст ответа</font></center></br>';
  
  
  }
  
  ?>
  
  
   <?php
  if(isset($_POST['close'])) {
  $id = intval($_POST['volx']);

 
  $q = $db->query("SELECT * FROM tb_support WHERE id = ?i AND user_id = ?i", $id, $usid);
	if($db->numRows($q) == 1) {
	 $db->query("UPDATE tb_support SET status = 4 WHERE id = ?i", $id);
	echo '<center><font color="green">Тикет Закрыт!</font></center></br>';
	Header("Refresh: 1, /support/view");
	}else echo '<center><font color="red">Такова тикета не существует, или это не ваш тикет</font></center></br>';
  
 
  
  
  }
  
  ?>
  
  
  <?php
  if(isset($_GET['id'])) {
  $id = (int)$_GET['id'];
  $q = $db->query("SELECT * FROM tb_support WHERE id = ?i AND user_id = ?i", $id, $usid);
  if($db->numRows($q) == 0) {
echo 'Это не ваш тикет или тикета не существует</br>';
  }else{
  //mysql_query("UPDATE tb_support SET status = 5 WHERE id = '$id'");
  $w = $db->fetch($q);
  $e = $db->query("SELECT * FROM tb_support_id WHERE id_tik = ?i", $id);

  ?>
  
<center><b>Тема: <?=$w['theme']; ?></b></center><br>							<table>
							<tr style="background-color: #fff;">
								<th width="200"><font color="#FFFFFF">Время и пользователь</font></th>
								<th width="350"><font color="#FFFFFF">Сообщение</font></th>
							</tr>
							<?php 
							while(  $r = mysql_fetch_assoc($e)) {
							
							?>
							<tr style="background-color: #fff;">
								<td width='200'><?=date("d.m.Y в H:i:s", $r['date']); ?><br><?=$r['login']; ?></td>
								<td width='500'><?=$r['text']; ?></td>
								</tr>
						<?php } ?>
								
								
								</table><br>							 	
								

							
	<?php
		if($w['status'] != '4') {
		echo "<form method='post' action=''>
								  <p>
									<label>Добавить ответ</label>
									<textarea name='vopros' rows='5' cols='40'></textarea>
									<br>
									<input type='hidden' name='vol' value='$id'>
									<input class='buttonmail' type='submit' name='otvet' value='Отправить' />

								  </p>
								</form>
								
								
								<form method='post' action='' style='margin-top: -8px;'>
								  
									<input type='hidden' name='volx' value='$id'>
									<input class='buttonmail' type='submit' name='close' value='Закрыть тикет' />

								 
								</form>"; 
		}else{
		echo "Тикет Закрыт!";
		}
       ?>

  
  <?php
  }
  return;
  }
  ?>
 <p> Уважаемые пользователи проекта <?=$_SERVER['HTTP_HOST']; ?>!<br>
		Для решения возникающих у Вас проблем и вопросов, касающихся проекта <?=$_SERVER['HTTP_HOST']; ?>, воспользуйтесь системой тикетов нашего сайта.<br>
		Внимание! Прежде чем задать вопрос администрации <?=$_SERVER['HTTP_HOST']; ?>, пожалуйста, убедитесь в том, что на общедоступных страницах сайта нет на него ответа. Если Ваш вопрос некорректный или ответ на него имеется на страницах проекта, Ваш тикет будет закрыт без предупреждения! Берегите своё время и время администрации сайта.<br>
		   Помните! Чем точнее и полнее Вы изложите суть своей проблемы или вопроса, тем быстрее и точнее Вы получите ответ!<br>
		   С уважением, Администрация <?=$_SERVER['HTTP_HOST']; ?>.<br></p>