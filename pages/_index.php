 <?php
$page = 'Главная страница';
?>
 
 <?php
 $q = $db->getRow("SELECT * FROM tb_page WHERE id = 3");
 ?>
 
  <div class="tegname"><h2><?=$q['name']; ?></h2>
  </div>
 
 <p><?=$q['text']; ?></p>