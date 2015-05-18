function fix_tab(page){
	$('.tab_content').css({'display':'none'});
	
	if(page > 0) 
	{
		$('#pole' + page).css({'display':'block'});
	}
	else
	{
		$('#pole1').css({'display':'block'});
	}
}

function count_page(num, type)
{
	switch(type)
	{
		case '1' :
			var first = 9;
			var sub = 0;
			break;
		case '2' :
			var first = 13;
			var sub = 4;
			break;
		case '3' :
			var first = 18;
			var sub = 9;
			break;
		case '4' :
			var first = 23;
			var sub = 14;
			break;
		case '5' :
			var first = 28;
			var sub = 19;
			break;
		case '6' :
			var first = 33;
			var sub = 24;
			break;			
	}
	
	var pages = (num - sub) / 9;
	var page = Math.ceil(pages);
	
	return page;
}

function pay_pol(num){
var tip = $('.answer').hide();
var typesemena = $("input[name=semena]:checked").val();
var udob = $("input[name=udob]:checked").val();
var n;
var cod1=-2,cod2=-2;
            document.onmousemove = function(e){
                cod1=-3,cod2=-3;
                e = e || window.event;
                cod1=e.clientX; cod2=e.clientY;
};

var page = count_page(num, typesemena);

$.ajax({
type: "POST",
dataType : "json",
url: "/ajax/ajax.php",
data: { 'func' : 'success', 'pole' : num, 'type' : typesemena, 'udob' : udob}
}).done(function( data ) {
jQuery('#loadA').load('#div #loadB', function(){ fix_tab(page); });
jQuery('#loadBA').load('#div #loadGA'); 

var typeclick = data.typeclick;
var typeu = data.typeu;
$.noty.closeAll();
if(typeclick == "pole_kupit") {
$("#pole_" + num).toggleClass("pole_kupite", false);
$("#pole_" + num).toggleClass("pl_k", true);
}else if(typeclick == "posadil") {
$("#pole_" + num).addClass("posadil" + data.type);
}else if(typeclick == "udobrit") {
$("#pole_" + num).addClass("udobreno" + data.type);
var udob = $("#span_udobrenie").text();
udob = udob - 1;
$("#span_udobrenie").html(udob);
}else if(typeclick == "sobrat") {
$("#pole_" + num).removeClass("gotovo" + data.type);
$("#pole_" + num).removeClass("udobreno" + data.type);
$("#pole_" + num).removeClass("posadil" + data.type);
var korm = $("#span_korm"+data.type).text();
korm ++;
$("#span_korm"+data.type).html(korm); 
}
/*
var id = data.id;
$("#pole_"+id).remove();
$("#pole_"+id).after(function (){
return '<span id="timer'+id+'" style="display:none;"></span><script type="text/javascript">pole_timer(' + data.message + ', "timer'+id+'");<\/script>';
});
*/

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
$.noty.setText(data.message);
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
killer: true,
callback:  {
afterClose: function() {n=null;},

}
});
}
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
$('.tab-content').css({'display':'none'});
//setInterval("jQuery('#loadA').load('#div #loadB');",40000); //У меня интервал обновления блока - минута
});