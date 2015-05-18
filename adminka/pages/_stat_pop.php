<br><br><hr>					
				   <table>
						<thead>
							<tr>
                            	<th>ID</th>
                                <th>Логин</th>
                                <th>Дата</th>
                                <th>Животное</th>
                                <th>Кол-во</th>
                               

                            </tr>
						</thead>
						<tbody>
						<?php
						$q = mysql_query("SELECT * FROM tb_stat_z ORDER BY id DESC") or die(mysql_error());
						while($w = mysql_fetch_assoc($q)) {
						switch($w['type']) {
						case 1: $type = 'Курица'; break;
						case 2: $type = 'Свинья'; break;
						case 3: $type = 'Овца'; break;
						case 4: $type = 'Корова'; break;
						case 5: $type = 'Лама'; break;
						case 6: $type = 'Слон'; break;
						
						}
						?>
							<tr align="center">
                            	<td><?=$w['id']; ?></td>
                                <td><?=$w['login']; ?></td>
                                <td><?=date("d.m.Y в H:i:s", $w['date']); ?></td>
                                <td><?=$type; ?></td>
                                <td><?=$w['kol']; ?></td>
                                
                               
                            </tr>
						<? } ?>
						</tbody>
					</table>
					
					
					<br><hr><br>