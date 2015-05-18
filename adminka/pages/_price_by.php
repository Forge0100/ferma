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
$p9 = sf($_POST['p9']);
$p10 = sf($_POST['p10']);
$p11 = sf($_POST['p11']);
$p12 = sf($_POST['p12']);
$p13 = sf($_POST['p13']);
$p14 = sf($_POST['p14']);
$p15 = sf($_POST['p15']);
$p16 = sf($_POST['p16']);
$p17 = sf($_POST['p17']);
$p18 = sf($_POST['p18']);
$p19 = sf($_POST['p19']);
$p20 = sf($_POST['p20']);
$p21 = sf($_POST['p21']);
$p22 = sf($_POST['p22']);
$p23 = sf($_POST['p23']);
$p24 = sf($_POST['p24']);
$p25 = sf($_POST['p25']);
$p26 = sf($_POST['p26']);
$p27 = sf($_POST['p27']);
$p28 = sf($_POST['p28']);
mysql_query("UPDATE tb_price SET `kurita` = '$p1', `svinya` = '$p2', `ovta` = '$p3', `karova` = '$p4', `lama` = '$p5', `slon` = '$p6', `price_kuratnik` = '$p7', `price_svin` = '$p8', `price_ovta` = '$p9', `price_karova` = '$p10', `price_lama` = '$p11', `price_slon` = '$p12', `s1` = '$p13', `s2` = '$p14', `s3` = '$p15', `s4` = '$p16', `s5` = '$p17', `s6` = '$p18', `pole` = '$p19', `zavod_testo` = '$p20', `zavod_farsh` = '$p21', `zavod_sir` = '$p22', `zavod_smetana` = '$p23', `zavod_meh` = '$p24', `zavod_navoz` = '$p25', `f1` = '$p26', `f2` = '$p27', `f3` = '$p28' WHERE id = 1") or die(mysql_error());

echo '<center><font color="green">Настройки успешно обновлены!</font></center>';
Header("Refresh: 2, /adminka/price_by");
}

$q = mysql_query("SELECT * FROM tb_price WHERE id = 1") or die(mysql_error());
$p = mysql_fetch_assoc($q);
?>
				   <div id="box">
                	<h3 id="adduser">Настройка цен на покупку</h3>
					<br>
					<table align="center">
					<form method="post" action="">
					<tr>
					<td>Цена курици: </td><td><input type="text" name="p1" value="<?=$p['kurita'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена свиньи: </td><td><input type="text" name="p2" value="<?=$p['svinya'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Цена овци: </td><td><input type="text" name="p3" value="<?=$p['ovta'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Цена коровы: </td><td><input type="text" name="p4" value="<?=$p['karova'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Цена ламы: </td><td><input type="text" name="p5" value="<?=$p['lama'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Цена слона: </td><td><input type="text" name="p6" value="<?=$p['slon'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена курятника: </td><td><input type="text" name="p7" value="<?=$p['price_kuratnik'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена свинарника: </td><td><input type="text" name="p8" value="<?=$p['price_svin'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена овчарни: </td><td><input type="text" name="p9" value="<?=$p['price_ovta'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена коровника: </td><td><input type="text" name="p10" value="<?=$p['price_karova'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена ламовика: </td><td><input type="text" name="p11" value="<?=$p['price_lama'];?>"></td>
					<tr>
					<td>Цена слоновика: </td><td><input type="text" name="p12" value="<?=$p['price_slon'];?>"></td>
					</tr>
					
					</tr>
					
					
					<tr>
					<td>Цена пшеници: </td><td><input type="text" name="p13" value="<?=$p['s1'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена кукурузы: </td><td><input type="text" name="p14" value="<?=$p['s2'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена ячменя: </td><td><input type="text" name="p15" value="<?=$p['s3'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена свеклы: </td><td><input type="text" name="p16" value="<?=$p['s4'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена бобов: </td><td><input type="text" name="p17" value="<?=$p['s5'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена тыквы: </td><td><input type="text" name="p18" value="<?=$p['s6'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена поля: </td><td><input type="text" name="p19" value="<?=$p['pole'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена фабрики теста: </td><td><input type="text" name="p20" value="<?=$p['zavod_testo'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена фабрики фарша: </td><td><input type="text" name="p21" value="<?=$p['zavod_farsh'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена фабрики сыра: </td><td><input type="text" name="p22" value="<?=$p['zavod_sir'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена фабрики сметаны: </td><td><input type="text" name="p23" value="<?=$p['zavod_smetana'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена фабрики варежек: </td><td><input type="text" name="p24" value="<?=$p['zavod_meh'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена фабрики удобрений: </td><td><input type="text" name="p25" value="<?=$p['zavod_navoz'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Цена фабрики Блинчик с мясом: </td><td><input type="text" name="p26" value="<?=$p['f1'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена фабрики Блинчик с сыром: </td><td><input type="text" name="p27" value="<?=$p['f2'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена фабрики Блинчик с сметаной: </td><td><input type="text" name="p28" value="<?=$p['f3'];?>"></td>
					</tr>
					
					
					<tr>
					<td> </td><td><input type="submit" name="save" value="Сохранить"></td>
					</tr>
					</form>
					</table>
					     </div> 
			  </div>