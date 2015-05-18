<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
                    <h3>Новости</h3> 
	
	<?php
	if(isset($_POST['save1'])) {
	$title = sf($_POST['title']);
	$text = mysql_real_escape_string($_POST['text']);
	$id_n = intval($_POST['id_n']);
	//mysql_query("INSERT INTO tb_news (`title`, `text`, `date`) VALUES ('$title', '$text', '".time()."')") or die(mysql_error());
	mysql_query("UPDATE tb_news SET `title` = '$title', `text` = '$text' WHERE id = '$id_n'");
	echo '<center><font color="green">Новость обновлена</font></center>';
					Header("Refresh: 2, /adminka/news");
	}
	
	
	if(isset($_GET['read'])) {
	$id = intval($_GET['read']);
	$q = mysql_fetch_assoc(mysql_query("SELECT * FROM tb_news WHERE id = '$id'"));
	?>
	<form id="form1" name="form1" method="post" action="">
	<input type="hidden" name="id_n" value="<?=$q['id'];?>">
	<table align="center">
	<tr>
	<td style="width:100px;">Название новости</td><td><input type="text" name="title" value="<?=$q['title']; ?>" /></td>
	</tr>
	<tr>
	<td  style="width:100px;">Текст новости</td><td>
<textarea name="text" id="editor1" cols="45" rows="5"><?=$q['text']; ?></textarea></td>
</tr>
<tr><td colspan="2"><input type="submit" name="save1" value="Обновить"></td></tr>
<script type="text/javascript">
CKEDITOR.replace( 'editor1');
</script>

</table>
	</form>
	
	
	
	
	<?php
	return;
	}
	
	
	
	if(isset($_POST['save'])) {
	$title = sf($_POST['title']);
	$text = mysql_real_escape_string($_POST['text']);
	mysql_query("INSERT INTO tb_news (`title`, `text`, `date`) VALUES ('$title', '$text', '".time()."')") or die(mysql_error());
	echo '<center><font color="green">Новость добавлена</font></center>';
					Header("Refresh: 2, /adminka/news");
	}
	
	
	if(isset($_GET['add'])) {
	?>
	<form id="form1" name="form1" method="post" action="">
	<table align="center">
	<tr>
	<td style="width:100px;">Название новости</td><td><input type="text" name="title"></td>
	</tr>
	<tr>
	<td  style="width:100px;">Текст новости</td><td>
<textarea name="text" id="editor1" cols="45" rows="5"></textarea></td>
</tr>
<tr><td colspan="2"><input type="submit" name="save" value="Добавить"></td></tr>
<script type="text/javascript">
CKEDITOR.replace( 'editor1');
</script>

</table>
	</form>
	
	<?php
	return;
	}
	?>
	
	
					<br><hr><br>					
					<a href="/adminka/news/add">Добавить новость</a>	
	
					<br><br><hr>					
				   <table>
						<thead>
							<tr>
                            	<th>ID</th>
                                <th>Название</th>
                               
                                <th>Действие</th>
                            </tr>
						</thead>
						<tbody>
						<?php
						$q = mysql_query("SELECT * FROM tb_news ORDER BY id DESC") or die(mysql_error());
						while($w = mysql_fetch_assoc($q)) {
						?>
							<tr align="center">
                            	<td><?=$w['id']; ?></td>
                                <td><?=$w['title']; ?></td>
                                
                                <td>

								<a href="/adminka/news/read/<?=$w['id']; ?>"><img src="img/icons/page_white_edit.png" title="Редактировать пользователя" /></a>
								<a href="/adminka/news/dell/<?=$w['id']; ?>"><img src="img/icons/page_white_delete.png" title="Удалить пользователя" /></a>
								</td>
                            </tr>
						<? } ?>
						</tbody>
					</table>
					
					
					<br><hr><br>
					
