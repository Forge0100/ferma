<?php
			$qzi = $db->query("SELECT DISTINCT login FROM tb_online ORDER BY date DESC");
			
			?>
			
<?php
$page = 'Кто онлайн';
?>
<script type="text/javascript">
jQuery(document).ready(function(){
setInterval("jQuery('#loadA').load('#div #loadB');",5000); //У меня интервал обновления блока - минута
});
</script>
<div id="loadA"><div id="loadB">
Пользователей онлайн: <?=$db->numRows($qzi); ?> 
<br>
<br>


<hr>

<table border="1"style="width:100%;border: 1px solid rgba(90, 140, 250, 0.56);color: #fff;">
<tr>
<th align="center" width="150"style="background: #5A8CFA;border: 1px solid rgba(90, 140, 250, 0.56);color: #fff;"><font color="#FFFFFF">№</font></th>
<th align="center" width="150"style="background: #5A8CFA;border: 1px solid rgba(90, 140, 250, 0.56);color: #fff;"><font color="#FFFFFF">Пользователь</font></th>
<th align="center" width="150"style="background: #5A8CFA;border: 1px solid rgba(90, 140, 250, 0.56);color: #fff;"><font color="#FFFFFF">Страница</font></th>
</tr>


<?php
$a = $db->query("SELECT DISTINCT ip, login, page FROM tb_online ORDER BY date DESC");
$i = 1;
while($q = $db->fetch($a)) {

?>
<tr align="center">
<td style="border: 1px solid rgba(90, 140, 250, 0.56); color:#333;"><?=$i; ?></td>
<td style="border: 1px solid rgba(90, 140, 250, 0.56); color:#333;"><?=$q['login']; ?></td>
<td style="border: 1px solid rgba(90, 140, 250, 0.56); color:#333;">

	<?php
		if($q['page'] != '') {
		echo $q['page']; 
		}else{
		echo 'Неизвестно';
		}
       ?>	

</td>
</tr>
<? 
$i++;
} ?>
</table>
</div>
</div>
