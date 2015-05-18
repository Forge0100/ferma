	<div id="rightnow">
<?php
if(isset($_POST['save'])) {
$p1 = sf($_POST['p1']);
$p2 = sf($_POST['p2']);
$p3 = sf($_POST['p3']);
$p4 = sf($_POST['p4']);
$p5 = sf($_POST['p5']);
$p6 = sf($_POST['p6']); 
$p7 = sf($_POST['p7']); 


mysql_query("UPDATE tb_conf_site SET `id_ooopay` = '$p1', `key_ooopay` = '$p2', `id_payeer` = '$p3', `key_payeer` = '$p4' , id_freekassa = '$p5', key_freekassa = '$p6', key2_freekassa = '$p7' WHERE id = 1" ) or die(mysql_error());

echo '<center><font color="green">Настройки успешно обновлены!</font></center>';
Header("Refresh: 2, /adminka/plat");
}


$q = mysql_query("SELECT * FROM tb_conf_site WHERE id = 1") or die(mysql_error());
$p = mysql_fetch_assoc($q);
?>
				   <div id="box">
                	<h3 id="adduser">Платежные системы</h3>
					<br>
					<table align="center">
					<form method="post" action="">
					
					<tr><td colspan="2">Настройки <b>Ooopay.org</b><hr></td></tr>
					<tr>
					<td>ID магазина: </td><td><input type="text" name="p1" value="<?=$p['id_ooopay'];?>"></td>
					</tr>
					
					<tr>
					<td>Секретный ключ магазина: </td><td><input type="text" name="p2" value="<?=$p['key_ooopay'];?>"></td>
					</tr>
					
					<tr><td colspan="2">Настройки <b>Payeer.com</b><hr></td></tr>
					<tr>
					<td>ID магазина: </td><td><input type="text" name="p3" value="<?=$p['id_payeer'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Секретный ключ магазина: </td><td><input type="text" name="p4" value="<?=$p['key_payeer'];?>"></td>
					</tr>
					
					
					
					<tr><td colspan="2">Настройки <b>Free-kassa.ru</b><hr></td></tr>
					<tr>
					<td>ID магазина: </td><td><input type="text" name="p5" value="<?=$p['id_freekassa'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Секретный ключ магазина: </td><td><input type="text" name="p6" value="<?=$p['key_freekassa'];?>"></td>
					</tr>
					
					<tr>
						<td>Секретный ключ 2 магазина: </td><td><input type="text" name="p7" value="<?=$p['key2_freekassa'];?>"></td>
					</tr>
					
					<tr>
					<td> </td><td><input type="submit" name="save" value="Сохранить"></td>
					</tr>
					</form>


					</table>
					     </div> 
			  </div>