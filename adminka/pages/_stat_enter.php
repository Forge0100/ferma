  
  	<div id="rightnow">

				   <div id="box">
                	<h3 id="adduser">Статистика пополнений</h3>
					
					     </div> 
  
  <table>
						<thead>
							<tr>
                            	<th>ID</th>
                                <th>Логин</th>
                                <th>Сумма</th>
                                <th>Система</th>
                                <th>Дата</th>

                            </tr>
						</thead>
						<tbody>
						<?php
$num = 20;  
$page = intval($_GET['str']);  
$result = mysql_query("SELECT COUNT(*) FROM tb_enter WHERE status = 2");  
$posts = mysql_result($result, 0);  
$total = intval(($posts - 1) / $num) + 1;  
$page = intval($page);  
if(empty($page) or $page < 0) $page = 1;  
  if($page > $total) $page = $total;  
$start = $page * $num - $num;  
						$q = mysql_query("SELECT * FROM tb_enter WHERE status = 2 ORDER BY id DESC LIMIT $start, $num") or die(mysql_error());
						if(mysql_num_rows($q) == 0) {
						echo '<tr><td colspan="4">Пополнений еще не было</td></tr>';
						}else {
						while($w = mysql_fetch_assoc($q)) {
						?>
							<tr align="center">
                            	<td><?=$w['id']; ?></td>
                                <td><?=$w['login']; ?></td>
                                <td><?=$w['summa']; ?></td>
                                <td><?=$w['purse']; ?></td>
                                <td><?=date("d.m.Y в H:i:s", $w['date']); ?></td>
                               
                            </tr>
						<?php } }?>
						</tbody>
					</table>
					
					<?php
					// Проверяем нужны ли стрелки назад  
if ($page != 1) $pervpage = '<a href= /adminka/stat_enter/str/1><<</a>  
                               <a href= /adminka/stat_enter/str/'. ($page - 1) .'><</a> ';  
// Проверяем нужны ли стрелки вперед  
if ($page != $total) $nextpage = ' <a href= /adminka/stat_enter/str/'. ($page + 1) .'>></a>  
                                   <a href= /adminka/stat_enter/str/' .$total. '>>></a>';  

// Находим две ближайшие станицы с обоих краев, если они есть  
if($page - 2 > 0) $page2left = ' <a href= /adminka/stat_enter/str/'. ($page - 2) .'>'. ($page - 2) .'</a> | ';  
if($page - 1 > 0) $page1left = '<a href= /adminka/stat_enter/str/'. ($page - 1) .'>'. ($page - 1) .'</a> | ';  
if($page + 2 <= $total) $page2right = ' | <a href= /adminka/stat_enter/str/'. ($page + 2) .'>'. ($page + 2) .'</a>';  
if($page + 1 <= $total) $page1right = ' | <a href= /adminka/stat_enter/str/'. ($page + 1) .'>'. ($page + 1) .'</a>'; 

// Вывод меню  
echo '<center>'.$pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage.'</center>';  
					?>
  </div>