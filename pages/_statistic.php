<center> <div class="tegname"><h2>Статистика фермы</h2></div><br> </center>
<?php
 <script type="text/javascript" src="//www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
	<?php
	$q = $db->query("SELECT * FROM tb_pole WHERE pay = 1");
	$pole = $db->numRows($q);
	
	$q1 = $db->query("SELECT * FROM tb_kura WHERE pay = 1");
	$kur = $db->numRows($q1);
	
	$q12 = $db->query("SELECT * FROM tb_svin WHERE pay = 1");
	$svin = $db->numRows($q12);
	
	$q123 = $db->query("SELECT * FROM tb_slon WHERE pay = 1");
	$slon = $db->numRows($q123);
	
	$q1234 = $db->query("SELECT * FROM tb_lama WHERE pay = 1");
	$lama = $db->numRows($q1234);
	
	$q12345 = $db->query("SELECT * FROM tb_ovta WHERE pay = 1");
	$ovta = $db->numRows($q12345);
	
	$q123456 = $db->query("SELECT * FROM tb_korova WHERE pay = 1");
	$korova = $db->numRows($q123456);
	
	
	
	?>
    <script type="text/javascript">
      function drawVisualization() {
              var data = google.visualization.arrayToDataTable([
          ['x', 'Кур', 'Свиней', 'Овец', 'Коров', 'Лам', 'Слонов']
		  ,
		  <?php
		  $ee = time() - (60*60*24*30*12);
		  $r = $db->query("SELECT * FROM tb_stat_and WHERE date > ?s", $ee);
		  $i = $db->numRows($r);
		  while($tt = $db->fetch($r)) {
		  ?>
		  ['<?=date("Y-m-d", $tt['date']); ?>', <?=$tt['q1']; ?>, <?=$tt['q2']; ?>, <?=$tt['q3']; ?>, <?=$tt['q4']; ?>, <?=$tt['q5']; ?>, <?=$tt['q6']; ?>] <?php if($i == 1) echo ''; else echo ','; ?>
		  <?php 
		  $i--;
		  ?>
<?php } ?>
		  ]);
      
		var options = {
          title: 'Статистика проданых животных',
		  width: 500, height: 300
        };
		
        // Create and draw the visualization.
		 var chart = new google.visualization.LineChart(document.getElementById('visualization'));

        chart.draw(data, options);
		//==============================================
		// Create and populate the data table.
        var data = google.visualization.arrayToDataTable([
          ['x', 'Пользователей']
		  ,
		  <?php
		  $ee = time() - (60*60*24*30);
		  $r = $db->query("SELECT * FROM tb_stat_user_reg WHERE date >= ?s", $ee);
		  if($db->numRows($r) == 0) {
		  ?>
		  ['0000-00-00', 0]
		  <?php
		  }else{
		  $p = $db->numRows($r);
		  
		  while($t = $db->fetch($r)) {
		  ?>
		  ['<?=date("Y-m-d", $t['date']); ?>', <?=$t['kol']; ?>]<?php if($p == 1) echo ''; else echo ','; ?>
		  <?php
		  $p--;
		  ?>
		  <?php } }?>
        ]);
      
		var options = {
          title: 'Новых пользователей за последний месяц',
		  width: 500, height: 300
        };
        // Create and draw the visualization.
		 var chart = new google.visualization.ColumnChart(document.getElementById('newusers'));
        chart.draw(data, options);
	  //====================================
      } 
	  
		function drawVisualization2()  {
		// Create and populate the data table.
		  var data = google.visualization.arrayToDataTable([
		  /*
			['Животных', 'Количество'],
			['Кур', 7858358],
			['Свиней', 5015271],
			['Овец', 2910339],
			['Коров', 2176504],
			['Лам', 61862],
			['Слонов', 5586]
			*/
			<?php
			$q = $db->numRows($db->query("SELECT * FROM tb_stat_z WHERE type = 1"));
			$q1 = $db->numRows($db->query("SELECT * FROM tb_stat_z WHERE type = 2"));
			$q3 = $db->numRows($db->query("SELECT * FROM tb_stat_z WHERE type = 3"));
			$q4 = $db->numRows($db->query("SELECT * FROM tb_stat_z WHERE type = 4"));
			$q5 = $db->numRows($db->query("SELECT * FROM tb_stat_z WHERE type = 5"));
			$q6 = $db->numRows($db->query("SELECT * FROM tb_stat_z WHERE type = 6"));
			?>
			['Животных', 'Кур: ', 'Свиней: ','Овец: ','Коров: '],
			['Количество животных', <?=$q; ?>, <?=$q1; ?>, <?=$q3; ?>, <?=$q4; ?>]

			
		  ]);
			  
		  // Create and draw the visualization.
		  new google.visualization.ColumnChart(document.getElementById('visualization2')).
			  draw(data, {title:"Продано животных"});
			  
			 var data = google.visualization.arrayToDataTable([
			['Животных','Лам: ','Слонов: '],
			['Количество животных', <?=$q5; ?>, <?=$q6; ?>]

			
		  ]);
			  
		  // Create and draw the visualization.
		  new google.visualization.ColumnChart(document.getElementById('visualization2a')).
			  draw(data, {title:"Продано животных"});
			  
			var data = google.visualization.arrayToDataTable([
			['Полей', 'Количество'],
			['Полей', <?=$pole; ?>]
			
		  ]);

		  // Create and draw the visualization.
		  new google.visualization.PieChart(document.getElementById('visualization3')).
			  draw(data, {title:"Куплено Полей"});
			  
			
			  
			var data = google.visualization.arrayToDataTable([
			['Куплено', 'Количество'],
			['Курятник', <?=$kur; ?>],
			['Свинарник', <?=$svin; ?>],
			['Овчарня', <?=$ovta; ?>],
			['Коровник', <?=$korova; ?>],
			['Ламовник', <?=$lama; ?>],
			['Слоновник', <?=$slon; ?>]
		  ]);

		  // Create and draw the visualization.
		  new google.visualization.PieChart(document.getElementById('visualization4')).
			  draw(data, {title:"Куплено Загонов"});  
			  
		}
	 
	 

      google.setOnLoadCallback(drawVisualization);
      google.setOnLoadCallback(drawVisualization2);
    </script>
	
	<div class="vizual" id="newusers" style="width: 500px; height: 300px;"></div>
	<div class="vizual" id="visualization" style="width: 500px; height: 300px;"></div>
	<div class="vizual" id="visualization2" style="width: 500px; height: 250px; "></div> 
	<div class="vizual" id="visualization2a" style="width: 500px; height: 250px; "></div>
	
	<div class="vizual" id="visualization4" style="width: 500px; height: 250px;"></div>
	<div class="vizual" id="visualization3" style="width: 245px; height: 250px;"></div> 
	                            
                       

             
		  
	