 <?php
 $q = $db->getRow("SELECT * FROM tb_page WHERE id = 5");
 ?>
 
 <div class="tegname"><h2><?=$q['name']; ?></h2></div>
 
 <p><?=$q['text']; ?></p>
 
  <?php
 $page = 'Контакты';
 ?>