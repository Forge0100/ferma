 <center>  <div class="tegname"><h2>Вывод средств</h2></div><br>  </center>
<?php
if(!isset($_SESSION['id']) and !isset($_SESSION['login'])) {

print "<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">

<script language=\"javascript\">top.location.href=\"/\";</script>
<title>Перенаправление</title>
</head>
<body bgcolor=\"#eeeeee\" topmargin=\"0\" leftmargin=\"0\">

</body>
</html>";
exit;
}
$page = 'Вывод средств';
?>
<script language="javascript">
			var percent;
			var celoe;
			var drob;
			var res;
			function okrugl(numsr)
			{
				if(numsr<10){percent = 95;}else
				if(numsr<100){percent = 98;}else
				if(numsr<1000){percent = 99;}else
				if(numsr>=1000){percent = 100;}
				
				nums = numsr*percent/100;
				
				celoe=Math.floor(nums);
				
				drob=(nums-celoe)*100;
				drob=Math.floor(drob);
				if(drob>=10)
				{
					res=celoe+'.'+drob;
				}else{
					res=celoe+'.0'+drob;
				}
				return res;
			}

			function getZakaz(frm)
			{
				frm.summa.value=okrugl(frm.money.value);
			}
			</script>
			<style>
			.custom{
				width: 250px!important;
			}
			</style>
			<?php

			

$rsad = $db->getOne("SELECT SUM(summa_full) AS sum_v FROM tb_vivod WHERE status = 1");
$rrssa = $db->getOne("SELECT SUM(summa) AS sum_p FROM tb_enter WHERE status = 2");

?>
		

							<p>
							Комиссия за вывод средств зависит от суммы вывода (не меньше 0.01 руб.):<br>
							Сумма от 0.01 руб до 9.99 руб - комиссия 5% <br>
							Сумма от 10.00 руб до 99.99 руб - комиссия 2% <br>
							Сумма от 100.00 руб до 999.99 руб - комиссия 1%<br>
							Сумма от 1000.00 руб и выше - комиссия 0% <p>
							

							
							<b>Для вывода на кошелек <a href="http://payeer.com/">Payeer</a> вам нужно зарегистрировать кошелек в системе <a href="http://payeer.com/">Payeer</a>, если его у вас нет.</b>
<br><p>
							При выводе средств снимается энергия, за каждые 10 руб 1 ед энергии. Минимум - 1 ед энергии.</p><br>
							
																
																
<?php
if(isset($_POST['save'])) {
	
	$purse = sf($_POST['purse']);
	$sum = sprintf("%01.2f", str_replace(',', '.', $_POST['money']));
	$plat_pass = intval($_POST['pay_pass']);
		if($sum >= 0.01 and $sum <= 9.99) {
		$sump = $sum - ($sum * 0.05);
		}elseif($sum >= 10 and $sum <= 99.99) {
		$sump = $sum - ($sum * 0.02);
		}elseif($sum >= 100 and $sum <= 999.99) {
		$sump = $sum - ($sum * 0.01);
		}elseif($sum >= 1000 and $sum <= 100000) {
		$sump = $sum;
		}
		if($sum >= 10) {
		$ener = intval($sum / 10);
		}else{
		$ener = 1;
		}
	
		
		$purseType = intval($_POST['ps']);
		/*
			1 Payeer
			2 OKPAY
			3 QIWI
			4 BitCoin
			5 Paxum
			6 WebMoney
			7 Яндекс.Деньги
			8 RBK Money
			9 W1
			10 Мегафон(РОССИЯ)
			11 Билайн(РОССИЯ)
			12 МТС(РОССИЯ)
		*/
			
		/*if($type == 1){$purseType = "Payeer";}
		else if($type == 2){$purseType 	= "OKPAY";}
		else if($type == 3){$purseType 	= "QIWI";}
		else if($type == 4){$purseType 	= "BitCoin";}
		else if($type == 5){$purseType 	= "Paxum";}
		else if($type == 6){$purseType 	= "WebMoney";}
		else if($type == 7){$purseType 	= "Яндекс.Деньги";}
		else if($type == 8){$purseType 	= "RBK Money";}
		else if($type == 9){$purseType 	= "W1";}
		else if($type == 10){$purseType = "Мегафон(РОССИЯ)";}
		else if($type == 11){$purseType	= "Билайн(РОССИЯ)";}
		else if($type == 12){$purseType = "МТС(РОССИЯ)";}
		*/
	#if($sum <= $rrssa['sum_p'] - $rsad['sum_v']){
		if(!empty($plat_pass)) {
		
				if(!empty($purse)) {
					if($sum >= 0.1) {
						if($plat_pass){
						#if($plat_pass == $us_data['plat_pass']){
							if(time() >= $us_data['date_plat_pass']) {
							  if($us_data['energy'] >= $ener) {
								if($sum <= $us_data['money_out']){
									mysql_query("INSERT INTO tb_vivod (user_id, login, summa, summa_full, purse_number,purse_type, ps, date, status) VALUES ('$usid', '$login', '$sump', '$sum', '$purse','$purseType','0', '".time()."', '0')") or die(mysql_error());
									mysql_query("UPDATE tb_users SET money_out = money_out - '$sum', energy = energy - '$ener' WHERE id = '$usid'");
									echo '<br><center><font color="green">Заявка на выплату отправлена! В течении 2-х суток выплата будет сделана</font></center>';
									Header("Refresh: 1, /vivod");
									return;
								}else echo '<br><center><font color="red">Не достаточно средств на балансе</font></center>';
							  }else echo '<br><center><font color="red">Недостаточно энергии! Покушайте блинчик!</font></center>';
							}else echo '<br><center><font color="red">Платежный пароль еще не действителен! Еще не прошло 7 дней после его смены!</font></center>';
						}else echo '<br><center><font color="red">Не верный платежный пароль</font></center>';
						}else echo '<br><center><font color="red">Минимум для вывода 0.1</font></center>';
					}else echo '<br><center><font color="red">Укажите кошелек</font></center>';
	
			}else echo '<br><center><font color="red">Введите платежный пароль</font></center>';
	#}else echo '<br><center><font color="red">zaaaaaaaaaaa</font></center>';
																
																
}


if(isset($_POST['dell'])) {
$id = intval($_POST['id']);
$e = mysql_query("SELECT * FROM tb_vivod WHERE id = '$id' AND user_id = '$usid'");
if(mysql_num_rows($e) == 0) {
echo 'Это не ваша заявка';
}else{
$r = mysql_fetch_assoc($e);
if($r['user_id'] == $usid) {
mysql_query("UPDATE tb_users SET money_out = money_out + '".$r['summa_full']."' WHERE id = '".$r['user_id']."'");
mysql_query("UPDATE tb_vivod SET status = 2 WHERE id = '".$r['id']."'");
echo 'Заявка отменена!';
Header("Refresh: 2, /vivod");
}
}

}
?>
														
<style>
.buttonssilka {
color: #502e24;
text-decoration: underline;	
cursor: pointer;
font-size: 12px;
}

.buttonssilka:hover {
color: #8e4733;
text-decoration: none;
cursor: pointer;
font-size: 12px;
}
</style>															
																
											<br>					
									<form method="post" action="">
									<p>Укажите сумму ( макс. <?=$us_data['money_out']; ?> руб. ):<br>(разделитель "." Например: 1.57)</p>
									<p><input style="width:45%;" type="text" size="5" placeholder="Сумма вывода" name="money" onChange="getZakaz(this.form)" onkeyup="getZakaz(this.form)" maxlength="10" value="0.00"></p>
									
									<p><input style="width:45%;" type='text' size='5' maxlength='20' placeholder="Вы получите:" readonly='readonly' id='summa' name='summa' value="0.00"></p>
									
									
									<p><input style="width:45%;" type='text' maxlength='20' placeholder="Кошелек:" name='purse' value=""></p>
									

									<p><input style="width:45%;" type="text" size="15" value="" placeholder="Платежный пароль" maxlength="4" name="pay_pass"><a style="margin-left:13px;" class="tooltip" href="javascript:void(0)">[?]<span class="custom help" style="width: 450px;"><em>Платежный пароль</em>Можно получить/восстановить в раздел Пользователь -> Профиль.</span></a></p>
									<label></label>
									

	<p>
		
		<label></label>
		<p style="margin-left:13px;">Кошелек:
		<select name="ps">
			<option value="1">Payeer
			<option value="2">QIWI
			<option value="3">WebMoney
			<option value="4">Яндекс.Деньги
			<option value="5">Мегафон(РОССИЯ)
			<option value="6">Билайн(РОССИЯ)
			<option value="7">МТС(РОССИЯ)
		</select>
	</p>
	


									<input type="submit" name="save" value="Вывести средства »" class="menubtn"> 
									</form>
									<br><br>
									<br><p>Последние 10 выплат. ВНИМАНИЕ при отмене выплаты, деньги вернутся на баланс для оплаты!</p><br>							
									<table style="width:100%;">
							<tr style="background-color:#0066FF!important">
								<th width="100" align='center'><font color="#FFFFFF">Сумма (руб)</font></th>
								<th width="150" align='center'><font color="#FFFFFF">Дата</font></th>
								<th width="60" align='center'><font color="#FFFFFF">Кошелек</font></th>
								<th width="150" align='center'><font color="#FFFFFF">Статус</font></th>
							</tr>
							<?php
							$q = mysql_query("SELECT * FROM tb_vivod WHERE user_id = '$usid' ORDER BY id DESC LIMIT 10");
							if(mysql_num_rows($q) == 0) {
							echo '<tr><td colspan="4">Выплат еще не было</td></tr>';
							
							}else{
							while($w = mysql_fetch_assoc($q)) {
							
							if($w['status'] == 0) {
							$st = '
							<form method="post" action="">
							<input type="hidden" name="id" value="'.$w['id'].'">
							<input type="submit" name="dell" class="buttonssilka" value="Отменить">
							</form>
							';
							}elseif($w['status'] == 1) {
							$st = 'Выплата сделана';
							$color = 'green';
							
							}elseif($w['status'] == 2){
							$st = 'Выплата отменена';
							$color = 'red';
							}
							?>
							<tr style="background-color:#FFFFFF">
								<td align='center'><?=$w['summa']; ?> руб</td>
								<td align='center'><?=date("d.m.Y в H:i:s", $w['date']); ?></td>
								<td align='center'><?=$w['purse_number']; ?></td>
								<td align='center'><font color='<?=$color; ?>'><?=$st; ?></font></td>
							</tr>
							
							<?php } }?>
							</table>
							<br> 
	<div id="formsgifts" style="display: none"></div>