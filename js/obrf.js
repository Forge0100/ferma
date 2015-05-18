
function pay_pol_new(num, type, is_build){
	//alert(1);
	var typesemena = $("input[name=fab]:checked").val();
	var n;
	
	if(type != typesemena && is_build != 1)
	{
		if(type == 1) var type_str = 'Тесто';
		if(type == 2) var type_str = 'Фарш';
		if(type == 3) var type_str = 'Сыр';
		if(type == 4) var type_str = 'Сметана';
		
		$.noty.closeAll();
		n = noty({
				text: '<b>Это место предназначено для фабрики: ' + type_str + '</b>',
				type: 'error',
				dismissQueue: true,
				layout: 'top',
				theme: 'defaultTheme',
				timeout: false,
				callback: {
					afterClose: function() {n=null;}
				}
			});
	}
	else
	{
	
	$.ajax({
		type: "POST",
		dataType: "json",
		url: "/ajax/f.php",
		data: {'func' : 'success', 'pole' : num, 'type' : type}
	}).done(function(data){
		
		//console.log(data);
		
		$.ajax({
			url: "/ajax/upd.php",
			dataType: "json",
			success: function(data){
				if(data != null){
					var items = [];
					$.each(data, function(key, val) {
						$.each(val, function(k, v) {
							items.push($("#pole_" + k).addClass("gotovo"+v));
						});
					});
				}
			}
		});
		
		var typeclick = data.typeclick;
		var typeu = data.typeu;
		
		$.noty.closeAll();
		if(typeclick == "pole_kupite") {
			$("#pole_" + num).removeClass("fabrika1");
		}
		
		if(data.lvlup != "bad")
		{
			$('.overlay-container').fadeIn(function() {
				window.setTimeout(function(){
					$('.window-container.zoomin').find('h3').html(data.lvlup);
					$('.window-container.zoomin').addClass('window-container-visible');
					$('.overlay-container').css({'display':'block', 'top':'0'});
				}, 100);
			});
		}
		else
		{
		if(n){
			n.setText('<b>' + data.message + '</b>');
			n.setType(typeu);
		}else{
			n = noty({
				text: '<b>' + data.message + '</b>',
				type: typeu,
				dismissQueue: true,
				layout: 'top',
				theme: 'defaultTheme',
				timeout: false,
				callback: {
					afterClose: function() {n=null;}
				}
			});
			
			jQuery('#loadA').load('#div #tabs_pole_container', function(){
				fix_tab(num);
			});
		}	
		}
	}).fail(function( jqXHR, textStatus ) {
		alert( "Вы слишком часто нажимаете на поля!");
	});
	
	}
}

function fix_tab(num){
	$('.tab_content').css({'display':'none'});
	
	var pages = num / 135;
	var page = Math.ceil(pages);
	if(page > 0)
	{
		$('#pole' + page).css({'display':'block'});
	}
}

function pay_pol(num){

var typesemena = $("input[name=fab]:checked").val();
var n;

$.ajax({
type: "POST",
dataType : "json",
url: "/ajax/f.php",
data: { 'func' : 'success', 'pole' : num, 'type' : typesemena}

}).done(function( data ) {
jQuery('#loadA').load('#div #loadB');
jQuery('#loadBA').load('#div #loadGA'); 
$.ajax({
  url: "/ajax/upd.php",
  dataType : "json",
  success: function(data) { 
  if (data!=null){
  var items = [];
  $.each(data, function(key, val) {
  $.each(val, function(k, v) {
  items.push($("#pole_" + k).addClass("gotovo"+v));
  });
  });
  }
  jQuery('#loadBA').load('#div #loadGA');
  }
 });


var typeclick = data.typeclick;
var typeu = data.typeu;
$.noty.closeAll();
if(typeclick == "pole_kupite") {
$("#pole_" + num).removeClass("fabrika1");
}
/*
var id = data.id;
$("#pole_"+id).remove();
$("#pole_"+id).after(function (){
return '<span id="timer'+id+'" style="display:none;"></span><script type="text/javascript">pole_timer(' + data.message + ', "timer'+id+'");<\/script>';
});
*/
if(n) {
n.setText('<b>' + data.message + '</b>');
n.setType(typeu);
} else {
n = noty({
text: '<b>' + data.message + '</b>',

type: typeu,
dismissQueue: true,
layout: 'top',
theme: 'defaultTheme',
timeout: false,
callback: {
afterClose: function() {n=null;}
}
});
}
}).fail(function( jqXHR, textStatus ) {
alert( "Вы слишком часто нажимаете на поля!");
});
e.preventDefault();
tip.on('click', '.close', function(e){                  
				tip.fadeOut(100);
				e.preventDefault();
			});
			
}
$( document ).ready(function() {
  upd();
setInterval(upd, 60000);

function upd() {
$.ajax({
  url: "/ajax/upd.php",
  dataType : "json",
  success: function(data) { 
  if (data!=null){
  var items = [];
  $.each(data, function(key, val) {
  $.each(val, function(k, v) {
	items.push($("#pole_" + k).addClass("gotovo"+v));
	});
  });
  }
  }
 });
}
});

function toFormattedTime(input){
    input = Math.ceil(input); // На случай, если дробное
    var hoursString = '00';
    var minutesString = '00';
    var secondsString = '00';
    var hours = 0;
    var minutes = 0;
    var seconds = 0;
    hours = Math.floor(input / (60 * 60));
    input = input % (60 * 60);
    minutes = Math.floor(input / 60);
    input = input % 60;
    seconds = input;
    hoursString = (hours >= 10) ? hours.toString() : '0' + hours.toString();
    hoursString = (hours > 0) ? hoursString + 'ч. ' : '';
    minutesString = (minutes >= 10) ? minutes.toString() : '0' + minutes.toString();
    minutesString = (minutes > 0) ? minutesString + 'м. ' : '';
    secondsString = (seconds >= 10) ? seconds.toString() : '0' + seconds.toString();
    return hoursString + minutesString + secondsString + 'с.';
}


function pole_timer(c, tid){
var timerdiv = document.getElementById(tid);
if (timerdiv == null) {
clearTimeout(this); return;
}
if(c<0) c=0;
if(c > 0){
timerdiv.innerHTML = "До сбора осталось: " + toFormattedTime(c--);
}else{
clearInterval(this);
timerdiv.innerHTML = "Можно собирать урожай";
return;
}
setTimeout(function(){pole_timer(c, tid)},1000);
}

jQuery(document).ready(function(){
//setInterval(function(){ jQuery('#loadA').load('#div #tabs_pole_container', function(){ fix_tab(); }); },4000);
//setInterval("jQuery('#loadA').load('#div #tabs_pole_container');",4000); //У меня интервал обновления блока - минута
});