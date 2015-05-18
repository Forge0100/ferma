  <?php
  if(isset($_POST['otvet'])) {
  $id = intval($_POST['vol']);
  $text = sf($_POST['vopros']);
  if(!empty($text)) {
  $q = mysql_query("SELECT * FROM tb_support WHERE id = '$id'");
	if(mysql_num_rows($q) == 1) {
	mysql_query("UPDATE tb_support SET status = 1 WHERE id = '$id'");
	$e = mysql_fetch_assoc($q);
$login = 'Администрация';
	mysql_query("INSERT INTO tb_support_id (id_tik, user_id, login, text, date) VALUES ('$id', '".$e['user_id']."', '$login', '$text', '".time()."')") or die(mysql_error());
	echo '<center><font color="green">Ваше сообщение отправлено!</font></center>';
	Header("Refresh: 1, /adminka/support");
	}else echo '<center><font color="red">Такова тикета не существует, или это не ваш тикет</font></center>';
  
  }else echo '<center><font color="red">Введите текст ответа</font></center>';
  
  
  }
  
  ?>
  
  <?php
  if(isset($_GET['id'])) {
  $id = (int)$_GET['id'];
  $q = mysql_query("SELECT * FROM tb_support WHERE id = '$id'");
  if(mysql_num_rows($q) == 0) {
echo 'Это не ваш тикет или тикета не существует';
  }else{
  $w = mysql_fetch_assoc($q);
  $e = mysql_query("SELECT * FROM tb_support_id WHERE id_tik = '$id'");

  ?>
  
<center><b>Тема: <?=$w['theme']; ?></b></center><br>							<table>
							<tr bgcolor="#0066FF">
								<th width="200"><font color="#FFFFFF">Время и пользователь</font></th>
								<th width="350"><font color="#FFFFFF">Сообщение</font></th>
							</tr>
							<? 
							while(  $r = mysql_fetch_assoc($e)) {
							
							?>
							<tr>
								<td width='200'><?=date("d.m.Y в H:i:s", $r['date']); ?><br><?=$r['login']; ?></td>
								<td width='500'><?=$r['text']; ?></td>
								</tr>
						<? } ?>
								
								
								</table><br>							 	<form method="post" action="">
								  <p>
									<label>Добавить ответ</label><br>
									<textarea name="vopros" rows="5" cols="40"></textarea>
									<br>
									<input type="hidden" name="vol" value="<?=$w['id']; ?>">
									<input class="buttonmail" type="submit" name="otvet" value="Отправить" />

								  </p>
								</form>

  
  
  
  <?php
  }
  return;
  }
  ?>




<table>
			<tr bgcolor="#f2f2f2">
				<th width="100">№ тикета</font></th>
				<th width="350">Название</font></th>
				<th width="200">Время создания</font></th>
				<th width="150">Статус</font></th>
			</tr>
<?php
$q = mysql_query("SELECT * FROM tb_support ORDER BY id DESC");
while($w = mysql_fetch_assoc($q)) {
switch($w['status']) {
case 0: $st = 'Открыт'; break;
case 1: $st = 'Отвечен'; break;
case 5: $st = 'Прочитано'; break;
case 4: $st = 'Закрыт'; break;
}
?>
			<tr><td align='center'>#<?=$w['id']; ?></td>
			<td><a href="/adminka/support/id/<?=$w['id']; ?>"><?=$w['theme']; ?></a></td>
			<td align='center'><?=date("d.m.Y в H:i:s", $w['date']); ?></td>
			<td align='center'><?=$st; ?></td></tr>
			
<? } ?>
			</table><br>	