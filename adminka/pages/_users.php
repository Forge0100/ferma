 
                    <h3>Список пользователей</h3> 
					
					
					<?php
					if(isset($_POST['save'])) {
					$id = intval($_POST['id_u']);
					$name = sf($_POST['p1']);
					$email = sf($_POST['p2']);
					$p3 = sf($_POST['p3']);
					$p4 = sf($_POST['p4']);
					$p5 = sf($_POST['p5']);
					$p6 = sf($_POST['p6']);
					$p7 = sf($_POST['p7']);
					$p8 = sf($_POST['p8']);
					$p9 = sf($_POST['p9']);
					$p10 = sf($_POST['p10']);
					$p11 = sf($_POST['p11']);
					$p12 = intval($_POST['p12']);
					
					mysql_query("UPDATE tb_users SET username = '$name', email = '$email', money_out = '$p3', money = '$p4', blin_myaso_by = '$p5', blin_sir_by = '$p6', blin_smetana_by = '$p7', blin_myaso = '$p8', blin_sir = '$p9', blin_smetana = '$p10', udob = '$p11', `ban` = '$p12' WHERE id = '$id'") or die(mysql_error());
					echo '<center><font color="green">Пользователь сохранен</font></center>';
					Header("Refresh: 2, /adminka/users");
					}
					
					
					if(isset($_GET['dell'])) {
					$dell = intval($_GET['dell']);
					mysql_query("DELETE FROM tb_users WHERE id = '$dell'") or die(mysql_error());
					}
					
					
					if(isset($_GET['read'])) {
					$read = intval($_GET['read']);
					$p = mysql_fetch_assoc(mysql_query("SELECT * FROM tb_users WHERE id = '$read'"));
					?>
					<table align="center">
					<form method="post" action="">
					<input type="hidden" name="id_u" value="<?=$p['id']; ?>">
					<tr>
					<td>Логин: </td><td><input type="text" name="p1" value="<?=$p['username'];?>"></td>
					</tr>
					
					<tr>
					<td>E-mail: </td><td><input type="text" name="p2" value="<?=$p['email'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Баланс на вывод: </td><td><input type="text" name="p3" value="<?=$p['money_out'];?>"></td>
					</tr>
					
					
					<tr>
					<td>Баланс на покупки: </td><td><input type="text" name="p4" value="<?=$p['money'];?>"></td>
					</tr>
					
					<tr>
					<td>Дата регистрации: </td><td><input type="text" name="" value="<?=date("d.m.Y в H:i", $p['money']);?>" disabled /></td>
					</tr>
					
					<tr>
					<td>Блин с мясом продажа: </td><td><input type="text" name="p5" value="<?=$p['blin_myaso_by'];?>"  /></td>
					</tr>
					
					<tr>
					<td>Блин с сыром продажа: </td><td><input type="text" name="p6" value="<?=$p['blin_sir_by'];?>"  /></td>
					</tr>
					
					
					<tr>
					<td>Блин с сметаной продажа: </td><td><input type="text" name="p7" value="<?=$p['blin_smetana_by'];?>"  /></td>
					</tr>
					
					<tr>
					<td>Блин с мясом кушать: </td><td><input type="text" name="p8" value="<?=$p['blin_myaso'];?>"  /></td>
					</tr>
					
					<tr>
					<td>Блин с сыром кушать: </td><td><input type="text" name="p9" value="<?=$p['blin_sir'];?>"  /></td>
					</tr>
					
					<tr>
					<td>Блин с сметаной кушать: </td><td><input type="text" name="p10" value="<?=$p['blin_smetana'];?>"  /></td>
					</tr>
					
					<tr>
					<td>Удобрения для посадки: </td><td><input type="text" name="p11" value="<?=$p['udob'];?>"  /></td>
					</tr>
					
					<tr>
					<td>Забанить: </td><td><select name="p12">
					<option value="0" <? if($p['ban'] == 0) echo 'selected'; ?> >Нет
					<option value="1" <? if($p['ban'] == 1) echo 'selected'; ?>>Да
					
					</select></td>
					</tr>
					
					
					<tr>
					<td> </td><td><input type="submit" name="save" value="Сохранить"></td>
					</tr>
					</form>
					</table>
					<?php
					return;
					}
					?>
					<form method="post" action="">
					<input type="text" name="us" value="">
					<input type="submit" value="Найти">
					
					</form>
                    <table>
						<thead>
							<tr>
                            	<th>ID</th>
                                <th>Логин</th>
                                <th>E-Mail</th>
                                <th>Баланс вывод/ввод</th>
                                <th>Действие</th>
                            </tr>
						</thead>
						<tbody>
						<?php
						if(isset($_POST['us'])){
						$us = sf($_POST['us']);
						$w = 'WHERE username = '.$us;
						}else $us = '';
$num = 20;  
$page = intval($_GET['str']);  
$result = mysql_query("SELECT COUNT(*) FROM tb_users");  
$posts = mysql_result($result, 0);  
$total = intval(($posts - 1) / $num) + 1;  
$page = intval($page);  
if(empty($page) or $page < 0) $page = 1;  
  if($page > $total) $page = $total;  
$start = $page * $num - $num;  
if($us == '') {
						$q = mysql_query("SELECT * FROM tb_users ORDER BY id DESC LIMIT $start, $num") or die(mysql_error());
}else {
$q = mysql_query("SELECT * FROM tb_users WHERE username = '$us' ORDER BY id DESC LIMIT $start, $num") or die(mysql_error());
}
						while($w = mysql_fetch_assoc($q)) {
						?>
							<tr align="center">
                            	<td><?=$w['id']; ?></td>
                                <td><?=$w['username']; ?></td>
                                <td><?=$w['email']; ?></td>
                                <td><?=$w['money_out']; ?> / <?=$w['money']; ?></td>
                                <td>
								<a href="/wall/user/<?=$w['id']; ?>" target="_blank"><img src="/adminka/img/icons/page_white_link.png" title="Перейти на стену пользователя" /></a>
								<a href="/adminka/users/read/<?=$w['id']; ?>"><img src="/adminka/img/icons/page_white_edit.png" title="Редактировать пользователя" /></a>
								<a href="/adminka/users/dell/<?=$w['id']; ?>"><img src="/adminka/img/icons/page_white_delete.png" title="Удалить пользователя" /></a>
								</td>
                            </tr>
						<? } ?>
						</tbody>
					</table>
					
					<?php
					// Проверяем нужны ли стрелки назад  
if ($page != 1) $pervpage = '<a href= /adminka/users/str/1><<</a>  
                               <a href= /adminka/users/str/'. ($page - 1) .'><</a> ';  
// Проверяем нужны ли стрелки вперед  
if ($page != $total) $nextpage = ' <a href= /adminka/users/str/'. ($page + 1) .'>></a>  
                                   <a href= /adminka/users/str/' .$total. '>>></a>';  

// Находим две ближайшие станицы с обоих краев, если они есть  
if($page - 2 > 0) $page2left = ' <a href= /adminka/users/str/'. ($page - 2) .'>'. ($page - 2) .'</a> | ';  
if($page - 1 > 0) $page1left = '<a href= /adminka/users/str/'. ($page - 1) .'>'. ($page - 1) .'</a> | ';  
if($page + 2 <= $total) $page2right = ' | <a href= /adminka/users/str/'. ($page + 2) .'>'. ($page + 2) .'</a>';  
if($page + 1 <= $total) $page1right = ' | <a href= /adminka/users/str/'. ($page + 1) .'>'. ($page + 1) .'</a>'; 

// Вывод меню  
echo '<center>'.$pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage.'</center>';  
					?>
