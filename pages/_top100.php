<center>   <div class="tegname"><h2>Топ 100</h2></div> </center>
<br>

<table style="width:100%;border: 1px solid rgba(90, 140, 250, 0.56);">
Рейтинг - это весь накопленный опыт.
<br>
<br>
<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);">
	<th width="50"style="background: #5A8CFA;"><font color="#FFFFFF">Место</font></th>
	<th width="150"style="background: #5A8CFA;"><font color="#FFFFFF">Фермер</font></th>
	<th width="100"style="background: #5A8CFA;"><font color="#FFFFFF">Уровень</font></th>
	<th width="100"style="background: #5A8CFA;"><font color="#FFFFFF">Рейтинг</font></th>

</tr>
<?php
$w = $db->query("SELECT * FROM tb_users ORDER BY level DESC LIMIT 100");
$i = 1;
while($q = $db->fetch($w)) {

?>
<tr style="  border: 1px solid rgba(90, 140, 250, 0.56);">
						<td style="  border: 1px solid rgba(90, 140, 250, 0.56);"><?=$i; ?></td>
						<td style="  border: 1px solid rgba(90, 140, 250, 0.56);"><a href="/wall/user/<?=$q['id']; ?>" title="Смотреть стену фермера <?=$q['username']; ?>!"><?=$q['username']; ?></a></td>
						<td align='center' style="  border: 1px solid rgba(90, 140, 250, 0.56);"><?=$q['level']; ?></td>
						<td align='center' style="  border: 1px solid rgba(90, 140, 250, 0.56);"><?=$q['reyting']; ?></td>
						</tr>
<?php 
$i++;
} ?>						
</table>