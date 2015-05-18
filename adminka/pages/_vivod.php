  
  	<div id="rightnow">

				   <div id="box">
                	<h3 id="adduser">Статистика пополнений</h3>
					
					     </div> 
						 
						 <?php
						 if(isset($_GET['read'])) {
						 $read = intval($_GET['read']);
						 mysql_query("UPDATE tb_vivod SET status = 1 WHERE id = '$read'");
						 
						 }
						 
						 if(isset($_GET['dell'])) {
						 $read = intval($_GET['dell']);
						 mysql_query("UPDATE tb_vivod SET status = 2 WHERE id = '$read'");
						 
						 }
						 ?>
  
  <table>
						<thead>
							<tr>
                            	<th>ID</th>
                                <th>Логин</th>
                                <th>Сумма</th>
                                <th>Система</th>
                                <th>Кошелек</th>
                                <th>Дата</th>
                                <th>Действие</th>

                            </tr>
						</thead>
						<tbody>
						<?php
$num = 20;  
$page = intval($_GET['str']);  
$result = mysql_query("SELECT COUNT(*) FROM tb_vivod WHERE status = 0");  
$posts = mysql_result($result, 0);  
$total = intval(($posts - 1) / $num) + 1;  
$page = intval($page);  
if(empty($page) or $page < 0) $page = 1;  
  if($page > $total) $page = $total;  
$start = $page * $num - $num;  
						$q = mysql_query("SELECT * FROM tb_vivod WHERE status = 0 ORDER BY id DESC LIMIT $start, $num") or die(mysql_error());
						if(mysql_num_rows($q) == 0) {
						echo '<tr><td colspan="7">Заказов выплат еще не было</td></tr>';
						}else {
						while($w = mysql_fetch_assoc($q)) {
							switch($w['purse_type']) {
								case 1: $purse_type = 'Payeer'; break;
								case 2: $purse_type = 'OKPAY'; break;
								case 3: $purse_type = 'QIWI'; break;
								case 4: $purse_type = 'BitCoin'; break;
								case 5: $purse_type = 'Paxum'; break;
								case 6: $purse_type = 'WebMoney'; break;
								case 7: $purse_type = 'Яндекс.Деньги'; break;
								case 8: $purse_type = 'RBK Money'; break;
								case 9: $purse_type = 'W1'; break;
								case 10:$purse_type = 'Мегафон(РОССИЯ)'; break;
								case 11:$purse_type = 'Билайн(РОССИЯ)'; break;
								case 12:$purse_type = 'МТС(РОССИЯ)'; break;
							}
							

						?>
							<tr align="center">
                            	<td><?=$w['id']; ?></td>
                                <td><?=$w['login']; ?></td>
                                <td><?=$w['summa']; ?></td>
                                <td><?=$purse_type; ?></td>
                                <td><?=$w['purse_number']; ?></td>
                                <td><?=date("d.m.Y в H:i:s", $w['date']); ?></td>
                                <td><a href="/wall/user/<?=$w['user_id']; ?>" target="_blank"><img src="/adminka/img/icons/page_white_link.png" title="Перейти на стену пользователя" /></a>
								<a href="/adminka/vivod/read/<?=$w['id']; ?>"><img src="/adminka/img/icons/page_white_edit.png" title="Выплачено" /></a>
								<a href="/adminka/vivod/dell/<?=$w['id']; ?>"><img src="/adminka/img/icons/page_white_delete.png" title="Отменить" /></a></td>
                               
                            </tr>
						<?php } }?>
						</tbody>
					</table>
					
					<?php
					// Проверяем нужны ли стрелки назад  
if ($page != 1) $pervpage = '<a href= /adminka/vivod/str/1><<</a>  
                               <a href= /adminka/vivod/str/'. ($page - 1) .'><</a> ';  
// Проверяем нужны ли стрелки вперед  
if ($page != $total) $nextpage = ' <a href= /adminka/vivod/str/'. ($page + 1) .'>></a>  
                                   <a href= /adminka/vivod/str/' .$total. '>>></a>';  

// Находим две ближайшие станицы с обоих краев, если они есть  
if($page - 2 > 0) $page2left = ' <a href= /adminka/vivod/str/'. ($page - 2) .'>'. ($page - 2) .'</a> | ';  
if($page - 1 > 0) $page1left = '<a href= /adminka/vivod/str/'. ($page - 1) .'>'. ($page - 1) .'</a> | ';  
if($page + 2 <= $total) $page2right = ' | <a href= /adminka/vivod/str/'. ($page + 2) .'>'. ($page + 2) .'</a>';  
if($page + 1 <= $total) $page1right = ' | <a href= /adminka/vivod/str/'. ($page + 1) .'>'. ($page + 1) .'</a>'; 

// Вывод меню  
echo '<center>'.$pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage.'</center>';  
					?>
  </div>