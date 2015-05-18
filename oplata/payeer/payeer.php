
<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once('cpayeer.php');
require_once($_SERVER['DOCUMENT_ROOT']."/data/conn_file.php");

$SysValue['connect']['host'] 		= $host;
$SysValue['connect']['user_db'] 	= $user;
$SysValue['connect']['pass_db'] 	= $pass;
$SysValue['connect']['dbase']   	= $dbName;

@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db']) or 
	@die("" . PHPSHOP_error(101, $SysValue['my']['error_tracer']) . "");
	
@mysql_select_db ($SysValue['connect']['dbase']) or 
	@die("" . PHPSHOP_error(102, $SysValue['my']['error_tracer']) . "");
			
$strSQL 	= "SELECT id_payeer, key_payeer FROM tb_conf_site";

$rs 		= mysql_query($strSQL);
$row 		= mysql_fetch_array($rs);

$m_shop 	= $row['id_payeer'];
#$m_shop 	= '60093165';
$m_orderid 	= time();
$m_amount 	= number_format($_GET['amount'], 2, '.', '');
$m_curr 	= 'RUB';
$m_desc 	= base64_encode('Test');
$m_key		= $row['key_payeer'];
#$m_key 	= 'WNbrCdIomQkiOxeH';


$arHash = array(
	$m_shop,
	$m_orderid,
	$m_amount,
	$m_curr,
	$m_desc,
	$m_key
);
#echo '<pre>'.print_r($arHash, true).'</pre>';
$sign = strtoupper(hash('sha256', implode(':', $arHash)));
header("Location: https://payeer.com/merchant/?m_shop=".$m_shop."&m_orderid=".$m_orderid."&m_amount=".$m_amount."&m_curr=".$m_curr."&m_desc=".$m_desc."&m_sign=".$sign."&m_process=".$m_process);

?>

<!-- Удалить артем -->
<!-- <form method="GET" action="https://payeer.com/merchant/">
	<input type="hidden" name="m_shop" value="<?=$m_shop?>">
	<input type="hidden" name="m_orderid" value="<?=$m_orderid?>">
	<input type="hidden" name="m_amount" value="<?=$m_amount?>">
	<input type="hidden" name="m_curr" value="<?=$m_curr?>">
	<input type="hidden" name="m_desc" value="<?=$m_desc?>">
	<input type="hidden" name="m_sign" value="<?=$sign?>">
	<input type="submit" name="m_process" value="send" />
</form> -->