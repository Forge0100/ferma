$(document).ready(function(){
  $dialog = $(".web_dialog");
  var w = $dialog.width();
  var h = $dialog.height();

  $dialog.css({'margin-left' : -w/2, 'margin-top' : -h/2});
});