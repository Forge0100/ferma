<center> <div class="tegname"><h2>Рекламные материалы</h2></div><br> </center>
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
$page = 'Реферальные ссылки';
?>

<p class="align-right">
Лучше получать по 1% от усилий 100 человек,<br />
чем 100% только от своих собственных усилий.<br />
<i>J. Paul Getty</i></p>
 Ваша ссылка для привлечения друзей (рефералов)<br />
 <input onclick="this.select()" type="text" value="http://<?=$_SERVER['HTTP_HOST'];?>/?rid=<?=$_SESSION['id']; ?>" size="60"/><br><br>
 Ссылка для привлечения с odnoklassniki.ru:<br>
  <input onclick="this.select()" type="text" value="http://<?=$_SERVER['HTTP_HOST'];?>/?rid=<?=$_SESSION['id']; ?>" size="60"/><br><br>
 
  <b>Баннеры 100х100 px</b><br /><br />
1.<img src="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner100.gif"><br />
Ссылка на баннер<br />
<input onclick="select()" type="text" value="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner100.gif" size="60"/><br /><br />
Полный код баннера<br />
<textarea readonly rows="5" onclick="select()" cols="46">
<a href="http://<?=$_SERVER['HTTP_HOST'];?>/?rid=<?=$_SESSION['id']; ?>"><img src="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner100.gif"></a>
</textarea>
 <br />
2.<img src="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner100_2.gif"><br />
Ссылка на баннер<br />
<input onclick="select()" type="text" value="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner100_2.gif" size="60"/><br /><br />
Полный код баннера<br />
<textarea readonly rows="5" cols="46" onclick="select()">
<a href="http://<?=$_SERVER['HTTP_HOST'];?>/?rid=<?=$_SESSION['id']; ?>"><img src="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner100_2.gif"></a>
</textarea>
 <br />
3.<img src="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner100_3.gif"><br />
Ссылка на баннер<br />
<input onclick="select()" type="text" value="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner100_3.gif" size="60"/><br /><br />
Полный код баннера<br />
<textarea readonly rows="6" cols="46" onclick="select()">
<a href="http://<?=$_SERVER['HTTP_HOST'];?>/?rid=20248"><img src="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner100_3.gif"></a>
</textarea>
 <br />
 <b>Баннеры 468x60 px</b><br /><br />
1.<img src="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner468_3.jpg"><br />
Ссылка на баннер<br />
<input onclick="select()" type="text" value="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner468_3.jpg" size="60"/><br /><br />
Полный код баннера<br />
<textarea readonly rows="5" cols="46" onclick="select()">
<a href="http://<?=$_SERVER['HTTP_HOST'];?>/?rid=20248"><img src="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner468_3.jpg"></a>
</textarea>
<br />
2.<img src="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner468_2.gif"><br />
Ссылка на баннер<br />
<input onclick="select()" type="text" value="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner468_2.gif" size="60"/><br /><br />
Полный код баннера<br />
<textarea readonly rows="5" cols="46" onclick="select()">
<a href="http://<?=$_SERVER['HTTP_HOST'];?>/?rid=20248"><img src="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner468_2.gif"></a>
</textarea>
<br />
3.<img src="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner.gif"><br />
Ссылка на баннер<br />
<input onclick="select()" type="text" value="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner.gif" size="60"/><br /><br />
Полный код баннера<br />
<textarea readonly rows="5" cols="46" onclick="select()">
<a href="http://<?=$_SERVER['HTTP_HOST'];?>/?rid=<?=$_SESSION['id']; ?>"><img src="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner.gif"></a>
</textarea>
<br />
5.<img src="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner468.gif"><br />
Ссылка на баннер<br />
<input onclick="select()" type="text" value="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner468.gif" size="60"/><br /><br />
Полный код баннера<br />
<textarea readonly rows="5" cols="46" onclick="select()">
<a href="http://<?=$_SERVER['HTTP_HOST'];?>/?rid=<?=$_SESSION['id']; ?>"><img src="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner468.gif"></a>
</textarea>
<br />
<b>Баннеры 200x300 px</b><br /><br />

1.<img src="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner200x300.gif"><br />
Ссылка на баннер<br />
<input onclick="select()" type="text" value="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner200x300.gif" size="60"/><br /><br />
Полный код баннера<br />
<textarea readonly rows="5" cols="46" onclick="select()">
<a href="http://<?=$_SERVER['HTTP_HOST'];?>/?rid=<?=$_SESSION['id']; ?>"><img src="http://<?=$_SERVER['HTTP_HOST'];?>/reflink/banner200x300.gif"></a>
</textarea>