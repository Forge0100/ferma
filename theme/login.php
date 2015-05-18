<?php
//session_start();
?>
<div class="server-status-box">
						<div class="server-status-t"></div>
						<div class="server-status-inner-bg">
							<div class="server-status-inner-t">
								<div class="server-status-inner-b">
<div class="bgmain3">
<form action="/error_login" method="post" >
			<div class="login1">Логин</div>
					<input name="user" class="loginput" placeholder="Логин" value="" type="text" size="14" />
					<div class="pass">Пароль</div>
					<input name="pass" class="passput" placeholder="Пароль" value="" type="password" size="14" />
					<div class="subm2">
								<img style="width:80px;" title="Если Вы не видите число на картинке, нажмите на картинку мышкой" onclick="this.src=this.src+'&amp;'+Math.round(Math.random())" src="../captcha.php?<?php echo session_name()?>=<?php echo session_id()?>">	
 <input name="keystring" placeholder="Код" required value="<?echo $_SESSION['captcha']?>" type="text" size='5' maxlength='4' style="vertical-align: top;" />
								<input type="submit" alt="" value="Войти" class="button" />
								<a href="/remind/"><b>Забыли пароль?</b></a>
								</div>
				</form>
				
</div>
									</div>
							</div>
						</div>

						<div class="server-status-b"></div>
					</div>