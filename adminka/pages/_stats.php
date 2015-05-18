	<div id="rightnow">

				   <div id="box">
                	<h3 id="adduser">Статистика игры</h3>
					
					     </div> 
						 
						 
						<table align="center">
					
					<tr>
					<td>Пользователей: </td><td><?=mysql_num_rows(mysql_query("SELECT * FROM tb_users")); ?></td>
					</tr>
					
<?php
			$tt = mysql_query("SELECT * FROM tb_vivod WHERE status = 1");
			$ye = mysql_fetch_assoc(mysql_query("SELECT SUM(summa_full) AS sum_v FROM tb_vivod WHERE status = 1"));
			$q = mysql_num_rows(mysql_query("SELECT * FROM tb_stat_z WHERE type = 1"));
			$q1 = mysql_num_rows(mysql_query("SELECT * FROM tb_stat_z WHERE type = 2"));
			$q3 = mysql_num_rows(mysql_query("SELECT * FROM tb_stat_z WHERE type = 3"));
			$q4 = mysql_num_rows(mysql_query("SELECT * FROM tb_stat_z WHERE type = 4"));
			$q5 = mysql_num_rows(mysql_query("SELECT * FROM tb_stat_z WHERE type = 5"));
			$q6 = mysql_num_rows(mysql_query("SELECT * FROM tb_stat_z WHERE type = 6"));
			$y = mysql_fetch_assoc(mysql_query("SELECT * FROM tb_stat_full")) or die(mysql_error());
?>
					
					<tr>
					<td>Выплачено всего: </td><td><?=$ye['sum_v']; ?></td>
					</tr>
					
					<tr>
					<td>Куплено курей: </td><td><?=$q; ?></td>
					</tr>
					
					<tr>
					<td>Куплено свиней: </td><td><?=$q1; ?></td>
					</tr>
					
					<tr>
					<td>Куплено овец: </td><td><?=$q3; ?></td>
					</tr>
					
					<tr>
					<td>Куплено коров: </td><td><?=$q4; ?></td>
					</tr>
					
					<tr>
					<td>Куплено лам: </td><td><?=$q5; ?></td>
					</tr>
					
					<tr>
					<td>Куплено слонов: </td><td><?=$q6; ?></td>
					</tr>
					
					<tr>
					<td>Куплено Полей: </td><td><?=$y['kol_pole']; ?></td>
					</tr>
					
					<tr>
					<td>Куплено Курятников: </td><td><?=$y['kol_kurat']; ?></td>
					</tr>
					
					<tr>
					<td>Куплено Свинарников: </td><td><?=$y['kol_svinarnik']; ?></td>
					</tr>
					<tr>
					<td>Куплено Овчарен: </td><td><?=$y['kol_ovtarnik']; ?></td>
					</tr>
					<tr>
					<td>Куплено Коровников: </td><td><?=$y['kol_korovnik']; ?></td>
					</tr>
					<tr>
					<td>Куплено Ламовников: </td><td><?=$y['kol_lamovik']; ?></td>
					</tr>
					<tr>
					<td>Куплено Слоновников: </td><td><?=$y['kol_slonovik']; ?></td>
					</tr>
					
					</table>
			  </div>