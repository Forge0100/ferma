
<? if (isset($_SESSION['id'])) { 

?>


<div class="server-status-box auth" style="padding: 7%;">

<div id="menu3">
<ul>
<li>
<h3 style="color: #fff;margin-bottom: 5px;">АККАУНТ <h3>
</li>
<li>
<a class="menubtn" style="margin-left: 10px;float: left;padding: 5px 5px;color:#fff;margin-bottom: 10px;" href="/logout.php">Выход</a>
</li>
</ul>
</div>
<br>
<br>

						<script type="text/javascript">
jQuery(document).ready(function(){
setInterval("jQuery('#loadBA').load('#div #loadGA');",60000); //У меня интервал обновления блока - минута
});
</script>
<div id="loadBA"><div id="loadGA">

	<table style="width:100%;float: right;margin-bottom: 15px;">
	<tr>
	<td style="width:30%;">
								<?php
								if($us_data['ava'] != '') {$ava = $us_data['ava'];}
								else {$ava = 'images/noavatar.png';}
								?>
									<a href="/wall/" title="Перейти на стену"><img src="/<?=$ava;?>" style="
    box-shadow: 0px 0px 10px 1px #502e24;
    margin: -10%;
" width="100" height="85" alt="" title=""></a>
	</td>
	<td style="width:100%;">	
						
						<b style="color:#fff;">Добро пожаловать!</b>  
						<br>
						<b style="color:#fff;"><?=$login; ?></b><img src="/images/<?=$pol_u;?>" title="Ваш пол <?=$tile;?>!" alt=""><a href="/pm/"><img title="Написать сообщение!" src="<?php $pim = mysql_num_rows(mysql_query("SELECT * FROM tb_pm_in WHERE user_id_1 = '$usid' AND status = 0")); if ($pim>0) echo '/images/mail1.png'; else echo '/images/mail0.png'; ?>" alt=""></a>
						<br>
						<b style="color:#fff;">Ваш уровень:</b> <b style="color:#fff;"><?=$us_data['level']; ?></b>
						<br>
						

						
	</td>
	</tr>
	</table>
	

								<br>
								
								<ul>
								<li style="color:#fff;width: 50px;">&nbsp;&nbsp;&nbsp;Опыт: </li>
								<li>
									<div id="progressbar" style="margin-top: -1px; left: 25px;" title="Опыт <?=$us_data['reyting']; ?> из <?=$opit; ?>">
									 <span style="top: -1px;" id="percent"><?=$us_data['reyting']; ?>/<?=$opit; ?></span>
										<div id="bar" style="width: <?php echo 100 / ($opit)* $us_data['reyting']; ?>?;"></div>
									</div>
								</li>
								</ul>
								<div class="clear"></div>
								
								<br>
								
									<ul>
										<li style="color:#fff;width: 50px;">&nbsp;&nbsp;&nbsp;Энергия: </li>
										<li>
											<div id="progressbar" style="margin-top: 1px; left: 25px;" title="Энергия <?=$us_data['energy']; ?> из <?=$energy; ?>">
												<span style="top: -1px;" id="percent"><?=$us_data['energy']; ?></span>
												<div id="bar2" style="width: <?php echo 100 /$energy * $us_data  ['energy'] ; ?>?;"></div>
											</div>
										</li>
									</ul>
									<div class="clear"></div>
								
								<br>

								<b style="color:#fff;">&nbsp;&nbsp;&nbsp;Баланс&nbsp;для&nbsp;оплаты:&nbsp;<?=$us_data['money']; ?>&nbsp;р</b> 
								<br><br>
								<b style="color:#fff;">&nbsp;&nbsp;&nbsp;Баланс&nbsp;для&nbsp;вывода:&nbsp;<?=$us_data['money_out']; ?>&nbsp;р</b> 
								<br>
								</div>
								</div>
								
								<div class="clear"></div>
										

					</div>
					
					
					
		

<? } else {

Header("Location: /");
}?>
