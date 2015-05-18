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
$p29 = sf($_POST['p29']);
$p30 = sf($_POST['p30']);
$p31 = sf($_POST['p31']);
$p32 = sf($_POST['p32']);
$p33 = sf($_POST['p33']);
$p34 = sf($_POST['p34']);
$p35 = sf($_POST['p35']);
$p36 = sf($_POST['p36']);
$p37 = sf($_POST['p37']);
$p38 = sf($_POST['p38']);
$p39 = sf($_POST['p39']);
$p40 = sf($_POST['p40']);
$p41 = sf($_POST['p41']);
$p42 = sf($_POST['p42']);
$p43 = sf($_POST['p43']);
$p44 = sf($_POST['p44']);
$p45 = sf($_POST['p45']);
$p46 = sf($_POST['p46']);
$p47 = sf($_POST['p47']);
$p48 = sf($_POST['p48']);
$p49 = sf($_POST['p49']);
$p50 = sf($_POST['p50']);
$p51 = sf($_POST['p51']);
$p52 = sf($_POST['p52']);
$p53 = sf($_POST['p53']);
$p54 = sf($_POST['p54']);

mysql_query("UPDATE tb_energy SET 
`p1` = '$p1', 
`p2` = '$p2', 
`p3` = '$p3', 
`p4` = '$p4', 
`p5` = '$p5', 
`p6` = '$p6', 
`p7` = '$p7', 
`p8` = '$p8', 
`p9` = '$p9', 
`p10` = '$p10',
`p11` = '$p11', 
`p12` = '$p12', 
`p13` = '$p13', 
`p14` = '$p14', 
`p15` = '$p15', 
`p16` = '$p16', 
`p17` = '$p17', 
`p18` = '$p18', 
`p19` = '$p19', 
`p20` = '$p20', 
`p21` = '$p21', 
`p22` = '$p22', 
`p23` = '$p23', 
`p24` = '$p24', 
`p25` = '$p25', 
`p26` = '$p26', 
`p27` = '$p27',
`p28` = '$p28',
`p29` = '$p29',
`p30` = '$p30',
`p31` = '$p31',
`p32` = '$p32',
`p33` = '$p33',
`p34` = '$p34',
`p35` = '$p35',
`p36` = '$p36',
`p37` = '$p37',
`p38` = '$p38',
`p39` = '$p39',
`p40` = '$p40',
`p41` = '$p41',
`p42` = '$p42',
`p43` = '$p43',
`p44` = '$p44',
`p45` = '$p45',
`p46` = '$p46',
`p47` = '$p47',
`p48` = '$p48',
`p49` = '$p49',
`p50` = '$p50',
`p51` = '$p51',
`p52` = '$p52',
`p53` = '$p53',
`p54` = '$p54'

WHERE id = 1") or die(mysql_error());

echo '<center><font color="green">Настройки успешно обновлены!</font></center>';
Header("Refresh: 2, /adminka/energy");
}

$q = mysql_query("SELECT * FROM tb_energy WHERE id = 1") or die(mysql_error());
$p = mysql_fetch_assoc($q);
?>
				   <div id="box">
                	<h3 id="adduser">Настройка энергии и опыта</h3>
					<br>
					<table align="center">
					<form method="post" action="">
					<tr>
					<td>Энергия за покупку фабрики Тесто: </td><td><input type="text" name="p1" value="<?=$p['p1'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия за покупку фабрики Фарш: </td><td><input type="text" name="p2" value="<?=$p['p2'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Энергия за покупку фабрики Сыр: </td><td><input type="text" name="p3" value="<?=$p['p3'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Энергия за покупку фабрики Сметана: </td><td><input type="text" name="p4" value="<?=$p['p4'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Энергия за покупку фабрики Варежки: </td><td><input type="text" name="p5" value="<?=$p['p5'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Энергия за покупку фабрики Удобрения: </td><td><input type="text" name="p6" value="<?=$p['p6'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия за покупку фабрики билнчиков с мясом: </td><td><input type="text" name="p7" value="<?=$p['p7'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия за покупку фабрики билнчиков с сыром: </td><td><input type="text" name="p8" value="<?=$p['p8'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия за покупку фабрики билнчиков с сметаной: </td><td><input type="text" name="p9" value="<?=$p['p9'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия запуск фабрики тесто: </td><td><input type="text" name="p10" value="<?=$p['p10'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия запуск фабрики фарш: </td><td><input type="text" name="p11" value="<?=$p['p11'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия запуск фабрики сыр: </td><td><input type="text" name="p12" value="<?=$p['p12'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия запуск фабрики сметана: </td><td><input type="text" name="p13" value="<?=$p['p13'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия запуск фабрики варежки: </td><td><input type="text" name="p14" value="<?=$p['p14'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия запуск фабрики удобрения: </td><td><input type="text" name="p15" value="<?=$p['p15'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия запуск фабрики блинчиков с мясом: </td><td><input type="text" name="p16" value="<?=$p['p16'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия запуск фабрики блинчиков с сыром: </td><td><input type="text" name="p17" value="<?=$p['p17'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия запуск фабрики блинчиков с сметаной: </td><td><input type="text" name="p18" value="<?=$p['p18'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия сбор продуктов фабрики тесто: </td><td><input type="text" name="p19" value="<?=$p['p19'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия сбор продуктов фабрики фарш: </td><td><input type="text" name="p20" value="<?=$p['p20'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия сбор продуктов фабрики сыр: </td><td><input type="text" name="p21" value="<?=$p['p21'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия сбор продуктов фабрики сметана: </td><td><input type="text" name="p22" value="<?=$p['p22'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия сбор продуктов фабрики варежки: </td><td><input type="text" name="p23" value="<?=$p['p23'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия сбор продуктов фабрики удобрений: </td><td><input type="text" name="p24" value="<?=$p['p24'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия сбор продуктов фабрики блинчиков с мясом: </td><td><input type="text" name="p25" value="<?=$p['p25'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия сбор продуктов фабрики блинчиков с сыром: </td><td><input type="text" name="p26" value="<?=$p['p26'];?>"></td>
					</tr>
					
					<tr>
					<td>Энергия сбор продуктов фабрики блинчиков с сметаной: </td><td><input type="text" name="p27" value="<?=$p['p27'];?>"></td>
					</tr>
					
					
					
					
					
					
					
					
					
					<tr>
					<td>Опыт за покупку фабрики Тесто: </td><td><input type="text" name="p28" value="<?=$p['p28'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт за покупку фабрики Фарш: </td><td><input type="text" name="p29" value="<?=$p['p29'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Опыт за покупку фабрики Сыр: </td><td><input type="text" name="p30" value="<?=$p['p30'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Опыт за покупку фабрики Сметана: </td><td><input type="text" name="p31" value="<?=$p['p31'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Опыт за покупку фабрики Варежки: </td><td><input type="text" name="p32" value="<?=$p['p32'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Опыт за покупку фабрики Удобрения: </td><td><input type="text" name="p33" value="<?=$p['p33'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт за покупку фабрики билнчиков с мясом: </td><td><input type="text" name="p34" value="<?=$p['p34'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт за покупку фабрики билнчиков с сыром: </td><td><input type="text" name="p35" value="<?=$p['p35'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт за покупку фабрики билнчиков с сметаной: </td><td><input type="text" name="p36" value="<?=$p['p36'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт запуск фабрики тесто: </td><td><input type="text" name="p37" value="<?=$p['p37'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт запуск фабрики фарш: </td><td><input type="text" name="p38" value="<?=$p['p38'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт запуск фабрики сыр: </td><td><input type="text" name="p39" value="<?=$p['p39'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт запуск фабрики сметана: </td><td><input type="text" name="p40" value="<?=$p['p40'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт запуск фабрики варежки: </td><td><input type="text" name="p41" value="<?=$p['p41'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт запуск фабрики удобрения: </td><td><input type="text" name="p42" value="<?=$p['p42'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт запуск фабрики блинчиков с мясом: </td><td><input type="text" name="p43" value="<?=$p['p43'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт запуск фабрики блинчиков с сыром: </td><td><input type="text" name="p44" value="<?=$p['p44'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт запуск фабрики блинчиков с сметаной: </td><td><input type="text" name="p45" value="<?=$p['p45'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт сбор продуктов фабрики тесто: </td><td><input type="text" name="p46" value="<?=$p['p46'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт сбор продуктов фабрики фарш: </td><td><input type="text" name="p47" value="<?=$p['p47'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт сбор продуктов фабрики сыр: </td><td><input type="text" name="p48" value="<?=$p['p48'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт сбор продуктов фабрики сметана: </td><td><input type="text" name="p49" value="<?=$p['p49'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт сбор продуктов фабрики варежки: </td><td><input type="text" name="p50" value="<?=$p['p50'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт сбор продуктов фабрики удобрений: </td><td><input type="text" name="p51" value="<?=$p['p51'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт сбор продуктов фабрики блинчиков с мясом: </td><td><input type="text" name="p52" value="<?=$p['p52'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт сбор продуктов фабрики блинчиков с сыром: </td><td><input type="text" name="p53" value="<?=$p['p53'];?>"></td>
					</tr>
					
					<tr>
					<td>Опыт сбор продуктов фабрики блинчиков с сметаной: </td><td><input type="text" name="p54" value="<?=$p['p54'];?>"></td>
					</tr>
					
					<tr>
					<td> </td><td><input type="submit" name="save" value="Сохранить"></td>
					</tr>
					</form>
					</table>
					     </div> 
			  </div>