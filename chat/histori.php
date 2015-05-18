<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" media="screen,projection,print" href="../css/chat.css" />
<title>История Чата</title>
</head>
<body>
<?include ("option.php");?>
<table align="center" border="0" cellSpacing=0 cellPadding=0 width="100%" style="font-family:Verdana, Geneva, sans-serif;padding-left:4px;">
<?$fmsg = file($msg_file);$count_msg = count($fmsg);for($i = $count_msg; $i >= 0 ;$i--) echo $fmsg[$i];?>
</table>
</body>