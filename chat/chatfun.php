
<?php
function Encode($str, $type){

        static $conv='';
        if (!is_array ( $conv )){
            $conv=array();
            for ( $x=129; $x <=143; $x++ ){
                $conv['utf'][]=chr(209).chr($x);
                $conv['win'][]=chr($x+112);
        }
            for ( $x=144; $x <=191; $x++ ){
                $conv['utf'][]=chr(208).chr($x);
                $conv['win'][]=chr($x+48);
        }
            $conv['utf'][]=chr(208).chr(129);
            $conv['win'][]=chr(168); // Ё
            $conv['utf'][]=chr(209).chr(145);
            $conv['win'][]=chr(184); // ё
            $conv['utf'][]=chr(209).chr(128);
            $conv['win'][]=chr(240); // р
        }

        if ( $type=='w' )
            return str_replace ( $conv['utf'], $conv['win'], $str );
        elseif ( $type=='u' )
            return str_replace ( $conv['win'], $conv['utf'], $str );
        else
            return $str;
}

function mess($input)
  {
    $cdom = "http://".$_SERVER['HTTP_HOST']."/";

    $input = substr($input,0,800); 

    $input = htmlspecialchars($input, ENT_QUOTES);

    for($i=1;$i<=40;$i++){
      $input = str_replace("*".$i."*","<img src=\"".$cdom."chat/smile/".$i.".gif\" width=\"35\" border=\"0\">",$input);
    }

    $find = array ( "'\[b\]'i", "'\[/b\]'i", "'\[i\]'i", "'\[/i\]'i", "'\[u\]'i", "'\[/u\]'i");

	$replace = array ( "<b>", "</b>", "<i>", "</i>", "<u>", "</u>");

    $input = preg_replace( $find, $replace, $input );

    $input = str_replace("\n"," ",$input);
    $input = stripslashes ($input);

    return $input;
  }

  function login($log)
  {
    $log = str_replace(">","&#62;",$log);
	$log = str_replace("<","&#60;",$log);
    $log = str_replace("'"," ",$log);
    $log = str_replace(";"," ",$log);
    $log = str_replace("$"," ",$log);
    return $log;
  }
?>
