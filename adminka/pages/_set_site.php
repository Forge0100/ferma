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

mysql_query("UPDATE tb_conf_site SET `name_site` = '$p1', `email_site` = '$p2', `min_vivod` = '$p3', `ref_perc` = '$p4', `start` = '$p5' WHERE id = 1") or die(mysql_error());

echo '<center><font color="green">Настройки успешно обновлены!</font></center>';
Header("Refresh: 2, /adminka/set_site");
}

$q = mysql_query("SELECT * FROM tb_conf_site WHERE id = 1") or die(mysql_error());
$p = mysql_fetch_assoc($q);
?>
				   <div id="box">
                	<h3 id="adduser">Настройка сайта</h3>
					<br>
					<table align="center">
					<form method="post" action="">
					<tr>
					<td>Название сайта: </td><td><input type="text" name="p1" value="<?=$p['name_site'];?>"></td>
					</tr>
					
					<tr>
					<td>E-Mail сайта: </td><td><input type="text" name="p2" value="<?=$p['email_site'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Минимум к выплате: </td><td><input type="text" name="p3" value="<?=$p['min_vivod'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Реф. процент: </td><td><input type="text" name="p4" value="<?=$p['ref_perc'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Старт проекта(UNIX дата): </td><td><input type="text" name="p5" value="<?=$p['start'];?>"><?=date("d.m.Y", $p['start']); ?></td>
					</tr>
					
					
					
					
					
					<tr>
					<td> </td><td><input type="submit" name="save" value="Сохранить"></td>
					</tr>
					</form>
					<tr><td colspan="2"><br><hr><br></td></tr>
					<?php
					if(isset($_POST['saveadm'])){
					$login = sf($_POST['login']);
					$pin = sf($_POST['pin']);
					
					if(!empty($_POST['pass'])) {
					$pass = md5Password($_POST['pass']);
					//$q = ', password = '.$pass;
						mysql_query("UPDATE tb_adm_login SET password = '$pass' WHERE id = 1") or die(mysql_error());
					}
					mysql_query("UPDATE tb_adm_login SET username = '$login', pin = '$pin' WHERE id = 1") or die(mysql_error());
					
					}
					?>
					<?php
					$q1 = mysql_query("SELECT * FROM tb_adm_login WHERE id = 1") or die(mysql_error());
$p1 = mysql_fetch_assoc($q1);
					?>
					
					<form method="post" action="">
					<tr>
					<td>Логин админа: </td><td><input type="text" name="login" value="<?=$p1['username'];?>"></td>
					</tr>
					
					<tr>
					<td>Пароль админа: </td><td><input type="text" name="pass" value=""></td>
					</tr>
					
					
					<tr>
					<td>ПИН-Код админа: </td><td><input type="text" name="pin" value="<?=$p1['pin'];?>"></td>
					</tr>
					
					
				
					
					
					
					
					
					
					<tr>
					<td> </td><td><input type="submit" name="saveadm" value="Сохранить"></td>
					</tr>
					</form>
					</table>
					     </div> 
			  </div>