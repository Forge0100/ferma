	<?php
	if(isset($_SESSION['adm'])) {
Header("Location: /admika/stats");
return;
	}
	?>
	
	<div id="rightnow">

				   <div id="box">
                	<h3 id="adduser">Авторизация</h3>
					<?php
					if(isset($_POST['login'])) {
					$login = sf($_POST['login']);
					$pass = md5Password($_POST['pass']);
					$pin = sf($_POST['pin']);
					
					$ad = mysql_query("SELECT * FROM tb_adm_login WHERE username = '$login' AND password = '$pass'");
					if(mysql_num_rows($ad) == 0) {
					echo '<center><font color="red">Не верный логин или пароль</font></center><br>';
					
					}
					$qq = mysql_fetch_assoc($ad);
					
					
					if($pin != $qq['pin']) {
					echo  '<center><font color="red">Не верный ПИН код</font></center><br>';
					
					}
					
					if($login == $qq['username'] and $pass == $qq['password'] and $pin == $qq['pin']) {
					mysql_query("UPDATE tb_adm_login SET date = ".time()." WHERE username = '$login'");
					$_SESSION['adm'] = $login;
					print "<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">

<script language=\"javascript\">top.location.href=\"/adminka/stats/\";</script>
<title>Перенаправление</title>
</head>
<body bgcolor=\"#eeeeee\" topmargin=\"0\" leftmargin=\"0\">
Вы вошли в систему как <b>".$login."</b><br>
Через секунду вы будете перемещены на сайт.<br>
Если устали ждать жмите <a href=\"/adminka/stats/\">здесь!</a>
</body>
</html>";
					}
					
					}
					
					?>
					
					
					
                    <form id="form" action="" method="post">
                      <fieldset id="personal">
                        <legend>ВВЕДИТЕ ДАННЫЕ</legend>
                        <label for="lastname">Логин : </label> 
                        <input name="login" id="lastname" type="text" tabindex="1" />
                        <br />
                        <label for="pass">Пароль : </label>
                        <input name="pass" id="pass" type="password" 
                        tabindex="2" />
                       
                       
                        <br />
						
						 <label for="pin">PIN код : </label>
                        <input name="pin" id="pin" type="password" 
                        tabindex="2" />
                       
                       
                        <br />
                      </fieldset>

                      <div align="center">
                      <input id="button1" type="submit" value="ВОЙТИ" /> 
                      <input id="button2" type="reset" />
                      </div>
                    </form>

                </div> 
			  </div>