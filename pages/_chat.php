<center> <div class="tegname"><h2>Чат фермы</h2></div><br> </center>
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
$page = 'Чат';
require_once($_SERVER['DOCUMENT_ROOT']."/chat/option.php");
?>
<style>
td {
border: 0px solid #FFFFFF;
color: #177ADA;
text-align: center;
vertical-align: middle;
padding: 0px 0px 0px 0px;
}

.cnop65666512150 {
background: #69B8F0;
border: 1px solid #420303;
font-weight: bold;
font-family: Verdana, Geneva, sans-serif;
color: #fff;
font-size: 13px;
cursor: pointer;
padding: 3px 3px 3px 3px;
height: 30px;
}

.cnop65666512150:hover {
background: #6984F0;
border: 1px solid #420303;
font-weight: bold;
font-family: Verdana, Geneva, sans-serif;
color: #fff;
font-size: 13px;
cursor: pointer;
padding: 3px 3px 3px 3px;
height: 30px;
}
</style>
<script type="text/javascript" language="JavaScript"> 
			function disp_id(objId){
					if(document.getElementById(objId).style.display == '')
							document.getElementById(objId).style.display = 'none';
					else document.getElementById(objId).style.display = '';
					return false;
			}
		</script>

<link rel="stylesheet" type="text/css" media="screen,projection,print" href="/css/chat.css" />
<fieldset>

<b>Пользователь, с <font color='#ff0000'>красным</font> цветом ника - Администратор<br />
		Пользователь, с <font color='green'>зеленым</font> цветом ника - Модератор</b><br />
<div style="padding:3px;">&nbsp;</div>
<script type="text/javascript" src="/chat/js/jquery.js"></script>
<script type="text/javascript" src="/chat/js/chat.js"></script>
<table align="center" style="width:99%;border-collapse: collapse;">
<tr>
<td style="width:75%;background: #FFF;
border-radius: 9px;">
<div align="center" class="chatmess">
<div align="center" style="font-size:11px; border-bottom: 1px solid #000;"><b>Переписка</b></div>
<script type="text/javascript">
jQuery(document).ready(function(){
setInterval("jQuery('#chatq').load('#div #chatw');",3000000); //У меня интервал обновления блока - минута
});
</script>
<script type="text/javascript">
jQuery(document).ready(function(){
setInterval("jQuery('#chatqonline').load('#div #chatwonline');",3000000); //У меня интервал обновления блока - минута
});
</script>
<div id="chatq"><div id="chatw">
<div id="chat_mess">
</div></div>
</div>
</div>
</td>
<td style="width:25%;background: #FFF;
border-radius: 9px;">
<div align="center" class="chatonline">
<div align="center" style="font-size:11px;color: #03A51E;"><b>online</b></div>
<div id="chatqonline"><div id="chatwonline">
<div id="chat_online">
</div></div>
</div>
</div>
</td>
</tr>
<?php
 $ust=$db->getRow("select chat_status from tb_users where username=?s", $login);

  if($ust['chat_status'] == 5) {
  echo '<tr><td colspan="3"><font color="red">Вы забанены в чате!</font></td></tr>';
  } else {
?>
<tr>
<td colspan="2" style="background: #FFF;
border-radius: 9px;">
<div align="center" class="footchat"><form id="post_chat" method="post">
<table style="width:99%;" align="center">
<tr style="background: #FFF;">
<td align="center">
<div align="left" style="padding:3px;">
<input class="bbcod" value="B" onclick="insert_text('[b]','[/b]')" type="button">
<input class="bbcod" value="I" onclick="insert_text('[i]','[/i]')" type="button">
<input class="bbcod" value="U" onclick="insert_text('[u]','[/u]')" type="button">

<div id="ocno1" class="login" style="opacity: 1;font-size: 12px; padding: 0px 2px 10px; visibility: hidden;margin-top: -218px; margin-left: -9px;border: 1px solid #1D8139;">
<div align="right" style="padding-top:2px;padding-bottom:5px;">
<div align="center" onclick="hide_ocno(1)" style="width: 106px;height: 16px;border-radius: 10px;" class="exit">Закрыть окно</div>
</div>
<div align="center" style="padding-bottom:5px;">
<?php for($i=1;$i<=40;$i++){?>
<a onclick="insert_text('','*<?=$i;?>*')"><img src="/chat/smile/<?=$i;?>.gif" width="35" style="cursor: pointer;" border="0"></a>
<?php }?>
</div>
</div>
<div id="ocno2" class="login" style="opacity: 1;font-size: 12px; padding: 0px 2px 10px; visibility: hidden;margin-top: -223px; margin-left: -9px;border: 1px solid #1D8139;">
<div align="right" style="padding-top:2px;padding-bottom:5px;">
<div align="center" onclick="hide_ocno(2)" style="width: 106px;height: 16px;border-radius: 10px;" class="exit">Закрыть окно</div>
</div>
<div align="left" style="padding-bottom:5px;">
&nbsp;&nbsp;&nbsp;<u><b>В ЧАТе запрещено:</b></u><br>
<b>&nbsp;&nbsp;&nbsp;1.</b> Размещать ссылки на посторонние ресурсы.<br>
<b>&nbsp;&nbsp;&nbsp;2.</b> Размещать сообщения рекламного характера.<br>
<b>&nbsp;&nbsp;&nbsp;3.</b> Размещать сообщения одного содержания.<br>
<b>&nbsp;&nbsp;&nbsp;4.</b> Размещать бессмысленные сообщения.<br>
<b>&nbsp;&nbsp;&nbsp;5.</b> Оскорблять других участников ЧАТа.<br>
<b>&nbsp;&nbsp;&nbsp;6.</b> Использовать ненормативную лексику.<br>
<b>&nbsp;&nbsp;&nbsp;7.</b> Злоупотреблять смайлами или специальными символами.<br>
<b>&nbsp;&nbsp;&nbsp;8.</b> Указывать администрации, что и как делать.<br>
<b>&nbsp;&nbsp;&nbsp;9.</b> Обсуждать действия администрации.<br><br>
</div>
</div><b>
&nbsp;&nbsp;&nbsp;[<a onclick="show_ocno(1)" class="onli">Смайлы</a>]
&nbsp;&nbsp;&nbsp;[<a onclick="show_ocno(2)" class="onli">Правила</a>]
</b>
</div>
<div align="left" style="padding:3px;"><textarea id="message" name="mess" rows=0 class="textur" onkeydown="chatCom(event)"></textarea></div>
<div align="left" style="padding:3px;"><input type="submit" value="Oтправить" id="otprav" class="cnop65666512150" ></div>


</td>
</tr></table>
</form></div>
</td>
</tr>
<?php } ?>
</table>
</fieldset>
			<br><br>
				<div id="formsgifts" style="display: none"></div>