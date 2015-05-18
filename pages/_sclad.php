<center>  <div class="tegname"><h2>Склад</h2></div><br> </center>
<?php
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
$page = 'Склад';
?>
<p>
<h3>На вашем складе хранится:</h3>
	<br>
	<b>Корм для животных в продукции:</b><br>
	Корм кур: <?=$us_data['pshenica']; ?> шт.<br>
	Корм бычков: <?=$us_data['kukurudza']; ?> шт.<br>
	Корм коз: <?=$us_data['jachmen']; ?> шт.<br>
	Корм коров: <?=$us_data['svekla']; ?> шт.<br>
	
	
	<b>Продуктов для продажи:</b> <br>
	Яйцо: <?=$us_data['yaco']; ?> шт.<br>
	Мясо: <?=$us_data['myaso']; ?> шт.<br>
	Молоко козы: <?=$us_data['m_o']; ?> шт.<br>
	Молоко коровы: <?=$us_data['m_k']; ?> шт.<br>
	
	Тесто: <?=$us_data['testo']; ?> шт.<br>
	Фарш: <?=$us_data['farsh']; ?> шт.<br>
	Сыр: <?=$us_data['sir']; ?> шт.<br>
	Творог: <?=$us_data['smetana']; ?> шт.<br>
	
	<a href="/lavka/">Продать в ярмарке</a><br><br>
	
	<b>Продуктов для переработки:</b> <br>
	Яйцо: <?=$us_data['yaco_per']; ?> шт.<br>
	Мясо: <?=$us_data['myaso_per']; ?> шт.<br>
	Молоко козы: <?=$us_data['m_o_per']; ?> шт.<br>
	Молоко коровы: <?=$us_data['m_k_per']; ?> шт.<br>
	
	Тесто: <?=$us_data['testo_per']; ?> шт.<br>
	Фарш: <?=$us_data['farsh_per']; ?> шт.<br>
	Сыр: <?=$us_data['sir_per']; ?> шт.<br>
	Творог: <?=$us_data['smetana_per']; ?> шт.<br>
	<a href="/lavka/">Купить в ярмарке</a><br><br>
	
	<b>Пирогов для продажи:</b> <br>
Пирог с мясом: <?=$us_data['blin_myaso_by']; ?> шт.<br>
Пирог с сыром: <?=$us_data['blin_sir_by']; ?> шт.<br>
Пирог с творогом: <?=$us_data['blin_smetana_by']; ?> шт.<br>
<a href="/blinaya/">Продать в пироговой</a><br><br>
<b>Пирогов для употребления:</b> <br>
Пирог с мясом: <?=$us_data['blin_myaso']; ?> шт.<br>
Пирог с сыром: <?=$us_data['blin_sir']; ?> шт.<br>
Пирог с творогом: <?=$us_data['blin_smetana']; ?> шт.<br>
<a href="/blinaya/">Покушать в пироговой</a></p><br><br>