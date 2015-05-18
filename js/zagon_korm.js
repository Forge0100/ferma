
function korm_kur(num, i, type){

//var typesemena = 1;
//var typesemen = $("input[name=idkur]").val();
//var typesemen = document.getElementById('idkur').val();
var n;

$.ajax({
type: "POST",
dataType : "json",
url: "/ajax/zagon_korm.php",
data: { 'func' : 'success', 'pole' : num, 'kuraid' : i, 'type' : type}

}).done(function( data ) {
jQuery('#loadA').load('#div #loadB');
jQuery('#loadBA').load('#div #loadGA');
var typeclick = data.typeclick;
var typeu = data.typeu;
var stil = data.stil;
var stildell = data.stildell;

if(typeclick == "pole_kupite") {
$("#pole_" + i).addClass(stil);
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
$.noty.closeAll();
if(n) {
n.setText('<b>' + data.message + '</b>');
n.setType(typeu);
} else {
n = noty({
text: '<b>' + data.message + '</b>',

type: typeu,
dismissQueue: false,
layout: 'top',
theme: 'defaultTheme',
timeout: false,
callback: {
afterClose: function() {
	n=null;
}
}
});
}
}
}).fail(function( jqXHR, textStatus ) {
alert( "Вы слишком часто нажимаете на поля!!!");
});
//e.preventDefault();
/*tip.on('click', '.close', function(e){                  
				
				tip.fadeOut(100);
				e.preventDefault();
			});*/
			
}


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


function pole_timer(c, tid, type_p, sem){
var timerdiv = document.getElementById(tid);
if (timerdiv == null) {
clearTimeout(this); return;
}
if(c<0) c=0;
if(c > 0){
timerdiv.innerHTML = "До сбора осталось: " + toFormattedTime(c--);
}else{
clearInterval(this);
timerdiv.innerHTML = "Можно собирать продукты";

return;
}
setTimeout(function(){pole_timer(c, tid)},1000);
}

jQuery(document).ready(function(){
setInterval("jQuery('#loadA').load('#div #loadB');",60000); //У меня интервал обновления блока - минута
});