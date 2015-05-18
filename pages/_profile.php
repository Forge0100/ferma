<center>  <div class="tegname"><h2>Профиль</h2></div> </center>
<br>
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
$page = 'Профиль';
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

<p style="margin-left: 13px;"><a href="/profile/">Смена данных</a> | <a href="/plat_pass">Получение/Смена платежного пароля</a> | <a href="/re_pass">Смена пароля от игры</a><br>				<h3>Смена данных:</h3>
</p>				<hr>   
     <br>
				
				
				
				
				
				
				
				       <?php
          if($us_data['mail_act'] == 1) {
        ?>
	   <?php
          //if(isset($_GET['mail_act'])) {
				//$act = intval($_GET['mail_act']);
				//$email = $us_data['email'];
				//$act_code = md5Password($email);
				//mysql_query("UPDATE tb_users SET code_mail = '$act_code' WHERE id = '$usid'");
				//$text = 'Для активации перейдите по ссылке ниже<br><a href="http://'.$_SERVER['HTTP_HOST'].'/act.php?act='.$act_code.'"">АКТИВАЦИЯ</a>';
		//	$headers  = 'MIME-Version: 1.0' . "\r\n";
			//$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			//$headers.= "From: support@".$_SERVER['HTTP_HOST']." \r\n";
			//mail($email, 'Подтверждение E-Mail', $text, $headers);
		  
              // return;
         // }
		  
		  
		  if(isset($_POST['sex']) and isset($_POST['mailing'])) {
		  $sex = intval($_POST['sex']);
		  $mailing = intval($_POST['mailing']);
		  
		  
		  $db->query("UPDATE tb_users SET  pol = ?i, mailsend = ?i WHERE id = ?i", $sex, $mailing, $usid);
		  echo '<center><font color="green">Данные успешно обновлены! Перенаправление... </font></center>';
		  Header("Refresh: 2, /profile");
		  
		  }
        ?>
        <?php
          } else {
        ?>	
   <?php
          //if(isset($_GET['mail_act'])) {
				//$act = intval($_GET['mail_act']);
				//$email = $us_data['email'];
				//$act_code = md5Password($email);
				//mysql_query("UPDATE tb_users SET code_mail = '$act_code' WHERE id = '$usid'");
				//$text = 'Для активации перейдите по ссылке ниже<br><a href="http://'.$_SERVER['HTTP_HOST'].'/act.php?act='.$act_code.'"">АКТИВАЦИЯ</a>';
		//	$headers  = 'MIME-Version: 1.0' . "\r\n";
			//$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			//$headers.= "From: support@".$_SERVER['HTTP_HOST']." \r\n";
			//mail($email, 'Подтверждение E-Mail', $text, $headers);
		  
              // return;
         // }
		  
		  
		  if(isset($_POST['sex']) and isset($_POST['mailing'])) {
		  $sex = intval($_POST['sex']);
		  $mailing = intval($_POST['mailing']);
		  $emailu = validemail($_POST['email']);
		  
		  $db->query("UPDATE tb_users SET email = ?s, pol = ?i, mailsend = ?i WHERE id = ?i", $emailu, $sex, $mailing, $usid);
		  echo '<center><font color="green">Данные успешно обновлены! Перенаправление... </font></center>';
		  Header("Refresh: 2, /profile");
		  
		  }
        ?>  
            
          <?php
          }
          ?>
				
				
								        <?php
          if($us_data['mail_act'] == 1) {
        ?>
	
        <?php
          } else {
        ?>	
		   <?php
						  if(isset($_POST['activemile'])) {
		  
		  
		  $db->query("UPDATE tb_users SET mail_act = '1' WHERE id = ?i", $usid);
		  echo '<center><font color="green">E-mail успешно подтвержден! Перенаправление... </font></center>';
		  Header("Refresh: 2, /profile");
		  
		  }
				
				  ?>
            
          <?php
          }
          ?>
				
				
				
				<form action="" method="post">
				<p style="margin-left: 13px;">E-mail</p>
				
        <?php
          if($us_data['mail_act'] == 1) {
        ?>
		<input style="width: 45%;" type='text'  value='<?=$us_data['email']; ?>' maxlength="50" disabled="disabled"/>
				<b style='color:green'>Подтвержден</b>	
        <?php
          } else {
        ?>	
		    <input style="width: 45%;" type='text' name='email' value='<?=$us_data['email']; ?>' maxlength="50" />
          	<b style='color:red'>Не подтвержден</b>	
			
			

			
            
          <?php
          }
          ?>
		  
				<p style="margin-left: 13px;">Пол</p> 
				<p style="  margin-left: 13px;" >
				<select maxlength="1" name="sex">
				
				
				<option <?php
				if($us_data['pol'] == 1) echo 'selected';
				?> value="1">М</option>
				<option <?php
				if($us_data['pol'] == 2) echo 'selected';
				?> value="2">Ж</option>
				</select></p>
				<p style="margin-left: 13px;">Получать новости на емайл?</p>
				<p style="  margin-left: 13px;" >
				<select maxlength="1" name="mailing">
				<option <?php
				if($us_data['mailsend'] == 0) echo 'selected';
				?> value="0">Нет</option></p>
				<option <?php
				if($us_data['mailsend'] == 1) echo 'selected';
				?> value="1">Да</option>
				</select>
				<label></label>
				<input class="menubtn" type='submit' value='Сохранить' />
				</form>
				
				
				
				
				
				
				

										        <?php
          if($us_data['mail_act'] == 1) {
        ?>
	
        <?php
          } else {
        ?>	
		   <form action="" name='activemile' method="post">
				<br>
				<input class="menubtn" name='activemile' type='submit' value='Подтвердить E-mail' />
				</form>
            
          <?php
          }
          ?>	
				
				

				
				
				
				
				
				
				
				
				
				<br>
				<p style="margin-left: 13px;">Если вы не получаете ссылку для активации на ваш емайл, проверьте если ваш емайл введен правильно. Если он неправильный введите правильный и нажмите на кнопку сохранить.</p>
			 	<div id="formsgifts" style="display: none"></div>