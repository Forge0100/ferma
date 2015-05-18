<center> <div class="tegname"><h2>Отзывы о игре</h2></div> </center>
<br>
В этом разделе фермеры оставили свои отзывы о игре!<br>
<?php
if(isset($_SESSION['id'])) {
if(isset($_POST['otzyv'])) {
$text = sf($_POST['otzyv']);
if(!empty($text)) {
$q = $db->query("SELECT * FROM tb_otziv WHERE user_id = ?i", $_SESSION['id']);
if($db->numRows($q) == 0) {
$db->query("INSERT INTO tb_otziv SET ?u", array('user_id' => $_SESSION['id'], 'date' => time(), 'text' => $text));
echo '</br><font color="green">Ваш отзыв успешно добавлен</font></br>';
Header("Refresh: 2, /otzyvy"); return;

}else echo '</br><font color="red">Вы уже остоваляли отзыв</font></br>';

}else echo '</br><font color="red">Введите текст отзыва</font></br>';

}
?>

<?php
$qde = $db->query("SELECT * FROM tb_otziv WHERE user_id = ?i", $_SESSION['id']);
		if($db->numRows($qde) == 0) {
		echo '<form method="post" action="">
					<p>
						<label>Оставить отзыв (Можно оставить только 1 раз)</label>
						<textarea name="otzyv" rows="5" cols="40"></textarea><br />
						<input class="menubtn" type="submit" value="Оставить" />
					</p>
				</form>'; 
		}else{
		echo '</br><font>Вы уже остоваляли отзыв</font></br>';
		}
       ?>


<?php } ?>
<?php
$num = 10;  
$page = intval($_GET['str']);  
$posts = $db->getOne("SELECT COUNT(*) FROM tb_otziv");  
$total = intval(($posts - 1) / $num) + 1;  
$page = intval($page);  
if(empty($page) or $page < 0) $page = 1;  
  if($page > $total) $page = $total;  
$start = $page * $num - $num;  
$q = $db->query("SELECT * FROM tb_otziv ORDER BY id DESC LIMIT ?i, ?i", $start, $num);
if($db->numRows($q) > 0) {
while($w = $db->fetch($q)) {
$r = $db->getRow("SELECT * FROM tb_users WHERE id = ?i", $w['user_id']);
switch($r['pol']) {
case 1: $po = 'male'; break;
case 2: $po = 'female'; break;
default: $po = 'male'; break;
}
?>
<h3><?=$r['username']; ?> <img src="/images/<?=$po; ?>.png" alt=""> (<?=date("d.m.Y в H:i:s", $w['date']); ?>):</h3>
		<table>
		<tr style="background-color: #FFF;">
		<td>
		<a href="/wall/user/<?=$w['user_id']; ?>"><img width="70" height="70" src="<?php if($r['ava'] != '') echo '/'.$r['ava']; else echo '/images/noavatar.png'; ?>" alt="" title="Перейти на стену <?=$r['username']; ?> "></a>
		</td>
		<td style="width: 100%; text-align: left; padding: 5px; "> <?=$w['text']; ?></td>
		</tr>
		</table>
		<?php } 
		}else echo '<br>Отзывов пока не было<br>';
		
		
		?>
		
		<br><br>
		<?php 
		// Проверяем нужны ли стрелки назад  
if ($page != 1) $pervpage = '<a href= /otzyvy/str/1><<</a>  
                               <a href= /otzyvy/str/'. ($page - 1) .'><</a> ';  
// Проверяем нужны ли стрелки вперед  
if ($page != $total) $nextpage = ' <a href= /otzyvy/str/'. ($page + 1) .'>></a>  
                                   <a href= /otzyvy/str/' .$total. '>>></a>';  

// Находим две ближайшие станицы с обоих краев, если они есть  
if($page - 2 > 0) $page2left = ' <a href= /otzyvy/str/'. ($page - 2) .'>'. ($page - 2) .'</a> | ';  
if($page - 1 > 0) $page1left = '<a href= /otzyvy/str/'. ($page - 1) .'>'. ($page - 1) .'</a> | ';  
if($page + 2 <= $total) $page2right = ' | <a href= /otzyvy/str/'. ($page + 2) .'>'. ($page + 2) .'</a>';  
if($page + 1 <= $total) $page1right = ' | <a href= /otzyvy/str/'. ($page + 1) .'>'. ($page + 1) .'</a>'; 

// Вывод меню  
echo 'Страницы: '.$pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage;  
		
		
		$page = 'Отзывы';
		?>