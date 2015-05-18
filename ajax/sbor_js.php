<?php
ob_start(); 
?>
function MyClick(pol) 
		{
			var s = pol;
			s = s.substr(8); 
			s = s.substr(0, s.indexOf(")"));
			var num = s;
			var typesemena = $("input[name=semena]:checked").val();
			var udob = $("input[name=udob]:checked").val();
			$.post("/ajax/ajax.php", 
			{'func' : 'success', 'pole' : num, 'type' : typesemena, 'udob' : udob},
			function(data)
			{	
							
			})
		}


		function sbor()
		{
			$(".pole_img.gotovo1").find("div").each(function (i) 
			{
       			var hr = $(this).attr('onclick');
      			MyClick(hr);
      		});
		}

		function posev() 
		{
			$(".pole_img:not(.pole_kupit)").filter(":not(.pole_kupite)").find("div").each(function (i) 
			{
       			var hr = $(this).attr('onclick');
      			MyClick(hr);
      		});
		}


		function DoMyStart() 
		{
			sbor();
			posev();
			setTimeout(function() {sbor();posev();},2000);
		}


DoMyStart();

<?php
$data = ob_get_contents();
ob_end_clean();
?>


<?php
// собираем для кур и т.д.
ob_start(); 
?>
function MyClick(pol) 
		{
			var s = pol; 
			s = s.substr(5); 
			var num = s;
			for (var i = 1; i <=9 ; i++) 
			{
				$.post("/ajax/zagon_korm.php", 
				{'func' : 'success', 'pole' : num, 'kuraid' : i, 'type' : %TYPE%});
			};
		}


		function sbor()
		{
			$(".pole_img.zagon%TYPE%").each(function (i) 
			{
       			var hr = $(this).attr('id');
      			MyClick(hr);
      		});
		}

		function DoMyStart() 
		{
			sbor();
			setTimeout(function() {sbor();},2000);
		}


DoMyStart();

<?php
$data2 = ob_get_contents();
ob_end_clean();


function GetJS_pole()
{
	global $data;
	return $data;
}


function GetJS_JIV()
{
	global $data2;
	return $data2;
}