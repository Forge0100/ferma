<center> <div class="tegname"><h2>История</h2></div><br> </center>
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
$page = 'История аккаунта';

function getPagesHistory($usid, $table, $type)
{
	$num = 50;  
	$pages = ($_GET['str'] > 0) ? intval($_GET['str']) : 1;  
	$where_type = (!empty($type)) ? " and type = '$type'" : "";
	global $db;
	if($table == 'tb_history') $posts = $db->numRows($db->query("SELECT id FROM tb_history WHERE user_id = ?i ?p ORDER BY id DESC", $usid, $where_type));  
	if($table == 'tb_enter') $posts = $db->numRows($db->query("SELECT id FROM tb_enter WHERE status = 2 AND user_id = ?i", $usid));
	if($table == 'tb_vivod') $posts = $db->numRows($db->query("SELECT id FROM tb_vivod WHERE user_id = ?i", $usid));
	
	$total = intval(($posts - 1) / $num) + 1;  
	$pages = ($pages > $total) ? $total : intval($pages);    
	$start = $pages * $num - $num;  
	
	$arr = array();
	$arr['pages'] = $pages;
	$arr['total'] = $total;
	$arr['start'] = $start;
	$arr['num'] = $num;
	$arr['href'] = (!empty($type)) ? "/type/" . $type : "";
	return $arr;
}
?>
<p>
	<a href="/history/type/vhod">Входа в аккаунт</a><br />
	<a href="/history/type/popoln">Пополнения баланса</a><br />
	<a href="/history/type/perevod">Перевода средств</a><br />
	<a href="/history/type/convert">Обмена средств</a><br />
	<a href="/history/type/vivod">Вывода средств</a><br />	
	<!--<a href="?action=prodaja">Продажи животных</a><br />-->
	<a href="/history/type/ref">Начислений</a><br />
	<a href="/history/type/domik">Покупки загонов</a><br />
	<a href="/history/type/pocupka">Покупки животных и корма</a><br />
	<!--<a href="/history/type/kupon">Купонов</a><br />-->
	<a href="/history/type/blincik">Пирогов</a><br />
	<!--<a href="/history/type/pole">Полей</a><br />
	<a href="/history/type/productia">Продукции</a><br />
	<a href="/history/type/fabrika">Фабрики по переработке</a><br />
	<a href="/history/type/fabrika_blincik">Фабрики пирогов</a><br />-->
	<!--<a href="/history/type/action">Акций</a><br />-->
	<a href="/history/type/bonus">Бонусов</a><br />
	<!--<a href="/history/type/birjaopit">Биржи опыта</a><br />-->
	
	<br />	Ваша история:
	<br>
	<br>
	<?php
	if(!isset($_GET['type'])) {
		$pagination = getPagesHistory($usid, 'tb_history');
		$q = $db->query("SELECT * FROM tb_history WHERE user_id = ?i ORDER BY id DESC LIMIT ?i, ?i", $usid, $pagination['start'], $pagination['num']);
	?>
	<table>
	<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);">
		<th width="50" align='center' style="background: #5A8CFA;"><font color="#FFFFFF">№</font></th>
		<th width="100" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Сумма (руб)</font></th>
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Дата</font></th>
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Комментарии</font></th>
	</tr>
	<?php
	$i = $pagination['start'] + 1;
	while($w = $db->fetch($q)) {
	?>
	
	<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);"><td align='center'style=" border: 1px solid rgba(90, 140, 250, 0.56);"><?=$i; ?></td>
	<td align='center'style=" border: 1px solid rgba(90, 140, 250, 0.56);"><?=$w['summa']; ?> руб</td>
	<td align='center'style=" border: 1px solid rgba(90, 140, 250, 0.56);"><?=date("d.m.Y в H:i", $w['date']); ?></td>
	<td align='center'style=" border: 1px solid rgba(90, 140, 250, 0.56);"><?=$w['comment']; ?></td>
	</tr>
	<? 
	$i++;
	} ?>
	</table>
	
	<?} else{?>
	
	<?php
	if(isset($_GET['type'])) {
	$type = sf($_GET['type']);
	if($type == 'vhod') {
	?>
	
		<table>
	<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);">
		<th width="50" align='center' style="background: #5A8CFA;"><font color="#FFFFFF">№</font></th>
		<th width="100" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">IP</font></th>
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Дата</font></th>
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Браузер</font></th>
	</tr>
	<?php
	$pagination = getPagesHistory($usid, 'tb_history', 'vhod');
	$q = $db->query("SELECT * FROM tb_history WHERE type = 'vhod' AND user_id = ?i LIMIT ?i, ?i", $usid, $pagination['start'], $pagination['num']);
	$i = $pagination['start'] + 1;
	while($w = $db->fetch($q)) {
	?>
	
	<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);"><td align='center' style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=$i; ?></td>
	<td align='center' style="  border: 1px solid rgba(90, 140, 250, 0.56);"><?=$w['ip']; ?></td>
	<td align='center' style="  border: 1px solid rgba(90, 140, 250, 0.56);"><?=date("d.m.Y в H:i", $w['date']); ?></td>
	<td align='center' style="  border: 1px solid rgba(90, 140, 250, 0.56);"><?=$w['comment']; ?></td>
	</tr>
	<? 
	$i++;
	} ?>
	</table>
	
	<? } elseif($type == 'popoln') {
	?>
	
		<table>
	<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);">
		<th width="50" align='center'  style="background: #5A8CFA;"><font color="#FFFFFF">№</font></th>
		
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Дата</font></th>
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Система</font></th>
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Сумма</font></th>
	</tr>
	<?php
	$pagination = getPagesHistory($usid, 'tb_enter');
	$q = $db->query("SELECT * FROM tb_pay_stats WHERE user_id = ?i LIMIT ?i, ?i", $usid, $pagination['start'], $pagination['num']);
	$i = 1;
	while($w = $db->fetch($q)) {
	?>
	
	<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);"><td align='center' style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=$i; ?></td>

	<td align='center' style="  border: 1px solid rgba(90, 140, 250, 0.56);"><?=date("d.m.Y в H:i", $w['date']); ?></td>
	<td align='center' style="  border: 1px solid rgba(90, 140, 250, 0.56);"><?=$w['purse']; ?></td>
	<td align='center' style="  border: 1px solid rgba(90, 140, 250, 0.56);"><?=$w['amount']; ?></td>
	</tr>
	<? 
	$i++;
	} ?>
	</table>
	
	<? } elseif($type == 'perevod') {
	?>
	
		<table>
	<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);">
		<th width="50" align='center'  style="background: #5A8CFA;"><font color="#FFFFFF">№</font></th>
		
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Сумма</font></th>
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Дата</font></th>
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Комментарий</font></th>
	</tr>
	<?php
	$pagination = getPagesHistory($usid, 'tb_history', 'perevod');
	$q = $db->query("SELECT * FROM tb_history WHERE type = 'perevod' AND user_id = ?i LIMIT ?i, ?i", $usid, $pagination['start'], $pagination['num']);
	$i = $pagination['start'] + 1;
	while($w = $db->fetch($q)) {
	?>
	
	<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);"><td align='center' style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=$i; ?></td>
<td align='center' style="background: #5A8CFA;"><?=$w['summa']; ?></td>
	<td align='center' style="background: #5A8CFA;"><?=date("d.m.Y в H:i", $w['date']); ?></td>
	
	<td align='center' style="background: #5A8CFA;"><?=$w['comment']; ?></td>
	</tr>
	<? 
	$i++;
	} ?>
	</table>
	
	<? }  elseif($type == 'convert') {
	?>
	
		<table>
	<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);">
		<th width="50" align='center' style="  border: 1px solid rgba(90, 140, 250, 0.56);"><font color="#FFFFFF">№</font></th>
		
		<th width="150" align="center" style="  border: 1px solid rgba(90, 140, 250, 0.56);"><font color="#FFFFFF">Сумма</font></th>
		<th width="150" align="center" style="  border: 1px solid rgba(90, 140, 250, 0.56);"><font color="#FFFFFF">Дата</font></th>
		<th width="150" align="center" style="  border: 1px solid rgba(90, 140, 250, 0.56);"><font color="#FFFFFF">Комментарий</font></th>
	</tr>
	<?php
	$pagination = getPagesHistory($usid, 'tb_history', 'convert');
	$q = $db->query("SELECT * FROM tb_history WHERE type = 'convert' AND user_id = ?i LIMIT ?i, ?i", $usid, $pagination['start'], $pagination['num']);
	$i = $pagination['start'] + 1;
	while($w = $db->fetch($q)) {
	?>
	
	<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);"><td align='center' style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=$i; ?></td>
<td align='center' style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=$w['summa']; ?></td>
	<td align='center' style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=date("d.m.Y в H:i", $w['date']); ?></td>
	
	<td align='center' style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=$w['comment']; ?></td>
	</tr>
	<? 
	$i++;
	} ?>
	</table>
	
	<? }  elseif($type == 'vivod') {
	?>
	
		<table>
	<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);">
		<th width="50" align='center' style="background: #5A8CFA;"><font color="#FFFFFF">№</font></th>
		
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Сумма</font></th>
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Дата</font></th>
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Комментарий</font></th>
	</tr>
	<?php
	$pagination = getPagesHistory($usid, 'tb_vivod');
	$q = $db->query("SELECT * FROM tb_vivod WHERE user_id = ?i LIMIT ?i, ?i", $usid, $pagination['start'], $pagination['num']);
	$i = $pagination['start'] + 1;
	while($w = $db->fetch($q)) {
	switch($w['status']){
	case 0: $st = 'В очереди на выплату'; break;
	case 1: $st = 'Выплачено'; break;
	case 2: $st = 'Отменено'; break;
	}
	?>
	
	<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);"><td align='center' style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=$i; ?></td>
<td align='center'style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=$w['summa']; ?></td>
	<td align='center'style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=date("d.m.Y в H:i", $w['date']); ?></td>
	
	<td align='center'style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=$st; ?></td>
	</tr>
	<? 
	$i++;
	} ?>
	</table>
	
	<? } elseif($type == 'ref') {
	?>
	
		<table>
	<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);">
		<th width="50" align='center' style="background: #5A8CFA;"><font color="#FFFFFF">№</font></th>
		
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Сумма</font></th>
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Дата</font></th>
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Комментарий</font></th>
	</tr>
	<?php
	$pagination = getPagesHistory($usid, 'tb_history', 'ref');
	$q = $db->query("SELECT * FROM tb_history WHERE type = 'ref' ");
	//$q = $db->query("SELECT * FROM tb_history WHERE type = 'ref' AND user_id = ?i LIMIT ?i, ?i", $usid, $pagination['start'], $pagination['num']);
	//$q = $db->query("SELECT * FROM tb_history WHERE type = 'ref'";
	$i = $pagination['start'] + 1;
	while($w = $db->fetch($q)) {

	?>
	
	<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);"><td align='center' style="background: #5A8CFA;"><?=$i; ?></td>
	<td align='center' style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=$w['summa']; ?></td>
	<td align='center' style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=date("d.m.Y в H:i", $w['date']); ?></td>
	
	<td align='center' style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=$w['comment']; ?></td>
	</tr>
	<? 
	$i++;
	} ?>
	</table>
	
	<? } elseif($type == 'domik') {
	?>
	
		<table>
	<tr style="border: 1px solid rgba(90, 140, 250, 0.56);">
		<th width="50" align='center' style="background: #5A8CFA;"><font color="#FFFFFF">№</font></th>
		
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Сумма</font></th>
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Дата</font></th>
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Комментарий</font></th>
	</tr>
	<?php
	$pagination = getPagesHistory($usid, 'tb_history', 'domik');
	$q = $db->query("SELECT * FROM tb_history WHERE type = 'domik' AND user_id = ?i ORDER BY id DESC LIMIT ?i, ?i", $usid, $pagination['start'], $pagination['num']);
	$i = $pagination['start'] + 1;
	while($w = $db->fetch($q)) {

	?>
	
	<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);"><td align='center' style="background: #5A8CFA;"><?=$i; ?></td>
	<td align='center' style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=$w['summa']; ?></td>
	<td align='center' style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=date("d.m.Y в H:i", $w['date']); ?></td>
	
	<td align='center' style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=$w['comment']; ?></td>
	</tr>
	<? 
	$i++;
	} ?>
	</table>
	
	<? } elseif($type == 'pocupka') {
	?>
	
		<table>
	<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);">
		<th width="50" align='center'><font color="#FFFFFF">№</font></th>
		
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Сумма</font></th>
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Дата</font></th>
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Комментарий</font></th>
	</tr>
	<?php
	$pagination = getPagesHistory($usid, 'tb_history', 'pocupka');
	$q = $db->query("SELECT * FROM tb_history WHERE type = 'pocupka' AND user_id = ?i ORDER BY id DESC LIMIT ?i, ?i", $usid, $pagination['start'], $pagination['num']);
	$i = $pagination['start'] + 1;
	while($w = $db->fetch($q)) {

	?>
	
	<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);"><td align='center' style="background: #5A8CFA;"><?=$i; ?></td>
<td align='center'><?=$w['summa']; ?></td>
	<td align='center'><?=date("d.m.Y в H:i", $w['date']); ?></td>
	
	<td align='center'><?=$w['comment']; ?></td>
	</tr>
	<? 
	$i++;
	} ?>
	</table>
	
	<? } elseif($type == 'blincik') {
	?>
	
		<table>
	<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);">
		<th width="50" align='center'><font color="#FFFFFF">№</font></th>
		
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Сумма</font></th>
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Дата</font></th>
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Комментарий</font></th>
	</tr>
	<?php
	$pagination = getPagesHistory($usid, 'tb_history', 'blincik');
	$q = $db->query("SELECT * FROM tb_history WHERE type = 'blincik' AND user_id = ?i ORDER BY id DESC LIMIT ?i, ?i", $usid, $pagination['start'], $pagination['num']);
	$i = $pagination['start'] + 1;
	while($w = $db->fetch($q)) {

	?>
	
	<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);"><td align='center' style="background: #5A8CFA;"><?=$i; ?></td>
<td align='center'><?=$w['summa']; ?></td>
	<td align='center'><?=date("d.m.Y в H:i", $w['date']); ?></td>
	
	<td align='center'><?=$w['comment']; ?></td>
	</tr>
	<? 
	$i++;
	} ?>
	</table>
	
	<? }/*elseif($type == 'pole') {
	?>
	
		<table>
	<tr style="background-color: #fff;">
		<th width="50" align='center'><font color="#FFFFFF">№</font></th>
		
		<th width="150" align="center"><font color="#FFFFFF">Сумма</font></th>
		<th width="150" align="center"><font color="#FFFFFF">Дата</font></th>
		<th width="150" align="center"><font color="#FFFFFF">Комментарий</font></th>
	</tr>
	<?php
	$q = mysql_query("SELECT * FROM tb_history WHERE type = 'pole' AND user_id = '$usid' ORDER BY id DESC");
	$i = 1;
	while($w = mysql_fetch_assoc($q)) {

	?>
	
	<tr style="background-color: #fff;"><td align='center'><?=$i; ?></td>
<td align='center'><?=$w['summa']; ?></td>
	<td align='center'><?=date("d.m.Y в H:i", $w['date']); ?></td>
	
	<td align='center'><?=$w['comment']; ?></td>
	</tr>
	<? 
	$i++;
	} ?>
	</table>
	
	<? } elseif($type == 'productia') {
	?>
	
		<table>
	<tr style="background-color: #fff;">
		<th width="50" align='center'><font color="#FFFFFF">№</font></th>
		
		<th width="150" align="center"><font color="#FFFFFF">Сумма</font></th>
		<th width="150" align="center"><font color="#FFFFFF">Дата</font></th>
		<th width="150" align="center"><font color="#FFFFFF">Комментарий</font></th>
	</tr>
	<?php
	$q = mysql_query("SELECT * FROM tb_history WHERE type = 'productia' AND user_id = '$usid' ORDER BY id DESC");
	$i = 1;
	while($w = mysql_fetch_assoc($q)) {

	?>
	
	<tr style="background-color: #fff;"><td align='center'><?=$i; ?></td>
<td align='center'><?=$w['summa']; ?></td>
	<td align='center'><?=date("d.m.Y в H:i", $w['date']); ?></td>
	
	<td align='center'><?=$w['comment']; ?></td>
	</tr>
	<? 
	$i++;
	} ?>
	</table>
	
	<? } elseif($type == 'fabrika') {
	?>
	
		<table>
	<tr style="background-color: #fff;">
		<th width="50" align='center'><font color="#FFFFFF">№</font></th>
		
		<th width="150" align="center"><font color="#FFFFFF">Сумма</font></th>
		<th width="150" align="center"><font color="#FFFFFF">Дата</font></th>
		<th width="150" align="center"><font color="#FFFFFF">Комментарий</font></th>
	</tr>
	<?php
	$q = mysql_query("SELECT * FROM tb_history WHERE type = 'fabrika' AND user_id = '$usid' ORDER BY id DESC");
	$i = 1;
	while($w = mysql_fetch_assoc($q)) {

	?>
	
	<tr style="background-color: #fff;"><td align='center'><?=$i; ?></td>
<td align='center'><?=$w['summa']; ?></td>
	<td align='center'><?=date("d.m.Y в H:i", $w['date']); ?></td>
	
	<td align='center'><?=$w['comment']; ?></td>
	</tr>
	<? 
	$i++;
	} ?>
	</table>
	
	<? }  elseif($type == 'fabrika_blincik') {
	?>
	
		<table>
	<tr style="background-color: #fff;">
		<th width="50" align='center'><font color="#FFFFFF">№</font></th>
		
		<th width="150" align="center"><font color="#FFFFFF">Сумма</font></th>
		<th width="150" align="center"><font color="#FFFFFF">Дата</font></th>
		<th width="150" align="center"><font color="#FFFFFF">Комментарий</font></th>
	</tr>
	<?php
	$q = mysql_query("SELECT * FROM tb_history WHERE type = 'fabrika_blincik' AND user_id = '$usid' ORDER BY id DESC");
	$i = 1;
	while($w = mysql_fetch_assoc($q)) {

	?>
	
	<tr style="background-color: #fff;"><td align='center'><?=$i; ?></td>
<td align='center'><?=$w['summa']; ?></td>
	<td align='center'><?=date("d.m.Y в H:i", $w['date']); ?></td>
	
	<td align='center'><?=$w['comment']; ?></td>
	</tr>
	<? 
	$i++;
	} ?>
	</table>
	
	<? }*/ elseif($type == 'bonus') {
	?>
	
		<table>
	<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);">
		<th width="50" align='center' style="background: #5A8CFA;"><font color="#FFFFFF">№</font></th>
		
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Сумма</font></th>
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Дата</font></th>
		<th width="150" align="center" style="background: #5A8CFA;"><font color="#FFFFFF">Комментарий</font></th>
	</tr>
	<?php
	$pagination = getPagesHistory($usid, 'tb_history', 'bonus');
	$q = $db->query("SELECT * FROM tb_history WHERE type = 'bonus' AND user_id = ?i ORDER BY id DESC LIMIT ?i, ?i", $usid, $pagination['start'], $pagination['num']);
	$i = $pagination['start'] + 1;
	while($w = $db->fetch($q)) {

	?>
	
	<tr style="border: 1px solid rgba(90, 140, 250, 0.56);"><td align='center' style="background: #5A8CFA;"><?=$i; ?></td>
<td align='center' style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=$w['summa']; ?></td>
	<td align='center' style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=date("d.m.Y в H:i", $w['date']); ?></td>
	
	<td align='center' style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=$w['comment']; ?></td>
	</tr>
	<? 
	$i++;
	} ?>
	</table>
	
	<? } ?>
	
	
	
	
	
	<? } ?>
	<? } ?>
	
<?php
//print_r($pagination);
// Проверяем нужны ли стрелки назад  
if ($pagination['pages'] != 1) $pervpage = '<a href= /history'.$pagination['href'].'/str/1><<</a> <a href= /history'.$pagination['href'].'/str/'. ($pagination['pages'] - 1) .'><</a> ';  
// Проверяем нужны ли стрелки вперед  
if ($pagination['pages'] != $pagination['total']) $nextpage = ' <a href= /history'.$pagination['href'].'/str/'. ($pagination['pages'] + 1) .'>></a>  
                                   <a href= /history'.$pagination['href'].'/str/' .$pagination['total']. '>>></a>';  

// Находим две ближайшие станицы с обоих краев, если они есть  
if($pagination['pages'] - 2 > 0) $page2left = ' <a href= /history'.$pagination['href'].'/str/'. ($pagination['pages'] - 2) .'>'. ($pagination['pages'] - 2) .'</a> | ';  
if($pagination['pages'] - 1 > 0) $page1left = '<a href= /history'.$pagination['href'].'/str/'. ($pagination['pages'] - 1) .'>'. ($pagination['pages'] - 1) .'</a> | ';  
if($pagination['pages'] + 2 <= $pagination['total']) $page2right = ' | <a href= /history'.$pagination['href'].'/str/'. ($pagination['pages'] + 2) .'>'. ($pagination['pages'] + 2) .'</a>';  
if($pagination['pages'] + 1 <= $pagination['total']) $page1right = ' | <a href= /history'.$pagination['href'].'/str/'. ($pagination['pages'] + 1) .'>'. ($pagination['pages'] + 1) .'</a>'; 

// Вывод меню  
echo 'Страницы: '.$pervpage.$page2left.$page1left.'<b>'.$pagination['pages'].'</b>'.$page1right.$page2right.$nextpage;  
			
				?>	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<br />
</p>