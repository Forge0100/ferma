<center> <div class="tegname"><h2>Биржа опыта</h2></div><br> </center>
<?php
	$recept = $db->getRow("select * from tb_exchange limit 1");
	
	if(isset($_POST['post_yes']) && $_POST['post_yes'] == 'Да')
	{
		if($us_data[$recept['type']] >= $recept['type_count'])
		{
			if($us_data['energy'] >= $recept['energy'])
			{
				$type = $recept['type'];
				$type_count = $recept['type_count'];
				$energy = $recept['energy'];
				$exp = $recept['exp'];
				
				$db->query("update tb_users set ?n = ?n - ?i, energy = energy - ?i, reyting = reyting + ?i  where id = ?i", $type, $type, $type_count, $energy, $exp, $usid);
				
				$row = $db->getRow("SELECT `id`, `level`, `reyting` FROM `tb_users` WHERE `id` = ?i", $usid);
				$user_id = $row['id'];
				$level = $row["level"];
				$rating = $row["reyting"];
				
				if($lvlup = IsLevelUp($level, $rating, $user_id)) 
				{
					$islvlup = "Поздравляем вы перешли на уровень ($lvlup)";
				}
				
				$message['type'] = 'success';
				$message['text'] = 'Поздравляем! Обмен прошел успешно!';
			}
			else
			{
				$message['type'] = 'error';
				$message['text'] = 'Не достаточно энергии';
			}
		}
		else
		{
			$message['type'] = 'error';
			$message['text'] = 'Не достаточно ресурсов';
		}
	}
	
	switch($recept['type'])
	{
		case 'per_yaco' :
			$product = 'яйцо';
			$product_more = 'яиц';
			break;
		case 'per_myaso' :
			$product = 'мясо';
			$product_more = 'мяса';
			break;
		case 'm_o_per' :
			$product = 'молоко козы';
			$product_more = 'молока козы';
			break;
		case 'm_k_per' :
			$product = 'молоко коровы';
			$product_more = 'молока коровы';
			break;
		case 'testo_per' :
			$product = 'тесто';
			$product_more = 'теста';
			break;
		case 'farsh_per' :
			$product = 'фарш';
			$product_more = 'фарша';
			break;
		case 'sir_per' :
			$product = 'сыр';
			$product_more = 'сыра';
			break;
		case 'smetana_per' :
			$product = 'творога';
			$product_more = 'яиц';
			break;
	}
?>
<style>
p { margin: 0; padding: 0; margin-top: 5px; }
.block-digit {
	width: 50px; 
	border: 1px solid blue; 
	padding: 5px 20px; 
	text-align: center; 
	border-radius: 6px;
	margin-top: 5px;
}
</style>

<div style="color: blue;">
<?php if(isset($_POST['post'])) : ?>
<form method="post">
	<input style="cursor:pointer; border: 1px solid black; padding: 5px 20px;" name="post_yes" type="submit" value="Да" />
	<input style="cursor:pointer; border: 1px solid black; padding: 5px 20px;" name="post_yes" type="submit" value="Нет" />
</form>
<?php else : ?>
<p>На бирже опыта Вы можете обменять купленную продукцию и энергию на опыт.</p>
<p>На данный момент можно обменять <?php echo $product; ?> на опыт</p>
<br>
<p>У вас в наличии <?php echo $product_more; ?>: <?php echo $us_data[$recept['type']]; ?> ед.</p>
<p>Курс обмена: <?php echo $recept['type_count']; ?> продукт и <?php echo $recept['energy']; ?> энергии = <?php echo $recept['exp']; ?> опыта.</p>
<h3>Обменять продукты на опыт</h3>
<p><b>Количество <?php echo $product_more; ?></b></p>
<div class="block-digit"><?php echo $recept['type_count']; ?></div>
<p><b>Снимется энергии</b></p>
<div class="block-digit"><?php echo $recept['energy']; ?></div>
<p><b>Получение опыта</b></p>
<div class="block-digit"><?php echo $recept['exp']; ?></div>
<br>
<form method="post">
	<input class="menubtn" name="post" type="submit" value="Обменять" />
</form>
<?php endif; ?>
</div>

<?php if($message) : ?>	
<script src="/js/jquery.noty.packaged.min.js" type="text/javascript"></script>
<script> var n; $.noty.closeAll(); n = noty({text: '<b><?php echo $message['text']; ?></b>', type: '<?php echo $message['type']; ?>'}); </script>		
<?php endif; ?>	

<?php if($islvlup) : ?>	
<link rel="stylesheet" href="/simplemodal/demo.css?v=2">
<script type="text/javascript" src="/simplemodal/demo.js"></script>
<div class="overlay-container">
		<div class="window-container zoomin">
			<h3><?php echo $islvlup; ?></h3> 
			<div align=center>

				<span class="closeWindow">Закрыть</span>
			</div>
		</div>
	</div>		
<?php endif; ?>	