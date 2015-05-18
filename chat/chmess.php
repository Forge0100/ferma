<?include ("option.php");?>
<table cellSpacing=0 cellPadding=0 width="100%"  style="font-family:Verdana, Geneva, sans-serif;padding-left:4px;">
<?//$fmsg = file($msg_file);$count_msg = count($fmsg);for($i = $count_msg; $i >= $count_msg-$msg_count;$i--) echo $fmsg[$i];?>
<script>

function dell(i){

//var typesemena = 1;
//var typesemen = $("input[name=idkur]").val();
//var typesemen = document.getElementById('idkur').val();
var n;

$.ajax({
type: "POST",
dataType : "json",
url: "/ajax/chat_dell.php",
data: { 'func' : 'success', 'kuraid' : i}

}).done(function( data ) {
var typeclick = data.typeclick;

/*
var id = data.id;
$("#pole_"+id).remove();
$("#pole_"+id).after(function (){
return '<span id="timer'+id+'" style="display:none;"></span><script type="text/javascript">pole_timer(' + data.message + ', "timer'+id+'");<\/script>';
});
*/
if(n) {
n.setText('<b>' + data.message + '</b>');
n.setType("success");
} else {
n = noty({
text: '<b>' + data.message + '</b>',
type: "success",
dismissQueue: false,
layout: 'top',
theme: 'defaultTheme',
callback: {
afterClose: function() {n=null;}
}
});
}
}).fail(function( jqXHR, textStatus ) {
alert( "Вы слишком часто нажимаете на поля!");
});
e.preventDefault();
tip.on('click', '.close', function(e){                  
				tip.fadeOut(100);
				e.preventDefault();
			});
			
}
function ban(i){

//var typesemena = 1;
//var typesemen = $("input[name=idkur]").val();
//var typesemen = document.getElementById('idkur').val();
var n;

$.ajax({
type: "POST",
dataType : "json",
url: "/ajax/chat_dell.php",
data: { 'func' : 'ban', 'kuraid' : i}

}).done(function( data ) {
var typeclick = data.typeclick;

/*
var id = data.id;
$("#pole_"+id).remove();
$("#pole_"+id).after(function (){
return '<span id="timer'+id+'" style="display:none;"></span><script type="text/javascript">pole_timer(' + data.message + ', "timer'+id+'");<\/script>';
});
*/
if(n) {
n.setText('<b>' + data.message + '</b>');
n.setType("success");
} else {
n = noty({
text: '<b>' + data.message + '</b>',
type: "success",
dismissQueue: false,
layout: 'top',
theme: 'defaultTheme',
callback: {
afterClose: function() {n=null;}
}
});
}
}).fail(function( jqXHR, textStatus ) {
alert( "Вы слишком часто нажимаете");
});
e.preventDefault();
tip.on('click', '.close', function(e){                  
				tip.fadeOut(100);
				e.preventDefault();
			});
			
}
</script>
<?php
$a = $db->getAll("SELECT * FROM tb_chat ORDER BY id DESC LIMIT 20");
if(count($a) == 0) echo 'Сообщений в чате нет...';
foreach($a as $s) {
$d = $db->getRow("SELECT * FROM tb_users WHERE id = ?i", $s['user_id']);
if($d['chat_status'] == 1) { 
$adm = '<font color="red">'; $admm = '</font>';

} elseif($d['chat_status'] == 2) {
$adm = '<font color="green">'; $admm = '</font>';

} elseif($d['chat_status'] == 5) {
$adm = '<font color="blue">'; $admm = '</font>';

}else{
$adm = '<font color="black">'; $admm = '</font>';

}

$dd = $db->getRow("SELECT * FROM tb_users WHERE id = ?i", $_SESSION['id']);
if($dd['chat_status'] == 1 or $dd['chat_status'] == 2) {
$dell = "&nbsp;<a onclick=\"dell('".$s['id']."')\"  style=\"cursor:pointer\"><img src='/images/page_white_delete.png' title='Удалить сообщение'/></a>&nbsp;";
$ban = "&nbsp;<a onclick=\"ban('".$d['id']."')\"  style=\"cursor:pointer\"><img src='/images/user_delete.png' title='Забанить пользователя'/></a>&nbsp;";
}else {$dell = ''; $ban = ''; }
if($d['pol'] == 1) { $pol = 'male.png'; $tile = 'Муж';}
elseif($d['pol'] == 2)  { $pol = 'female.png'; $tile = 'Жен';}
else { $pol = 'male.png'; $tile = 'Муж';}


?>
<div class='blocc'><a href="/wall/user/<?=$s['user_id']; ?>" target="_blank"><img src="/images/wall3.png"></a>&nbsp;<img src="/images/<?=$pol; ?>" title="<?=$tile; ?>" />&nbsp;<?=$dell; ?><?=$ban; ?><span class='msname'><a onclick="insert_text('','[b][i]<?=$s['login']; ?>:[/i][/b]')" ><?=$adm; ?><?=$s['login']; ?><?=$admm; ?></a></span>&nbsp;<span class='mstime'><?=date("d.m.y H:i", $s['date']); ?></span><br><div  class='msmess'><?=$s['text']; ?></div></div>
<? } ?>
</table>