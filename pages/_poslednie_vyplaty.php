<center>  <div class="tegname"><h2>Последние 100 выплат</h2></div> </center>
<br>
<table>
	<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);">
		<th width="150"style="background: #5A8CFA;"><font color="#FFFFFF">Фермер</font></th>
		<th width="50"style="background: #5A8CFA;"><font color="#FFFFFF">Уровень</font></th>
		<th width="100"style="background: #5A8CFA;"><font color="#FFFFFF">Сумма (руб)</font></th>
		<th width="150"align='center' style="background: #5A8CFA;"><font color="#FFFFFF">Дата</font></th>
	</tr>
	<?php
		// $q = $db->query("SELECT * FROM tb_vivod WHERE status = 1 ORDER BY id DESC limit 100");
		// while($w = $db->numRows($q)) {
		// $d = $db->getRow("SELECT level FROM tb_users WHERE id = ?i", $w['user_id']);

		$q = mysql_query("SELECT * FROM tb_vivod WHERE status = 1 ORDER BY id DESC limit 100");
		while ($w = mysql_fetch_array($q)) {
		$d = $db->getRow("SELECT level FROM tb_users WHERE id = ?i", $w['user_id']);
	?>
	<tr style="border: 1px solid rgba(90, 140, 250, 0.56);">
		<td style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=$w['login']; ?></td>
		<td style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=$d['level']; ?></td>
		<td style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=$w['summa_full']; ?></td>
		<td align="center" style="border: 1px solid rgba(90, 140, 250, 0.56);"><?=date("d.m.Y в H:i:s", $w['date']); ?></td>
	</tr>
	<?php } ?>		
</table>