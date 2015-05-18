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
$p8 = sf($_POST['p8']);

mysql_query("UPDATE tb_price SET `meh_b` = '$p1', `navoz_b` = '$p2', `varezki_b` = '$p3', `udob_b` = '$p4', `meh_p` = '$p5', `navoz_p` = '$p6', `varezki_p` = '$p7', `udob_p` = '$p8' WHERE id = 1") or die(mysql_error());

echo '<center><font color="green">Настройки успешно обновлены!</font></center>';
Header("Refresh: 2, /adminka/price_sell");
}

$q = mysql_query("SELECT * FROM tb_price WHERE id = 1") or die(mysql_error());
$p = mysql_fetch_assoc($q);
?>
				   <div id="box">
                	<h3 id="adduser">Настройка цен для магазина</h3>
					<br>
					<table align="center">
					<form method="post" action="">
					<tr>
					<td>Цена Покупки меха: </td><td><input type="text" name="p1" value="<?=$p['meh_b'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена покупки навоза: </td><td><input type="text" name="p2" value="<?=$p['navoz_b'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Цена покупки варежки: </td><td><input type="text" name="p3" value="<?=$p['varezki_b'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Цена покупки удобрений: </td><td><input type="text" name="p4" value="<?=$p['udob_b'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Цена продажи меха: </td><td><input type="text" name="p5" value="<?=$p['meh_p'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Цена продажи навоза: </td><td><input type="text" name="p6" value="<?=$p['navoz_p'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена продажи варежки: </td><td><input type="text" name="p7" value="<?=$p['varezki_p'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена продажи удобрений: </td><td><input type="text" name="p8" value="<?=$p['udob_p'];?>"></td>
					</tr>
					
					
					
					<tr>
					<td> </td><td><input type="submit" name="save" value="Сохранить"></td>
					</tr>
					</form>
					</table>
					     </div> 
			  </div>