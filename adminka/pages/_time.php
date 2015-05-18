	<div id="rightnow">
<?php
if(isset($_POST['save'])) {
$p1 = sf($_POST['p1']);
$p2 = sf($_POST['p2']);
$p3 = sf($_POST['p3']);
$p4 = sf($_POST['p4']);
$p5 = sf($_POST['p5']);
$p6 = sf($_POST['p6']);

mysql_query("UPDATE tb_time SET `time` = '$p1' WHERE id = 1") or die(mysql_error());
mysql_query("UPDATE tb_time SET `time` = '$p2' WHERE id = 2") or die(mysql_error());
mysql_query("UPDATE tb_time SET `time` = '$p3' WHERE id = 3") or die(mysql_error());
mysql_query("UPDATE tb_time SET `time` = '$p4' WHERE id = 4") or die(mysql_error());
mysql_query("UPDATE tb_time SET `time` = '$p5' WHERE id = 5") or die(mysql_error());
mysql_query("UPDATE tb_time SET `time` = '$p6' WHERE id = 6") or die(mysql_error());

echo '<center><font color="green">Настройки успешно обновлены!</font></center>';
Header("Refresh: 2, /adminka/time");
}


if(isset($_POST['save2'])) {
$p7 = sf($_POST['p7']);
$p8 = sf($_POST['p8']);
$p9 = sf($_POST['p9']);


mysql_query("UPDATE tb_time_fabblin SET `time` = '$p7' WHERE id = 1") or die(mysql_error());
mysql_query("UPDATE tb_time_fabblin SET `time` = '$p8' WHERE id = 2") or die(mysql_error());
mysql_query("UPDATE tb_time_fabblin SET `time` = '$p9' WHERE id = 3") or die(mysql_error());


echo '<center><font color="green">Настройки успешно обновлены!</font></center>';
Header("Refresh: 2, /adminka/time");
}


if(isset($_POST['save3'])) {
$p1 = sf($_POST['p10']);
$p2 = sf($_POST['p11']);
$p3 = sf($_POST['p12']);
$p4 = sf($_POST['p13']);
$p5 = sf($_POST['p14']);
$p6 = sf($_POST['p15']);

mysql_query("UPDATE tb_time_prod SET `time` = '$p1' WHERE id = 1") or die(mysql_error());
mysql_query("UPDATE tb_time_prod SET `time` = '$p2' WHERE id = 2") or die(mysql_error());
mysql_query("UPDATE tb_time_prod SET `time` = '$p3' WHERE id = 3") or die(mysql_error());
mysql_query("UPDATE tb_time_prod SET `time` = '$p4' WHERE id = 4") or die(mysql_error());
mysql_query("UPDATE tb_time_prod SET `time` = '$p5' WHERE id = 5") or die(mysql_error());
mysql_query("UPDATE tb_time_prod SET `time` = '$p6' WHERE id = 6") or die(mysql_error());

echo '<center><font color="green">Настройки успешно обновлены!</font></center>';
Header("Refresh: 2, /adminka/time");
}


if(isset($_POST['save4'])) {
$p1 = sf($_POST['p16']);
$p2 = sf($_POST['p17']);
$p3 = sf($_POST['p18']);
$p4 = sf($_POST['p19']);
$p5 = sf($_POST['p20']);
$p6 = sf($_POST['p21']);

mysql_query("UPDATE tb_time_fabp SET `time` = '$p1' WHERE id = 1") or die(mysql_error());
mysql_query("UPDATE tb_time_fabp SET `time` = '$p2' WHERE id = 2") or die(mysql_error());
mysql_query("UPDATE tb_time_fabp SET `time` = '$p3' WHERE id = 3") or die(mysql_error());
mysql_query("UPDATE tb_time_fabp SET `time` = '$p4' WHERE id = 4") or die(mysql_error());
mysql_query("UPDATE tb_time_fabp SET `time` = '$p5' WHERE id = 5") or die(mysql_error());
mysql_query("UPDATE tb_time_fabp SET `time` = '$p6' WHERE id = 6") or die(mysql_error());

echo '<center><font color="green">Настройки успешно обновлены!</font></center>';
Header("Refresh: 2, /adminka/time");
}


?>
				   <div id="box">
                	<h3 id="adduser">Настройка сроков созревания и отдачи продукции(данные указываются в секундах!)<br><center><font color="red"> 1 час = 3600 сек</font></center></h3>
					<br>
					<table align="center">
					<form method="post" action="">
					<?php
					$q1 = mysql_query("SELECT * FROM tb_time WHERE id = 1") or die(mysql_error());
					$p1 = mysql_fetch_assoc($q1);
					?>
					<tr>
					<td>Созревание пшеници: </td><td><input type="text" name="p1" value="<?=$p1['time'];?>"></td>
					</tr>
					<?php
					$q2 = mysql_query("SELECT * FROM tb_time WHERE id = 2") or die(mysql_error());
					$p2 = mysql_fetch_assoc($q2);
					?>
					<tr>
					<td>Созревание кукурузы: </td><td><input type="text" name="p2" value="<?=$p2['time'];?>"></td>
					</tr>
					
					<?php
					$q3 = mysql_query("SELECT * FROM tb_time WHERE id = 3") or die(mysql_error());
					$p3 = mysql_fetch_assoc($q3);
					?>
					<tr>
					<td>Созревание ячменя: </td><td><input type="text" name="p3" value="<?=$p3['time'];?>"></td>
					</tr>
					
					<?php
					$q4 = mysql_query("SELECT * FROM tb_time WHERE id = 4") or die(mysql_error());
					$p4 = mysql_fetch_assoc($q4);
					?>
					<tr>
					<td>Созревание свеклы: </td><td><input type="text" name="p4" value="<?=$p4['time'];?>"></td>
					</tr>
					
					<?php
					$q5 = mysql_query("SELECT * FROM tb_time WHERE id = 5") or die(mysql_error());
					$p5 = mysql_fetch_assoc($q5);
					?>
					<tr>
					<td>Созревание бобов: </td><td><input type="text" name="p5" value="<?=$p5['time'];?>"></td>
					</tr>
					
					<?php
					$q6 = mysql_query("SELECT * FROM tb_time WHERE id = 6") or die(mysql_error());
					$p6 = mysql_fetch_assoc($q6);
					?>
					<tr>
					<td>Созревание тыквы: </td><td><input type="text" name="p6" value="<?=$p6['time'];?>"></td>
					</tr>
					
					
					<tr>
					<td> </td><td><input type="submit" name="save" value="Сохранить"></td>
					</tr>
					</form>
					
					
					
					<tr>
				<td colspan="2"><br><hr><br></td>
					</tr>
					<form method="post" action="">
					<?php
					$q1 = mysql_query("SELECT * FROM tb_time_fabblin WHERE id = 1") or die(mysql_error());
					$p1 = mysql_fetch_assoc($q1);
					?>
					<tr>
					<td>Время переработки на фабрике блинчиков с мясом: </td><td><input type="text" name="p7" value="<?=$p1['time'];?>"></td>
					</tr>
					<?php
					$q2 = mysql_query("SELECT * FROM tb_time_fabblin WHERE id = 2") or die(mysql_error());
					$p2 = mysql_fetch_assoc($q2);
					?>
					<tr>
					<td>Время переработки на фабрике блинчиков с сыром: </td><td><input type="text" name="p8" value="<?=$p2['time'];?>"></td>
					</tr>
					<?php
					$q3 = mysql_query("SELECT * FROM tb_time_fabblin WHERE id = 3") or die(mysql_error());
					$p3 = mysql_fetch_assoc($q3);
					?>
					<tr>
					<td>Время переработки на фабрике блинчиков с сметаной: </td><td><input type="text" name="p9" value="<?=$p3['time'];?>"></td>
					</tr>
					
					<tr>
					<td> </td><td><input type="submit" name="save2" value="Сохранить"></td>
					</tr>
					</form>
					<tr>
				<td colspan="2"><br><hr><br></td>
					</tr>
					
					
					
					<form method="post" action="">
					<?php
					$q1 = mysql_query("SELECT * FROM tb_time_fabp WHERE id = 1") or die(mysql_error());
					$p1 = mysql_fetch_assoc($q1);
					?>
					<tr>
					<td>Время переработки на фабрике тесто: </td><td><input type="text" name="p16" value="<?=$p1['time'];?>"></td>
					</tr>
					<?php
					$q2 = mysql_query("SELECT * FROM tb_time_fabp WHERE id = 2") or die(mysql_error());
					$p2 = mysql_fetch_assoc($q2);
					?>
					<tr>
					<td>Время переработки на фабрике фарш: </td><td><input type="text" name="p17" value="<?=$p2['time'];?>"></td>
					</tr>
					<?php
					$q3 = mysql_query("SELECT * FROM tb_time_fabp WHERE id = 3") or die(mysql_error());
					$p3 = mysql_fetch_assoc($q3);
					?>
					<tr>
					<td>Время переработки на фабрике сыр: </td><td><input type="text" name="p18" value="<?=$p3['time'];?>"></td>
					</tr>
					
					<?php
					$q4 = mysql_query("SELECT * FROM tb_time_fabp WHERE id = 4") or die(mysql_error());
					$p4 = mysql_fetch_assoc($q4);
					?>
					<tr>
					<td>Время переработки на фабрике сметана: </td><td><input type="text" name="p19" value="<?=$p4['time'];?>"></td>
					</tr>
					
					
					<?php
					$q5 = mysql_query("SELECT * FROM tb_time_fabp WHERE id = 5") or die(mysql_error());
					$p5 = mysql_fetch_assoc($q5);
					?>
					<tr>
					<td>Время переработки на фабрике варежки: </td><td><input type="text" name="p20" value="<?=$p5['time'];?>"></td>
					</tr>
					
					
					<?php
					$q6 = mysql_query("SELECT * FROM tb_time_fabp WHERE id = 6") or die(mysql_error());
					$p6 = mysql_fetch_assoc($q6);
					?>
					<tr>
					<td>Время переработки на фабрике удобрения: </td><td><input type="text" name="p21" value="<?=$p6['time'];?>"></td>
					</tr>
					
					<tr>
					<td> </td><td><input type="submit" name="save4" value="Сохранить"></td>
					</tr>
					</form>
					<tr>
				<td colspan="2"><br><hr><br></td>
					</tr>
					
					
					<form method="post" action="">
					<?php
					$q1 = mysql_query("SELECT * FROM tb_time_prod WHERE id = 1") or die(mysql_error());
					$p1 = mysql_fetch_assoc($q1);
					?>
					<tr>
					<td>Время дачи продуктов курици: </td><td><input type="text" name="p10" value="<?=$p1['time'];?>"></td>
					</tr>
					<?php
					$q2 = mysql_query("SELECT * FROM tb_time_prod WHERE id = 2") or die(mysql_error());
					$p2 = mysql_fetch_assoc($q2);
					?>
					<tr>
					<td>Время дачи продуктов свиньи: </td><td><input type="text" name="p11" value="<?=$p2['time'];?>"></td>
					</tr>
					
					<?php
					$q3 = mysql_query("SELECT * FROM tb_time_prod WHERE id = 3") or die(mysql_error());
					$p3 = mysql_fetch_assoc($q3);
					?>
					<tr>
					<td>Время дачи продуктов овци: </td><td><input type="text" name="p12" value="<?=$p3['time'];?>"></td>
					</tr>
					
				
					
					<?php
					$q4 = mysql_query("SELECT * FROM tb_time_prod WHERE id = 4") or die(mysql_error());
					$p4 = mysql_fetch_assoc($q4);
					?>
					<tr>
					<td>Время дачи продуктов коровы: </td><td><input type="text" name="p13" value="<?=$p4['time'];?>"></td>
					</tr>
					<?php
					$q5 = mysql_query("SELECT * FROM tb_time_prod WHERE id = 5") or die(mysql_error());
					$p5 = mysql_fetch_assoc($q5);
					?>
					<tr>
					<td>Время дачи продуктов ламы: </td><td><input type="text" name="p14" value="<?=$p5['time'];?>"></td>
					</tr>
					<?php
					$q6 = mysql_query("SELECT * FROM tb_time_prod WHERE id = 6") or die(mysql_error());
					$p6 = mysql_fetch_assoc($q6);
					?>
					<tr>
					<td>Время дачи продуктов слона: </td><td><input type="text" name="p15" value="<?=$p6['time'];?>"></td>
					</tr>
					<tr>
					<td> </td><td><input type="submit" name="save3" value="Сохранить"></td>
					</tr>
					</form>
					<tr>
				<td colspan="2"><br><hr><br></td>
					</tr>
					
					
					</table>
					     </div> 
			  </div>