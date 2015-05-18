<div class="tegname"><h2>Смена фермера</h2></div>
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
$page = 'Стена пользователя';
?>

<?php
if(isset($_POST['search'])) {
$serch = sf($_POST['searchvalue']);
$v = mysql_query("SELECT * FROM tb_users WHERE username = '$serch'") or die(mysql_error());
if(mysql_num_rows($v) >= 1) {
$vv = mysql_fetch_assoc($v);
Header("Location: /wall/user/".$vv['id']."");
exit();

}else {
echo 'Пользователь не найден';
Header("Refresh: 2, /wall");
}
return;
}

?>


<?php
if(isset($_GET['addfrend'])) {
if(isset($usid)) {
$as = intval($_GET['addfrend']);
$f = mysql_query("SELECT * FROM tb_frend_wait WHERE user_id_1 = '$usid' AND user_id_2 = '$as'");
if(mysql_num_rows($f) == 1) {
$k = mysql_query("SELECT * FROM tb_users WHERE id = '$as'");
$kk = mysql_fetch_assoc($k);
if($us_data['frend'] != '') {
$ful_arr1 = $us_data['frend'].','.$kk['username'];
}else{
$ful_arr1 = $us_data['frend'].''.$kk['username'];

}
if($kk['frend'] != ''){
$ful_arr2 = $kk['frend'].','.$login;
}else {
$ful_arr2 = $kk['frend'].''.$login;

}

mysql_query("UPDATE tb_users SET frend = '$ful_arr1' WHERE id = '$usid'") or die(mysql_error());
mysql_query("UPDATE tb_users SET frend = '$ful_arr2' WHERE id = '$as'") or die(mysql_error());
mysql_query("DELETE FROM tb_frend_wait WHERE user_id_1 = '$usid' AND user_id_2 = '$as'") or die(mysql_error());
echo 'Вы успешно подружились</br>';
Header("location: /wall/friendsrequest");
}else { echo 'Такой заявки не существует </br>'; Header("location: /wall/friendsrequest");}
}
return;

}



if(isset($_GET['nofrend'])) {
if(isset($usid)) {
$as = intval($_GET['nofrend']);
$f = mysql_query("SELECT * FROM tb_frend_wait WHERE user_id_1 = '$usid' AND user_id_2 = '$as'");
if(mysql_num_rows($f) == 1) {
mysql_query("DELETE FROM tb_frend_wait WHERE user_id_1 = '$usid' AND user_id_2 = '$as'") or die(mysql_error());
echo 'Заявка отклонена</br>';
Header("location: /wall/friendsrequest");
}else {echo 'Такой заявки не существует </br>'; Header("location: /wall/friendsrequest");}
}
return;
}
?>


<?php
 if(isset($_GET['fadd'])) {
 if(isset($usid)) {
 $id_add = intval($_GET['fadd']);
 $w = mysql_query("SELECT * FROM tb_frend_wait WHERE user_id_1 = '$id_add' AND user_id_2 = '$usid'") or die(mysql_error());
 if(mysql_num_rows($w) == 0) {
 $r = mysql_fetch_assoc(mysql_query("SELECT * FROM tb_users WHERE id = '$id_add'")) or die(mysql_error());
 $aa = explode(",", $us_data['frend']);

 if(!in_array($r['username'], $aa)) {
 
mysql_query("INSERT INTO tb_frend_wait (user_id_1, user_id_2, status, login2) VALUES ('$id_add', '$usid', '0', '$login')") or die(mysql_error());
echo '<center><font color="green">Заявка на добавление в друзья отправлена пользователю</font></center></br>';
 }else echo '<center><font color="red">Вы уже друзья!</font></center></br>';
 
 }else echo '<center><font color="red">Вы уже отправили заявку на добавление в друзья</font></center></br>';
 }
 }


if(isset($_POST['del'])) {
$id = intval($_POST['idd']);
$qq = mysql_query("SELECT * FROM tb_wall WHERE id = '$id'");
$qqq = mysql_fetch_assoc($qq);
if($qqq['userwall'] == $usid) {
mysql_query("DELETE FROM tb_wall WHERE id = '$id'");
echo '<center><font color="green">Комментарий удален.</font></center></br>';
}else{
echo '<center><font color="red">Это не ваша стена! Вы не можете удалять коментарии с чужих стен.</font></center></br>';
}
}


		if(isset($_POST['savecom'])) {
		$message = sf($_POST['message']);
		$stenaid = intval($_POST['stenaid']);
		
		if(!empty($message)) {
		if($us_data['energy'] >= 10) {
mysql_query("INSERT INTO tb_wall (userwall, user_id, login, date, text) VALUES
			('$stenaid', '".$_SESSION['id']."', '".$_SESSION['login']."', '".time()."', '$message')") or die(mysql_error());
		mysql_query("UPDATE tb_users SET energy = energy - 10 WHERE id = '$usid'");
		echo '<center><font color="green">Комментарий добавлен.</font></center></br>';
		} else echo '<center><font color="red">Недостаточно энергии! Покушайте пирог!</font></center></br>';
		}
		
		
		}
?>

<?php
if(isset($_GET['friendsrequest'])) {
?>
<table align="center" width="500px">
<?php
$n = mysql_query("SELECT * FROM tb_frend_wait WHERE user_id_1 = '$usid'") or die(mysql_error());
if(mysql_num_rows($n) == 0) {
echo 'Нет заявок на добавление в друзья';
Header("Refresh: 3, /wall/myfriends");
}else{
while($nn = mysql_fetch_assoc($n)){

$e = mysql_query("SELECT * FROM tb_users WHERE id = '".$nn['user_id_2']."'");	
$ee = mysql_fetch_assoc($e);
switch($ee['pol']) {
		case 1: $poll = 'Муж'; break;
		case 2: $poll = 'Жен'; break;
		default: $poll = 'Не указано'; break;
		}
		if(!empty($ee['ava'])) {
		
?>
<tr><td rows="4" width="160px">
			<a href="/wall/user/<?=$ee['id']; ?>"><img title="<?=$ee['username'];?>" class="friends" src="/<?=$ee['ava'];?>" width="30" height="30"></a>
			</td><td>
			
			Логин: <a href="/wall/user/<?=$ee['id'];?>"><?=$ee['username'];?></a><br>
			Уровень: <?=$ee['level'];?><br>
			Имя: <?=$ee['name']; ?> <?=$ee['famname']; ?><br>
			Пол: <?=$poll;?><br>
			<a href="/wall/friendsrequest/addfrend/<?=$ee['id'];?>">Принять</a> || <a href="/wall/friendsrequest/nofrend/<?=$ee['id'];?>">Отказать</a>
			
			</td>
<?	
		}else{
?>
<tr><td rows="4" width="160px">
		<a href="/wall/user/<?=$ee['id']; ?>"><img title="<?=$ee['username'];?>" class="friends" src="/images/noavatar.png" width="30" height="30"></a>
</td><td>
			
			Логин: <a href="/wall/user/<?=$ee['id'];?>"><?=$ee['username'];?></a><br>
			Уровень: <?=$ee['level'];?><br>
			Имя: <?=$ee['name']; ?> <?=$ee['famname']; ?><br>
			Пол: <?=$poll;?><br>
			<a href="/wall/friendsrequest/addfrend/<?=$ee['id'];?>">Принять</a> || <a href="/wall/friendsrequest/nofrend/<?=$ee['id'];?>">Отказать</a>
			</td>
<?	
		}	
												 
 }

 }

 ?>
 </table>
 <?php
 
	
return;
}

?>





<?php
if(isset($_GET['myfriends'])) {
?>
<table align="center" width="500px">
<?php
if(!empty($us_data['frend'])) {
$ff = explode(",", $us_data['frend']);															  
$c = count($ff);
for($i = 0; $i <= ($c-1); $i++) {
$e = mysql_query("SELECT * FROM tb_users WHERE username = '".$ff[$i]."'");	
$ee = mysql_fetch_assoc($e);
switch($ee['pol']) {
		case 1: $poll = 'Муж'; break;
		case 2: $poll = 'Жен'; break;
		default: $poll = 'Не указано'; break;
		}
		if(!empty($ee['ava'])) {
		
?>
<tr><td rows="4" width="160px">
			<a href="/wall/user/<?=$ee['id']; ?>"><img title="<?=$ee['username'];?>" class="friends" src="/<?=$ee['ava'];?>" width="30" height="30"></a>
			</td><td>
			
			Логин: <a href="/wall/user/<?=$ee['id'];?>"><?=$ee['username'];?></a><br>
			Уровень: <?=$ee['level'];?><br>
			Имя: <?=$ee['name']; ?> <?=$ee['famname']; ?><br>
			Пол: <?=$poll;?>
			
			</td>
<?	
		}else{
?>
<tr><td rows="4" width="160px">
		<a href="/wall/user/<?=$ee['id']; ?>"><img title="<?=$ee['username'];?>" class="friends" src="/images/noavatar.png" width="30" height="30"></a>
</td><td>
			
			Логин: <a href="/wall/user/<?=$ee['id'];?>"><?=$ee['username'];?></a><br>
			Уровень: <?=$ee['level'];?><br>
			Имя: <?=$ee['name']; ?> <?=$ee['famname']; ?><br>
			Пол: <?=$poll;?>
			</td>
<?	
		}	
												 
 }
 }else { echo 'У Вас пока нет друзей! :( </br>'; Header("Refresh: 3, /wall");}
 

 ?>
 </table>
 <?php
 
	
return;
}

?>


<?php
if(isset($_POST['save'])) {
$name = sf($_POST['name']);
$family = sf($_POST['family']);
$city = sf($_POST['city']);
$state = sf($_POST['state']);
$info = sf($_POST['info']);
$sex = valideint($_POST['sex']);
$day = valideint($_POST['day']);
$mounth = valideint($_POST['mounth']);
$year = valideint($_POST['year']);

if(strlen($name) > 1) {
	if(strlen($family) > 1) {
		if(strlen($city) > 1) {
			if(strlen($state) > 1) {
				if(strlen($info) > 1) {
					
	if(strlen($name) < 50) {
	if(strlen($family) < 50) {
		if(strlen($city) < 60) {
			if(strlen($state) < 100) {			
				
				
if($sex == 1 or $sex == 2) {
if($day >= 1 and $day <= 31) {
if($mounth >= 1 and $mounth <= 12) {
if($year >= 1914 and $year <= 1998) {
//if(ereg("^[a-zа-я0-9_]{1,255}$",$info)) {
$date_r = $day.'.'.$mounth.'.'.$year;
mysql_query("UPDATE tb_users SET date_r = '$date_r', name = '$name', famname = '$family', city = '$city', strana = '$state', osebe = '$info' WHERE id = '$usid'") or die(mysql_error());
echo '<center><font color="green">Ваша стена была обновлена! </font><a href="/wall/"><<вернуться назад</a></center></br>';
Header("Refresh: 2, /wall/edit");
//}else echo '<center><font color="red">Поле (О Себе) болше чем 255 символов!</font></center></br>';
}else echo '<center><font color="red">ОШИБОЧКА!</font></center></br>';
}else echo '<center><font color="red">ОШИБОЧКА!</font></center></br>';
}else echo '<center><font color="red">ОШИБОЧКА!</font></center></br>';
}else echo '<center><font color="red">ОШИБОЧКА!</font></center></br>';


}else echo '<center><font color="red">Поле (Страна) болше чем 100 символов!</font></center></br>';
}else echo '<center><font color="red">Поле (Город) болше чем 60 символов!</font></center></br>';
}else echo '<center><font color="red">Поле (Фамилия) болше чем 50 символов!</font></center></br>';
}else echo '<center><font color="red">Поле (Имя) болше чем 50 символов!</font></center></br>';

}else echo '<center><font color="red">Заполните все поля!</font></center></br>';
}else echo '<center><font color="red">Заполните все поля!</font></center></br>';
}else echo '<center><font color="red">Заполните все поля!</font></center></br>';
}else echo '<center><font color="red">Заполните все поля!</font></center></br>';
}else echo '<center><font color="red">Заполните все поля!</font></center></br>';

}
if(isset($_GET['edit'])) {
?>

 <link rel="stylesheet" type="text/css" media="screen,projection,print" href="/css/wall.css?q=1.2"><h1>Редактировать стену!</h1>
 <form action="" method="post">
							<label>Имя:</label>
							<input type="text" maxlength="50" name="name" value="<?=$us_data['name']; ?>">
							<label>Фамилия:</label>
							<input type="text" maxlength="50" name="family" value="<?=$us_data['famname']; ?>">
							<label>Пол:</label>
							<select maxlength="1" name="sex">
							
							<option  value="1">М</option>
							<option  value="2">Ж</option>
							</select>
							<label>День рождения:</label>
							<select maxlength="2" name="day">
							<option  value="1">1</option>
							<option  value="2">2</option>
							<option  value="3">3</option>
							<option  value="4">4</option>
							<option  value="5">5</option>
							<option  value="6">6</option>
							<option  value="7">7</option>
							<option  value="8">8</option>
							<option  value="9">9</option>
							<option  value="10">10</option>
							<option  value="11">11</option>
							<option  value="12">12</option>
							<option  value="13">13</option>
							<option  value="14">14</option>
							<option  value="15">15</option>
							<option  value="16">16</option>
							<option  value="17">17</option>
							<option  value="18">18</option>
							<option  value="19">19</option>
							<option  value="20">20</option>
							<option  value="21">21</option>
							<option  value="22">22</option>
							<option  value="23">23</option>
							<option  value="24">24</option>
							<option  value="25">25</option>
							<option  value="26">26</option>
							<option  value="27">27</option>
							<option  value="28">28</option>
							<option  value="29">29</option>
							<option  value="30">30</option>
							<option  value="31">31</option>
							</select>
							<select maxlength="2" name="mounth">
							<option  value="1">01</option>
							<option  value="2">02</option>
							<option  value="3">03</option>
							<option  value="4">04</option>
							<option  value="5">05</option>
							<option  value="6">06</option>
							<option  value="7">07</option>
							<option  value="8">08</option>
							<option  value="9">09</option>
							<option  value="10">10</option>
							<option  value="11">11</option>
							<option  value="12">12</option>							
							</select>
							<select maxlength="4" name="year">
							<option  value="1998">1998</option>
							<option  value="1997">1997</option>
							<option  value="1996">1996</option>
							<option  value="1995">1995</option>
							<option  value="1994">1994</option>
							<option  value="1993">1993</option>
							<option  value="1992">1992</option>
							<option  value="1991">1991</option>
							<option  value="1990">1990</option>
							<option  value="1989">1989</option>
							<option  value="1988">1988</option>
							<option  value="1987">1987</option>
							<option  value="1986">1986</option>
							<option  value="1985">1985</option>
							<option  value="1984">1984</option>
							<option  value="1983">1983</option>
							<option  value="1982">1982</option>
							<option  value="1981">1981</option>
							<option  value="1980">1980</option>
							<option  value="1979">1979</option>
							<option  value="1978">1978</option>
							<option  value="1977">1977</option>
							<option  value="1976">1976</option>
							<option  value="1975">1975</option>
							<option  value="1974">1974</option>
							<option  value="1973">1973</option>
							<option  value="1972">1972</option>
							<option  value="1971">1971</option>
							<option  value="1970">1970</option>
							<option  value="1969">1969</option>
							<option  value="1968">1968</option>
							<option  value="1967">1967</option>
							<option  value="1966">1966</option>
							<option  value="1965">1965</option>
							<option  value="1964">1964</option>
							<option  value="1963">1963</option>
							<option  value="1962">1962</option>
							<option  value="1961">1961</option>
							<option  value="1960">1960</option>
							<option  value="1959">1959</option>
							<option  value="1958">1958</option>
							<option  value="1957">1957</option>
							<option  value="1956">1956</option>
							<option  value="1955">1955</option>
							<option  value="1954">1954</option>
							<option  value="1953">1953</option>
							<option  value="1952">1952</option>
							<option  value="1951">1951</option>
							<option  value="1950">1950</option>
							<option  value="1949">1949</option>
							<option  value="1948">1948</option>
							<option  value="1947">1947</option>
							<option  value="1946">1946</option>
							<option  value="1945">1945</option>
							<option  value="1944">1944</option>
							<option  value="1943">1943</option>
							<option  value="1942">1942</option>
							<option  value="1941">1941</option>
							<option  value="1940">1940</option>
							<option  value="1939">1939</option>
							<option  value="1938">1938</option>
							<option  value="1937">1937</option>
							<option  value="1936">1936</option>
							<option  value="1935">1935</option>
							<option  value="1934">1934</option>
							<option  value="1933">1933</option>
							<option  value="1932">1932</option>
							<option  value="1931">1931</option>
							<option  value="1930">1930</option>
							<option  value="1929">1929</option>
							<option  value="1928">1928</option>
							<option  value="1927">1927</option>
							<option  value="1926">1926</option>
							<option  value="1925">1925</option>
							<option  value="1924">1924</option>
							<option  value="1923">1923</option>
							<option  value="1922">1922</option>
							<option  value="1921">1921</option>
							<option  value="1920">1920</option>
							<option  value="1919">1919</option>
							<option  value="1918">1918</option>
							<option  value="1917">1917</option>
							<option  value="1916">1916</option>
							<option  value="1915">1915</option>
							<option  value="1914">1914</option>
							</select>
							<label>Город:</label>
							<input type="text" name="city" value="<?=$us_data['city']; ?>">
							<label>Страна:</label>
							<input type="text" name="state" value="<?=$us_data['strana']; ?>">	
							<label>О себе: (максимально 255 символов)</label>
							<textarea rows="5" cols="30" maxlength="255" name="info" ><?=$us_data['osebe']; ?></textarea>
							<label></label>
							
							<input type="submit" name="save" class="buttonmail" value="Сохранить">
						</form><br>
						<a href="/wall/"><<вернуться назад</a><br>	<div id="formsgifts" style="display: none"></div>

<?php
return;
}
?>
<link rel="stylesheet" type="text/css" media="screen,projection,print" href="/css/wall.css?q=1.2">		
		<script type="text/javascript">

		$(document).ready(function () {
			
			$("#editavatar").click(function (e){	
				ShowDialog();
				e.preventDefault();
			});		

			$("#btnClose").click(function (e){			
				HideDialog();
				e.preventDefault();
			});

			
			$("#sendmessage").click(function (e){
				$( this ).hide();
				e.preventDefault();
				$("#formmessage").show('fast');
			});		

			$("#btnClose").click(function (e){			
				HideDialog();
				e.preventDefault();
			});
			PodarkiRotate();
		});

		function ShowDialog()
		{
			$("#overlay").show();
			$("#dialog").fadeIn(300);
		}

		function HideDialog()
		{
			$("#overlay").hide();
			$("#dialog").fadeOut(300);
		}
		
		function PodarkiRotate() {
			var allImages = $("#podarok div");
			if(allImages.length > 1) {
				allImages.hide();
				var firstPod = allImages.first().fadeIn();
				
				firstPod.addClass('active');
				
				var nextPodarok = function() {

					var onImg = allImages.filter('.active');
					onImg.removeClass('active');
					onImg.fadeOut();
					var nextImg = onImg.index() < allImages.length-1 ? onImg.next() : allImages.first();
					
					nextImg.fadeIn().addClass('active');
				}
				
				var interPodarki = setInterval(nextPodarok, 2000);
				$(allImages).hover(function(){
					clearInterval(interPodarki);
				},function(){
					interPodarki = setInterval(nextPodarok, 2000);
				});
			}
		}
		
	</script>
	<script type="text/javascript" src="../js/web_dialog.js"></script>
	
		<div id="overlay" class="web_dialog_overlay"></div>

		<div id="dialog" class="web_dialog" style="margin-left: -200.5px; margin-top: -83.5px; width: 400px;">
		
		
		
		
<?php
error_reporting(1);
if (isset($_FILES['file'])) {
    $f_err     = 0; //вспомогательная переменная
    $types     = array(
        '.jpg',
        '.JPG',
        '.jpeg',
        '.gif',
        '.png'
    ); //поддерживаемые форматы загружаемых файлов
    $max_size  = 5020500; //максимальный размер загружаемого файла (5000-МБ)
    $path      = 'avatar/'; //директория для загрузки
    $path_mini = 'avatar/'; //директория для загрузки миниатюры
    $fname     = $_FILES['file']['name'];
	//$fname = md5($fname);
    $ext       = substr($fname, strpos($fname, '.'), strlen($fname) - 1); //определяем тип загружаемого файла

    //проверка на соответствие формата
    if (!in_array($ext, $types)) {
        $f_err++;
        $mess = '<p style="color:red;">Загружаемый файл не является картинкой</p>';
    }

    //проверка размера файла
    if (filesize($_FILES['file']['tmp_name']) > $max_size) {
        $f_err++;
        $mess = '<p style="color:red;">Размер загружаемой картинки превышает 5 Mb</p>';
    }

    //если файл успешно прошел проверку
    //перемещаем его в заданную директорию из временной
    if ($f_err == 0) {
        move_uploaded_file($_FILES['file']['tmp_name'], $path . $fname);

        //путь к загруженному файлу
        $source_src = $path . $fname;

        //создаем путь и имя миниатюры
        $new_name     = md5($usid.''.$fname) . $ext;
        $resource_src = $path_mini . $new_name;

        //получаем параметры загруженного файла
        $params = getimagesize($source_src);

        switch ($params[2]) {
            case 1:
                $source = imagecreatefromgif($source_src);
                break;
            case 2:
                $source = imagecreatefromjpeg($source_src);
                break;
			default:  $source = imagecreatefrompng($source_src);
        }

        //если высота больше ширины
        //вычисляем новую ширину
        if ($params[1] > $params[0]) {
            $newheight = 150;
            $newwidth  = floor($newheight * $params[0] / $params[1]);
        }
        //если ширина больше высоты
        //вычисляем новую высоту
        if ($params[1] < $params[0]) {
            $newwidth  = 150;
            $newheight = floor($newwidth * $params[1] / $params[0]);
        }
		
		 if ($params[1] == $params[0]) {
            $newwidth  = 150;
            $newheight = 150;
        }


        //создаем миниатюру загруженного изображения
        $resource = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($resource, $source, 0, 0, 0, 0, $newwidth, $newheight, $params[0], $params[1]);
        imagejpeg($resource, $resource_src, 80); //80 качество изображения

        //назначаем права доступа
        chmod("$source_src", 0644);
        chmod("$resource_src", 0644);

$file = str_replace($_SERVER['DOCUMENT_ROOT'], '/', $path_mini . $new_name); // получить путь вида '/img/avatars/15.jpg'

mysql_query("UPDATE tb_users SET ava = '$file' WHERE id = '$usid'") or die(mysql_error());

header('Refresh: 1;URL=/wall');
        //выводим сообщение
        $mess = '<center><br><p style="color:green;">Изображение загружено.</p></center>';
        $ok   = 1;
    }




}


if(isset($_GET['id']) and $_GET['id'] != $usid) {
$id = intval($_GET['id']);
$q = mysql_query("SELECT * FROM tb_users WHERE id = '$id'") or die(mysql_error());
$qq = mysql_fetch_assoc($q);
?>


		</div>

 <div id="article">
    <div class="card-header">
	
	<?php
	if($mess) {
	echo $mess;
	}
	if($qq['ava'] != '') {
	?>
      <img class="profile-photo" width="150" height="150" src="/<?=$qq['ava']; ?>">
	  <? } else { ?>
	  <img class="profile-photo" width="150" height="150" src="/images/noavatar.png">
	  
	  <? } ?>
	  <div id="podarok">
			  </div>

     
    </div>
   <ul class="card-links">
		<li>
		  <i class="icon icon-user"></i><span class="label">Уровень: <?=$qq['level']; ?></span>
		</li>
		<hr>
		   <li class="active" style="padding: 17px 13px 0px 0px;">
								<i class="icon icon-list-alt"></i>
								 <?php
								$ff = explode(",", $qq['frend']);															  
								$c = count($ff);
								 ?>
								<span class="label">Друзья</span><span class="label-notification label-active"><?=$c;?></span>
								<br><br>
								<span class="label">Заявки</span><span class="label-notification label-active">0</span>

															   <div id="fr">
<?php


if(!empty($qq['frend'])) {
$ff = explode(",", $qq['frend']);															  
$c = count($ff);
for($i = 0; $i <= ($c-1); $i++) {
$e = mysql_query("SELECT * FROM tb_users WHERE username = '".$ff[$i]."'");	
$ee = mysql_fetch_assoc($e);
		if(!empty($ee['ava'])) {
?>
			<a href="/wall/user/<?=$ee['id']; ?>"><img class="friends" title="<?=$ee['username'];?>" src="/<?=$ee['ava'];?>" width="30" height="30"></a>
<?	
		}else{
?>
		<a href="/wall/user/<?=$ee['id']; ?>"><img class="friends" title="<?=$ee['username'];?>" src="/images/noavatar.png" width="30" height="30"></a>
		<?php
		}	
												 
 }
 }
 

 
 
?>								</div>
	


																 <div id="fr">
<?php

if(!empty($qq['gifts'])) {
$ff = explode(",", $qq['gifts']);															  
$c = count($ff);
for($i = 0; $i <= ($c-1); $i++) {


?>
	<img class="friends" title="<?=$ee['username'];?>" src="/gifts/<?=$ff[$i];?>" width="30" height="30">
<?												 
 }
 }
?>
															   
							
																</div>
							</li>    
	</ul>  
  </div>
	<div id="inform">	
						<div class="search">
							<input class="search_box" type="checkbox" id="search_box">						
							<label class="icon-search" for="search_box" title="Найти фермера!"></label>						   
						  <div class="search_form"  style="width: 216px;">
										
								<form action="" method="post">
								
								
								<input maxlength="30" type="text"name="searchvalue" placeholder="Логин фермера" value="">				
								<input type="submit" name="search" value="Найти">
								</form>
										
						  </div>
						   <a href="/wall/frendadd/<?=$qq['id'];?>"><span class="icon-search addfriend" title="Добавить в друзья"></span></a>
									<a href="/pm/to/<?=$qq['username'];?>"><span class="icon-search sendmes" title="Отправить ПМ"></span></a>
									<a href="/gifts/add/<?=$qq['id'];?>"><span class="icon-search gift" title="Сделать подарок"></span></a>
									<a href="/wall"><span class="icon-search back" title="Вернуться на свою стену"></span></a>
															 
						</div>
					</div>
	<div id="inform">
		<b><?=$qq['username']; ?> - 
	<?php
		if($qq['name'] != '') {
		echo $qq['name']; 
		}else{
		echo 'Не указано';
		}
       ?>	
<?php
		if($qq['famname'] != '') {
		echo $qq['famname']; 
		}else{
		echo 'Не указано';
		}
       ?>	
	   </b><br>
		<hr>
		День рождения: <b> 
		<?php
		if($qq['date_r'] != '') {
		echo $qq['date_r']; 
		}else{
		echo 'Не указано';
		}
       ?>
		</b><br>
		В игре с: <b> <?=date("d.m.Y в H:i", $qq['date_reg']); ?> </b><br>
		<?php
		switch($qq['pol']) {
		case 1: $pol = 'Мужской'; break;
		case 2: $pol = 'Женский'; break;
		}
		
		?>
		Пол: <b><?=$pol;?></b><br>
		
		Город: <b>
			<?php
		if($qq['city'] != '') {
		echo $qq['city']; 
		}else{
		echo 'Не указано';
		}
       ?>
		</b><br>

		Страна: <b>
				<?php
		if($qq['strana'] != '') {
		echo $qq['strana']; 
		}else{
		echo 'Не указано';
		}
       ?>
		</b><br>
<br>
		О себе:<br>
		<?php
		if($qq['osebe'] != '') {
		echo $qq['osebe']; 
		}else{
		echo 'Не указано';
		}
       ?>
			</div>

	<div id="inform" style=" margin-right: 4px;">
	<input id="sendmessage" placeholder="Что вы думаете? &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
		<form id="formmessage" style="display: none;" action="" method="post">
			<textarea rows="5" cols="30" name="message" ></textarea>
			<label></label>
			
			<input type="hidden" name="stenaid" value="<?=$qq['id']; ?>">
			<input type="submit" name="savecom" class="buttonmail" value="Оставить сообщение">
			<label></label>
			<span class="afterform">Цена сообщения - 10 ед. энергии<br> (реклама и ссылки запрещены)</span>
		</form>		</div>
		
		<div class="clear"></div>
		<div style="max-height: 975px; height: 975px; overflow-y: scroll">
		<ul id="people"><?php
		$s = mysql_query("SELECT * FROM tb_wall WHERE userwall = '".$qq['id']."' ORDER BY id DESC" ) or die(mysql_error());
		while($ss = mysql_fetch_assoc($s)) {
		?>
		<li>
		<?php
		if($ss['userwall'] == $usid) {
		?>
		<form action="" method="post">
									
									<input type="hidden" name="idd" value="<?=$ss['id']; ?>">
									<input type="submit" name="del" class="del_comm" value="" style="margin-top: 2px; margin-right: 2px;">
									
								</form>
								<? } ?>
								<?php
									$d = mysql_query("SELECT `ava` FROM tb_users WHERE id = '".$ss['user_id']."'") or die(mysql_error());
									$dd = mysql_fetch_assoc($d);
									?>
								<a href="/wall/user/<?=$ss['user_id'];?>">
								<?php
								if(!empty($dd['ava'])) {
								?>
								<img src="/<?=$dd['ava']; ?>" />
								<? } else { ?>
								<img src="/images/noavatar.png" />
								
								<? } ?>
								</a>
								<h2><?=$ss['login']; ?> (<?=date("d-m-Y H:i:s", $ss['date']); ?>)</h2>
								<span class="message">
									<em><?=$ss['text']; ?></em>
								</span>
							</li>
							
							<? } ?></ul>
							</div>
			<div id="formsgifts" style="display: none"></div>
<?php
}else{

?>
		
		
		
		
		
		
		
		<div align="right"><a href="#" id="btnClose">X</a></div>
		<u>Смена аватара</u><br>
		<br>
		Допускаются изображения формата jpg, gif, png.<br> объемом до 500 кб.<br>
		<br>
			 <form enctype="multipart/form-data" method="post" action="">
			   Путь к картинки: <input type="file" name="file" value=""><br>
			 <br>
				<input type="submit" name="Submit" class="buttonmail" value="Закачать">
			</form>
		</div>

 <div id="article">
    <div class="card-header">
	
	<?php
	if($mess) {
	echo $mess;
	}
	if($us_data['ava'] != '') {
	?>
      <img class="profile-photo" width="150" height="150" src="/<?=$us_data['ava']; ?>">
	  <? } else { ?>
	  <img class="profile-photo" width="150" height="150" src="/images/noavatar.png">
	  
	  <? } ?>
	  <div id="podarok">
			  </div>

      <a href="#"><button id="editavatar" type="button">Cменить аватар</button></a>
    </div>
   <ul class="card-links">
		<li>
		  <i class="icon icon-user"></i><span class="label">Уровень: <?=$us_data['level']; ?></span>
		</li>
		<hr>
		   <li class="active" style="padding: 17px 13px 0px 0px;">
								<i class="icon icon-list-alt"></i>
								 <?php
								$ff = explode(",", $us_data['frend']);															  
								$c = count($ff);
								
								$l = mysql_num_rows(mysql_query("SELECT * FROM tb_frend_wait WHERE user_id_1 = '$usid'"));
								 ?>
								<a href="/wall/myfriends"><span class="label">Друзья</span><span class="label-notification label-active"><?=$c;?></span></a>
								<br><br>
								<a href="/wall/friendsrequest"><span class="label">Заявки</span><span class="label-notification label-active"><?=$l; ?></span></a>

															   <div id="fr">
<?php

if(!empty($us_data['frend'])) {
$ff = explode(",", $us_data['frend']);															  
$c = count($ff);
for($i = 0; $i <= ($c-1); $i++) {
$e = mysql_query("SELECT * FROM tb_users WHERE username = '".$ff[$i]."'");	
$ee = mysql_fetch_assoc($e);
if(!empty($ee['ava'])) {
?>
	<a href="/wall/user/<?=$ee['id']; ?>"><img class="friends" title="<?=$ee['username'];?>" width="30" height="30" src="/<?=$ee['ava'];?>"></a>
<?	
}else{
?>
<a href="/wall/user/<?=$ee['id']; ?>"><img class="friends" title="<?=$ee['username'];?>" width="30" height="30" src="/images/noavatar.png"></a>
<?php
}	
												 
 }
 }
?>
															   
							
																</div>
							
																
																 <div id="fr">
<?php

if(!empty($us_data['gifts'])) {
$ff = explode(",", $us_data['gifts']);															  
$c = count($ff);
for($i = 0; $i <= ($c-1); $i++) {


?>
	<img class="friends" title="<?=$ee['username'];?>" src="/gifts/<?=$ff[$i];?>" width="30" height="30">
<?												 
 }
 }
?>
															   
							
																</div>
							</li>    
	</ul>  
  </div>
	<div id="inform">
		<div class="search">
		  <input class="search_box" type="checkbox" id="search_box">
		  <label class="icon-search" title="Найти фермера!" for="search_box"></label>
		  <div class="search_form" style="width: 216px;">
						
				<form action="" method="post">
				
				
				<input maxlength="30" type="text"name="searchvalue" placeholder="Логин фермера" value="">				
				<input type="submit" name="search" value="Найти">
				</form>
						
		  </div>
		 
		  <a href="/wall/edit"><span class="icon-search red" title="Редактировать стену"></span></a>
		  		</div>
	</div>
	<div id="inform">
		<b><?=$us_data['username']; ?> - 
		<?php
		if($us_data['name'] != '') {
		echo $us_data['name']; 
		}else{
		echo 'Не указано';
		}
		?>
		
		<?php
		if($us_data['famname'] != '') {
		echo $us_data['famname']; 
		}else{
		echo 'Не указано';
		}
		?>
		</b><br>
		<hr>
		День рождения: <b> 
		<?php
		if($us_data['date_r'] != '') {
		echo $us_data['date_r']; 
		}else{
		echo 'Не указано';
		}
		?>
		</b><br>
		В игре с: <b> <?=date("d.m.Y в H:i", $us_data['date_reg']); ?> </b><br>
		<?php
		switch($us_data['pol']) {
		case 1: $pol = 'Мужской'; break;
		case 2: $pol = 'Женский'; break;
		}
		
		?>
		Пол: <b><?=$pol;?></b><br>
		
		Город: <b>
		<?php
		if($us_data['city'] != '') {
		echo $us_data['city']; 
		}else{
		echo 'Не указано';
		}
		?>
		</b><br>

		Страна: <b>
		<?php
		if($us_data['strana'] != '') {
		echo $us_data['strana']; 
		}else{
		echo 'Не указано';
		}
		?>
		</b><br>
<br>
		О себе:<br>
		<?php
		if($us_data['osebe'] != '') {
		echo $us_data['osebe']; 
		}else{
		echo 'Не указано';
		}
		?>
			</div>

			

	<div id="inform" style="margin-right: 4px;">
	<input id="sendmessage" placeholder="Что вы думаете? &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
		<form id="formmessage" style="display: none;" action="" method="post">
			<textarea rows="5" cols="30" name="message" ></textarea>
			<label></label>
			
			<input type="hidden" name="stenaid" value="<?=$us_data['id']; ?>">
			<input type="submit" name="savecom" class="buttonmail" value="Оставить сообщение">
			<label></label>
			<span class="afterform">Цена сообщения - 10 ед. энергии<br> (реклама и ссылки запрещены)</span>
		</form>		</div>
		
		<div class="clear"></div>
		<div style="max-height: 975px; height: 975px; overflow-y: scroll">
		<ul id="people">
		<?php
		$s = mysql_query("SELECT * FROM tb_wall WHERE userwall = '".$us_data['id']."' ORDER BY id DESC") or die(mysql_error());
		while($ss = mysql_fetch_assoc($s)) {
		?>
		<li>
		<?php
		if($ss['userwall'] == $usid) {
		?>
		<form action="" method="post">
									
									<input type="hidden" name="idd" value="<?=$ss['id']; ?>">
									<input type="submit" name="del" class="del_comm" value="" style="margin-top: 2px; margin-right: 2px;">
									
								</form>
								<? } ?>
								<?php
									$d = mysql_query("SELECT `ava` FROM tb_users WHERE id = '".$ss['user_id']."'") or die(mysql_error());
									$dd = mysql_fetch_assoc($d);
									?>
								<a href="/wall/user/<?=$ss['user_id'];?>">
								<?php
								if(!empty($dd['ava'])) {
								?>
								<img src="/<?=$dd['ava']; ?>" />
								<? } else { ?>
								<img src="/images/noavatar.png" />
								
								<? } ?>
								</a>
								<h2><?=$ss['login']; ?> (<?=date("d-m-Y H:i:s", $ss['date']); ?>)</h2>
								<span class="message">
									<em><?=$ss['text']; ?></em>
								</span>
							</li>
							
							<? } ?>
							</ul>
							</div>
			<div id="formsgifts" style="display: none"></div>
			
			<? } ?>