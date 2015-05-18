<?session_start();
	
  include ("option.php");

  //if (!file_exists($msg_file)) { $fo = fopen($msg_file, "w"); fclose($fo); }

  include("chatfun.php");
  $chatname = $_SESSION["login"];
  $usid = $_SESSION["id"];
  $date = time();
 // require_once("../config.php");
  
 
  $fl = file($msg_file);
  $count_fl = count($fl);
  $msg = mess($_POST['message']);
  $person = trim($chatname);
  if (($msg != "") && ($person != ""))
  {
  $ust=$db->getRow("select * from tb_users where username=?s", $chatname);
  
  //print_r($ust); exit();
  
  if($ust['chat_status'] == 5) {
  echo 'Вы забанены в чате!'; exit();
  }
   
   
  
    $cmess = $msg;
    //$cmess = Encode($cmess,"w");

   $db->query("INSERT INTO tb_chat SET ?u", array('login' => $chatname, 'user_id' => $usid, 'date' => $date, 'text' => $cmess));
  }
?>