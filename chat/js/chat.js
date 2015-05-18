$(document).ready(function(){
    chat_online();
    chat_mess();
    setInterval('chat_mess()',7000);
    setInterval('chat_online()',30000);
});

function insert_text(open, close, no_focus)
{
  msgfield = (document.all) ? document.all.message : document.forms['post_chat']['message'];
  if (document.selection && document.selection.createRange)
  {
    if (no_focus != '1' ) msgfield.focus();
	sel = document.selection.createRange();
	sel.text = open + sel.text + close;
	if (no_focus != '1' ) msgfield.focus();
	}else if (msgfield.selectionStart || msgfield.selectionStart == '0'){
	  var startPos = msgfield.selectionStart;
	  var endPos = msgfield.selectionEnd;
	  msgfield.value = msgfield.value.substring(0, startPos) + open + msgfield.value.substring(startPos, endPos) + close + msgfield.value.substring(endPos, msgfield.value.length);
	  msgfield.selectionStart = msgfield.selectionEnd = endPos + open.length + close.length;
	  if (no_focus != '1' ) msgfield.focus();
	    }else{
		msgfield.value += open + close;
		if (no_focus != '1' ) msgfield.focus();
		}return;}

function show_ocno(id) {
obj = document.getElementById("ocno" + id);
obj.style.visibility = "visible";
}

function hide_ocno(id) {
document.getElementById("ocno" + id).style.visibility="hidden";
}

function chat_mess()
{
$.ajax({
url: "/chat/chmess.php",
cache: false,
success: function(html){
 $("#chat_mess").html(html);
  }
 });
}

function chat_online()
{
$.ajax({
url: "/chat/online.php",
cache: false,
success: function(html){
 $("#chat_online").html(html);
  }
 });
}

$(document).ready(function(){
    $('#post_chat').submit(function(){
    $.ajax({
      type: "POST",
      url: "/chat/chotpr.php",
      data: "message="+$("#message").val()
    });
      $('#post_chat').clearForm();
      return false;
    });
});

function chatCom(e) {

    e = e || window.event;
    if (e.keyCode == 13 && e.ctrlKey) {
    $.ajax({
      type: "POST",
      url: "/chat/chotpr.php",
      data: "message="+$("#message").val()
    });
      $('#post_chat').clearForm();
      return false;
      };
    };

;(function($) {

$.fn.clearForm = function() {
	return this.each(function() {
		$('input,select,textarea', this).clearFields();
	});
};

$.fn.clearFields = $.fn.clearInputs = function() {
	return this.each(function() {
		var t = this.type, tag = this.tagName.toLowerCase();
		if (t == 'text' || t == 'password' || tag == 'textarea') {
			this.value = '';
		}
		else if (t == 'checkbox' || t == 'radio') {
			this.checked = false;
		}
		else if (tag == 'select') {
			this.selectedIndex = -1;
		}
	});
};


})(jQuery);
