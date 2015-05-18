<h1>Биржа опыта</h1>

<?php
	if(isset($_POST['post']))
	{
		$type = $_POST['type'];
		$type_count = $_POST['type_count'];
		$energy = $_POST['energy'];
		$exp = $_POST['exp'];
		$sql = mysql_query("select * from tb_exchange limit 1");
		if(mysql_num_rows($sql) > 0)
		{
			mysql_query("update tb_exchange set type = '$type', type_count = '$type_count', energy = '$energy', exp = '$exp'");
		}
		else
		{
			mysql_query("insert into tb_exchange (type, type_count, energy, exp) values ('$type', '$type_count', '$energy', '$exp')");
		}
	}
	
	$sql = mysql_fetch_assoc(mysql_query("select * from tb_exchange limit 1"));
?>
<form action="/adminka/exchange" method="post">
	<table style="width: 100%;">
		<tr>
			<td>Ресурс</td>
			<td>
				<select name="type">
					<option <?php echo ($sql['type'] == 'yaco_per') ? 'selected' : ''; ?> value="yaco_per">Яйцо</option>
					<option <?php echo ($sql['type'] == 'myaso_per') ? 'selected' : ''; ?> value="myaso_per">Мясо</option>
					<option <?php echo ($sql['type'] == 'm_o_per') ? 'selected' : ''; ?> value="m_o_per">Молоко козы</option>
					<option <?php echo ($sql['type'] == 'm_k_per') ? 'selected' : ''; ?> value="m_k_per">Молоко коровы</option>
					<option <?php echo ($sql['type'] == 'testo_per') ? 'selected' : ''; ?> value="testo_per">Тесто</option>
					<option <?php echo ($sql['type'] == 'farsh_per') ? 'selected' : ''; ?> value="farsh_per">Фарш</option>
					<option <?php echo ($sql['type'] == 'sir_per') ? 'selected' : ''; ?> value="sir_per">Сыр</option>
					<option <?php echo ($sql['type'] == 'smetana_per') ? 'selected' : ''; ?> value="smetana_per">Творог</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Количество ресурса</td>
			<td><input name="type_count" type="text" value="<?php echo $sql['type_count']; ?>" /></td>
		</tr>
		<tr>
			<td>Количество энергии</td>
			<td><input name="energy" type="text" value="<?php echo $sql['energy']; ?>" /></td>
		</tr>
		<tr>
			<td>Количество опыта</td>
			<td><input name="exp" type="text" value="<?php echo $sql['exp']; ?>" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="post" value="Добавить" /></td>
		</tr>
	</table>
</form>
