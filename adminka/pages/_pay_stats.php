	<div id="rightnow">

				   <div id="box">
                	<h3 id="adduser">Статистика игры</h3>
					
					     </div> 
						 
						 
						<table align="center">
					
					<tr>
					<td>Пользователь</td> <td>Дата</td> <td>Сумма</td>
					</tr>
					
					
<?php

			$table 	= 'tb_pay_stats';
			$strSQL = "SELECT * FROM ".$table;
			$rs		= mysql_query($strSQL);
			while($row = mysql_fetch_array($rs)){
				echo '<tr><td>'.$row['user'].'</td>'.'<td>'.$row['date'].'</td>'.'<td>'.$row['amount'].'</td></tr>';
			}	
		

			
?>
					
			
					
					</table>
			  </div>