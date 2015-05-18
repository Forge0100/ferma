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
mysql_query("UPDATE tb_price SET `yaco_p` = '$p1', `myaso_p` = '$p2', `m_o_p` = '$p3', `m_k_p` = '$p4', `testo_p` = '$p5', `farsh_p` = '$p6', `sir_p` = '$p7', `smetana_p` = '$p8', `pshenica_p` = '$p9', `kukurudza_p` = '$p10', `jachmen_p` = '$p11', `svekla_p` = '$p12', `bobi_p` = '$p13', `tikva_p` = '$p14', `yaco_b` = '$p15', `myaso_b` = '$p16', `m_o_b` = '$p17', `m_k_b` = '$p18', `testo_b` = '$p19', `farsh_b` = '$p20', `sir_b` = '$p21', `smetana_b` = '$p22', `pshenica_b` = '$p23', `kukurudza_b` = '$p24', `jachmen_b` = '$p25', `svekla_b` = '$p26', `bobi_b` = '$p27', `tikva_b` = '$p28' WHERE id = 1") or die(mysql_error());

echo '<center><font color="green">Настройки успешно обновлены!</font></center>';
Header("Refresh: 2, /adminka/price_lavka");
}

$q = mysql_query("SELECT * FROM tb_price WHERE id = 1") or die(mysql_error());
$p = mysql_fetch_assoc($q);
?>
				   <div id="box">
                	<h3 id="adduser">Настройка цен для лавки</h3>
					<br>
					<table align="center">
					<form method="post" action="">
					<tr>
					<td>Цена Покупки яйцо: </td><td><input type="text" name="p1" value="<?=$p['yaco_p'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена покупки мясо: </td><td><input type="text" name="p2" value="<?=$p['myaso_p'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Цена покупки молоко овци: </td><td><input type="text" name="p3" value="<?=$p['m_o_p'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Цена покупки молоко коровы: </td><td><input type="text" name="p4" value="<?=$p['m_k_p'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Цена покупки тесто: </td><td><input type="text" name="p5" value="<?=$p['testo_p'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Цена покупки фарш: </td><td><input type="text" name="p6" value="<?=$p['farsh_p'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена покупки сыр: </td><td><input type="text" name="p7" value="<?=$p['sir_p'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена покупки сметана: </td><td><input type="text" name="p8" value="<?=$p['smetana_p'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена покупки корм кур: </td><td><input type="text" name="p9" value="<?=$p['pshenica_p'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена покупки корм свиней: </td><td><input type="text" name="p10" value="<?=$p['kukurudza_p'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена покупки корм овец: </td><td><input type="text" name="p11" value="<?=$p['jachmen_p'];?>"></td>
					</tr>

					<tr>
					<td>Цена покупки корм коров: </td><td><input type="text" name="p12" value="<?=$p['svekla_p'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена покупки корм лам: </td><td><input type="text" name="p13" value="<?=$p['bobi_p'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена покупки корм слонов: </td><td><input type="text" name="p14" value="<?=$p['tikva_p'];?>"></td>
					</tr>
					
					
										<tr>
					<td>Цена продажи яйцо: </td><td><input type="text" name="p15" value="<?=$p['yaco_b'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена продажи мясо: </td><td><input type="text" name="p16" value="<?=$p['myaso_b'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Цена продажи молоко овци: </td><td><input type="text" name="p17" value="<?=$p['m_o_b'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Цена продажи молоко коровы: </td><td><input type="text" name="p18" value="<?=$p['m_k_b'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Цена продажи тесто: </td><td><input type="text" name="p19" value="<?=$p['testo_b'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Цена продажи фарш: </td><td><input type="text" name="p20" value="<?=$p['farsh_b'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена продажи сыр: </td><td><input type="text" name="p21" value="<?=$p['sir_b'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена продажи сметана: </td><td><input type="text" name="p22" value="<?=$p['smetana_b'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена продажи корм кур: </td><td><input type="text" name="p23" value="<?=$p['pshenica_b'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена продажи корм свиней: </td><td><input type="text" name="p24" value="<?=$p['kukurudza_b'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена продажи корм овец: </td><td><input type="text" name="p25" value="<?=$p['jachmen_b'];?>"></td>
					</tr>

					<tr>
					<td>Цена продажи корм коров: </td><td><input type="text" name="p26" value="<?=$p['svekla_b'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена продажи корм лам: </td><td><input type="text" name="p27" value="<?=$p['bobi_b'];?>"></td>
					</tr>
					
					<tr>
					<td>Цена продажи корм слонов: </td><td><input type="text" name="p28" value="<?=$p['tikva_b'];?>"></td>
					</tr>
					
					
					<tr>
					<td> </td><td><input type="submit" name="save" value="Сохранить"></td>
					</tr>
					</form>
					</table>
					     </div> 
			  </div>