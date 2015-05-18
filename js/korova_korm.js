
function korm_kur(num, i){

//var typesemena = 1;
//var typesemen = $("input[name=idkur]").val();
//var typesemen = document.getElementById('idkur').val();
var n;

$.ajax({
type: "POST",
dataType : "json",
url: "/ajax/korova_korm.php",
data: { 'func' : 'success', 'pole' : num, 'kuraid' : i}

}).done(function( data ) {

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

/*
var id = data.id;
$("#pole_"+id).remove();
$("#pole_"+id).after(function (){
return '<span id="timer'+id+'" style="display:none;"></span><script type="text/javascript">pole_timer(' + data.message + ', "timer'+id+'");<\/script>';
});
*/
if(n) {
n.setText('<b>' + data.message + '</b>');
n.setType("success");
} else {
n = noty({
text: '<b>' + data.message + '</b>',
animation: {
        open: {height: 'toggle'}, // jQuery animate function property object
        close: {height: 'toggle'}, // jQuery animate function property object
        easing: 'swing', // easing
        speed: 1000 // opening & closing animation speed
    },
type: "success",
dismissQueue: true,
layout: 'top',
theme: 'defaultTheme',
timeout: 4000,
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