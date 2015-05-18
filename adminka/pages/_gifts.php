	<div id="rightnow">
<?php
if (isset($_FILES['file'])) {
$price = $_POST['price'];
    $f_err     = 0; //вспомогательная переменная
    $types     = array(
        '.jpg',
        '.JPG',
        '.jpeg',
        '.gif',
        '.png'
    ); //поддерживаемые форматы загружаемых файлов
    $max_size  = 5020500; //максимальный размер загружаемого файла (5000-МБ)
    $path      = '../gifts/'; //директория для загрузки
    $path_mini = '../gifts/'; //директория для загрузки миниатюры
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
       // move_uploaded_file($_FILES['file']['tmp_name'], $path . $fname);

        //путь к загруженному файлу
       // $source_src = $path . $fname;
        $source_src = $_FILES['file']['tmp_name'];

        //создаем путь и имя миниатюры
        $new_name     = time() . $ext;
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
				
			 case 3:
                $source = imagecreatefrompng($source_src);
                break;
			default:  $source = imagecreatefrompng($source_src); break;
        }

        //если высота больше ширины
        //вычисляем новую ширину
        if ($params[1] > $params[0]) {
            $newheight = 70;
            $newwidth  = floor($newheight * $params[0] / $params[1]);
        }
        //если ширина больше высоты
        //вычисляем новую высоту
        if ($params[1] < $params[0]) {
            $newwidth  = 70;
            $newheight = floor($newwidth * $params[1] / $params[0]);
        }
		
		 if ($params[1] == $params[0]) {
            $newwidth  = 70;
            $newheight = 70;
        }


        //создаем миниатюру загруженного изображения
		
        $resource = imagecreatetruecolor($newwidth, $newheight);
		$white = imagecolorallocate($resource, 255, 255, 255);
		imagefilledrectangle($resource, 0, 0, 70, 70, $white);
        imagecopyresampled($resource, $source, 0, 0, 0, 0, $newwidth, $newheight, $params[0], $params[1]);
        imagejpeg($resource, $resource_src, 80); //80 качество изображения

        //назначаем права доступа
        //chmod("$source_src", 0644);
        chmod("$resource_src", 0644);

$file = str_replace($_SERVER['DOCUMENT_ROOT'], '/', $new_name); // получить путь вида '/img/avatars/15.jpg'

//mysql_query("UPDATE tb_users SET ava = '$file' WHERE id = '$usid'") or die(mysql_error());
mysql_query("INSERT INTO tb_gifts (price, img) VALUES ('$price', '$file')");
//header('Refresh: 1;URL=/wall');
        //выводим сообщение
        $mess = '<center><br><p style="color:green;">Изображение загружено !</p></center>';
        $ok   = 1;
    }




}
if(isset($_GET['dell'])) {
$dell = intval($_GET['dell']);
mysql_query("DELETE FROM tb_gifts WHERE id = '$dell'");

}
?>
				   <div id="box">
                	<h3 id="adduser">Подарки</h3>
					<h2>Добавить подарок</h2>
					<br>
					<form method="post" action="" enctype="multipart/form-data">
					<table align="center">
					<tr>
					<td>Цена подарка: </td><td><input type="text" name="price"></td>
					</tr>
					
					<tr>
					<td>Картинка: </td><td> <input type="file" name="file" value=""></td>
					</tr>
					
					<tr>
					<td> </td><td><input type="submit" name="save" value="Добавить"></td>
					</tr>
					
					</table>
					</form>
					
					
					<br>
					<h2>Созданные подарки</h2>
					
					 <link rel="stylesheet" type="text/css" media="screen,projection,print" href="/css/wall.css">
					 <br>
					 Что бы удалить подарок, просто нажмите на его изображение!<br>
					<?php
							$g = mysql_query("SELECT * FROM tb_gifts ORDER BY id DESC");
							while($f = mysql_fetch_assoc($g)) {
							?>
							
											<label><a href="/adminka/gifts/dell/<?=$f['id'];?>"><img src="/gifts/<?=$f['img'];?>"></a>
											 </label>
										
							<? } ?>	
					
					     </div> 
			  </div>