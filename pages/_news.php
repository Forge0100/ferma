<?php
	function getCommentRow($news_id)
	{
		global $db;
		$com_sql = $db->query("select id, idp, user_id, text, time  from tb_comment where module = 'news' and module_id = ?i ORDER BY id", $news_id);
		if($com_count = $db->numRows($com_sql))
		{
			return $com_count;
		}
		
		return 0;
	}
	
	function getPagesNews($num = 5)
	{
		$pages = ($_GET['str'] > 0) ? intval($_GET['str']) : 1;  
		global $db;
		$posts = $db->numRows($db->query("SELECT id FROM tb_news"));
		
		$total = intval(($posts - 1) / $num) + 1;  
		$pages = ($pages > $total) ? $total : intval($pages);    
		$start = $pages * $num - $num;  
		
		$arr = array();
		$arr['pages'] = $pages;
		$arr['total'] = $total;
		$arr['start'] = $start;
		$arr['num'] = $num;
		return $arr;
	}
?>


 <div class="tegname"><h2>Новости проекта</h2></div>
<div style="color: #0375a0;">


<?php if($_GET['id'] > 0) : ?>
	<?php
		$page = 'Новость';
		$news_id = intval($_GET['id']);

		if(isset($_POST['text']) && !empty($_POST['text']))
		{
			if($us_data['energy'] >= 1)
			{
				$text = $_POST['text'];
				$idp = getUserId(array_shift(explode(',', $text)));
				$time = time();
				$user_id = $_SESSION['id'];
				$db->query("update tb_users set energy = energy - 1 where id = ?i", $user_id);
				$db->query("insert into tb_comment set ?u", array('idp' => $idp, 'user_id' => $user_id, 'text' => $text, 'module' => 'news', 'module_id' => $news_id, 'time' => $time));
			}
			else
			{
				$error = "У вас недостаточно энергии.";
			}
		}
		
		$result = $db->getRow("SELECT * FROM tb_news WHERE id = ?i LIMIT 1", $news_id);
		$com_sql = $db->query("select id, idp, user_id, text, time  from tb_comment where module = 'news' and module_id = ?i ORDER BY id", $news_id);
		$com_count = $db->numRows($com_sql);
		
		if($com_count > 3) $com_hidden_count = $com_count - 3; 
	?>
	<h3><?=$result['title']; ?></h3>
	<p><?=$result['text']; ?></p>
	<p class="comments align-left clear"> <?=date("d.m.Y в H:i", $result['date']); ?> </p>
	
	<h4>Оставить комментарий (Стоимость 100 ед. энергии)</h4>
	<?php if($_SESSION['id']) : ?>
	<form action="" method="post">
		<input name="idp" id="idp" value="0" type="hidden" />
		<textarea name="text" id="text" style="width: 324px; height: 75px; margin-top: 5px; padding: 5px;"></textarea>
		<input style="background-color: mediumblue; color: #fff; margin-top: 5px; padding: 5px 20px;" type="submit" value="Отправить" />
	</form>
	<?php else : ?>
	<div style="width: 100%; height: 25px; background-color: red; color: #fff; padding: 10px; margin-top: 5px;">Оставить комментарий могут только авторизованные пользователи.</div>
	<?php endif; ?>
	
	<h4 id="comment" style="margin-top: 20px;">Комментарии (<?php echo $com_count; ?>)</h4>
	
	<?php if($com_count > 0) : ?>
	<?php if($com_hidden_count > 0) : ?><div class="com-all" style="background-color: blue; color: #fff; width: 100%; text-align: center; margin-top: 10px; padding: 10px 0; cursor: pointer;">Показать все <?php echo $com_count; ?> комментария</div><?php endif; ?>
	<?php while($comment = $db->fetch($com_sql)) : ?>
		<?php $user_data = getUserData($comment['user_id']); ?>
		<div class="comment-block" style="margin-top: 10px; <?php echo ($com_hidden_count > 0) ? "display: none;" : ""; ?>">
			<p style="margin-bottom: 4px;"><b class="username"><?php echo $user_data['username']; ?></b> <img src="/images/<?php echo $pol_u; ?>" /> (<?php echo date('d.m.Y в H:i', $comment['time']); ?>) <a class="reply" style="cursor: pointer;" >Ответить</a></p>
			<table style="width: 100%;"><tr style="background: none;"><td style="width: 50px; padding: 0;"><img style="width: 50px;" src="<?php echo ($user_data['ava']) ? $user_data['ava'] : "/images/noavatar.png"; ?>" /></td><td style="text-align: left; "><?php echo $comment['text']; ?></td></tr></table>
		</div>
	<?php $com_hidden_count--; endwhile; ?>
	<script>
		$('.reply').click(function(){
			var username = $(this).parent().find('.username').html();
			$('#text').html(username + ', ');
		});
		
		$('.com-all').click(function(){
			$('.comment-block').css({'display':'block'});
			$('.com-all').remove();
		});
	</script>
	<?php else : ?>
	<p style="margin-top: 10px;">Нет комментариев. Будь первым!</p>
	<?php endif; ?>
<?php else : ?>
	<?php
		$page = "Список новостей";
		$pagination = getPagesNews(5);
		$result = $db->query("SELECT * FROM tb_news LIMIT ?i, ?i", $pagination['start'], $pagination['num']);	
	?>
	<?php while($w = $db->fetch($result)) : ?>
	<h3><a href="/news/<?php echo $w['id']; ?>"><?=$w['title']; ?></a></h3>
	<div style="max-height: 75px; overflow: hidden;"><p><?=$w['text']; ?></p></div>
	<p class="comments align-left clear">
		<a href="/news/<?=$w['id']?>#comment">Комментариев (<?php echo getCommentRow($w['id']); ?>)</a> : <?=date("d.m.Y в H:i", $w['date']); ?>
	</p>
	<?php endwhile; ?>
	<?php
	// Проверяем нужны ли стрелки назад  
if ($pagination['pages'] != 1) $pervpage = '<a href= /news'.$pagination['href'].'/str/1><<</a> <a href= /news'.$pagination['href'].'/str/'. ($pagination['pages'] - 1) .'><</a> ';  
// Проверяем нужны ли стрелки вперед  
if ($pagination['pages'] != $pagination['total']) $nextpage = ' <a href= /news'.$pagination['href'].'/str/'. ($pagination['pages'] + 1) .'>></a>  
                                   <a href= /news'.$pagination['href'].'/str/' .$pagination['total']. '>>></a>';  

// Находим две ближайшие станицы с обоих краев, если они есть  
if($pagination['pages'] - 2 > 0) $page2left = ' <a href= /news'.$pagination['href'].'/str/'. ($pagination['pages'] - 2) .'>'. ($pagination['pages'] - 2) .'</a> | ';  
if($pagination['pages'] - 1 > 0) $page1left = '<a href= /news'.$pagination['href'].'/str/'. ($pagination['pages'] - 1) .'>'. ($pagination['pages'] - 1) .'</a> | ';  
if($pagination['pages'] + 2 <= $pagination['total']) $page2right = ' | <a href= /news'.$pagination['href'].'/str/'. ($pagination['pages'] + 2) .'>'. ($pagination['pages'] + 2) .'</a>';  
if($pagination['pages'] + 1 <= $pagination['total']) $page1right = ' | <a href= /news'.$pagination['href'].'/str/'. ($pagination['pages'] + 1) .'>'. ($pagination['pages'] + 1) .'</a>'; 

// Вывод меню  
echo 'Страницы: '.$pervpage.$page2left.$page1left.'<b>'.$pagination['pages'].'</b>'.$page1right.$page2right.$nextpage; 
	?>
<?php endif; ?>
</div>

<?php if($error) : ?>	
<script src="/js/jquery.noty.packaged.min.js" type="text/javascript"></script>
<script> var n; $.noty.closeAll(); n = noty({text: '<b><?php echo $error; ?></b>', type: 'error'}); </script>		
<?php endif; ?>				