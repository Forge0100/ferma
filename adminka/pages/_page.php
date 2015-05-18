  <script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
<div id="rightnow">
  <div id="box">
  <h3>Список страниц</h3> 
  
  <?php
  if(isset($_POST['save1'])) {
  $idp = intval($_POST['id_n']);
  $name = sf($_POST['title']);
  $text = $_POST['text'];
  mysql_query("UPDATE tb_page SET name = '$name', text = '$text' WHERE id = '$idp'");
  echo '<center><font color="green">страница обновлена</font></center>';
					Header("Refresh: 2, /adminka/page");
  }
  
  
  if(isset($_GET['read'])) {
  $id = intval($_GET['read']);
	$q = mysql_fetch_assoc(mysql_query("SELECT * FROM tb_page WHERE id = '$id'"));
	?>
	<form id="form1" name="form1" method="post" action="">
	<input type="hidden" name="id_n" value="<?=$q['id'];?>">
	<table align="center">
	<tr>
	<td style="width:100px;">Название страницы</td><td><input type="text" name="title" value="<?=$q['name']; ?>" /></td>
	</tr>
	<tr>
	<td  style="width:100px;">Текст страницы</td><td>
<textarea name="text" id="editor1" cols="45" rows="5"><?=$q['text']; ?></textarea></td>
</tr>
<tr><td colspan="2"><input type="submit" name="save1" value="Обновить"></td></tr>
<script type="text/javascript">
CKEDITOR.replace( 'editor1');
</script>

</table>
	</form>
  
  </div> 
			  </div>
  <?php
  return;
  }
  ?>
  
  <br>
 <?php
 $q = mysql_query("SELECT * FROM tb_page");
 while($w = mysql_fetch_assoc($q)) {
 ?>
 
 <a href="/adminka/page/read/<?=$w['id']; ?>"><?=$w['name']; ?> -> Редактировать</a><br><hr><br>
 <? } ?>
  
  	     </div> 
			  </div>
  
  