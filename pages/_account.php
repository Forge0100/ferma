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
$page = 'Аккаунт';
?>
<div class="tegname"><h2>Аккаунт пользователя</h2></div>
<br>
<h3>Основные данные</h3>
<p>
<b>Дата и время регистрации</b>: <?=date("d.m.Y", $us_data['date_reg']); ?>г. в <?=date("H:i", $us_data['date_reg']); ?><br />
<b>Дата и время последнего входа</b>: <?=date("d.m.Y", $us_data['date_login']); ?>г. в <?=date("H:i", $us_data['date_login']); ?><br />
<b>Ip регистрации</b>: <?=$us_data['ip_reg']; ?> <br />
<b>Последний ip</b>: <?=$us_data['ip_login']; ?> <br />
<b>Текуший ip</b>: <?=$_SERVER['REMOTE_ADDR']; ?> <br />
<b>Ваша страна</b>: RU<br />
<b>Баланс для оплаты:</b>: <?=$us_data['money']; ?> руб.   <a href="/popoln/"><b>Пополнить</b></a> <a href="/perevod/"><b>Перевести средства</b></a><br />
<b>Баланс для вывода:</b>: <?=$us_data['money_out']; ?> руб. <a href="/vivod/"><b>Вывести</b></a><br />
<b>Выведено</b>: <?=$us_data['pay_money']; ?> руб.<br /><br />
</p><h3>Ваша ферма</h3>
<p>
<a href="/rinok">Купить животных</a><br />
<a href="/pole">Посеять поле</a><br />
<a href="/newproduct">Продукция</a><br />
<a href="/fabrika">Фабрика продуктов</a><br />
<a href="/fabrika_blincik">Фабрика Блинчиков</a><br />
<a href="/lavka">Лавка</a><br />
<a href="/blinaya">Блинная</a><br />
<a href="/sclad">Ваш склад</a><br />
</p><h3>Соседи</h3>
<p>
<a href="/reflink/">Материалы для привлечения друзей</a><br />
<a href="/referals/">Список друзей</a><br />
</p><h3>Чат</h3>
<p>
<a href="/chat/">Общаться в чате</a><br />
</p>
	
	 
	<div id="formsgifts" style="display: none"></div>