<?php
include("adodb/adodb.inc.php");
//die('.............');
$db = &ADONewConnection("ado_access");
$db->debug=1;
$access = 'D:\Program Files\Apache Group\Apache2\htdocs\sf\1.mdb';
$myDSN = 'PROVIDER=Microsoft.Jet.OLEDB.4.0;'
. 'DATA SOURCE=' . $access . ';'
. 'USER ID=;PASSWORD=;';
echo "<p>PHP ",PHP_VERSION,"</p>";

if($db->Connect($myDSN,'',''))
echo"ok";
else die('fail');

$rs = $db->Execute("select * from product");
	$arr = $rs->GetArray();
	print_r($arr);





/*print_r($db->ServerInfo());

try {
$rs = $db->Execute("select $db->sysTimeStamp,* from adoxyz where id>02xx");
print_r($rs->fields);
} catch(exception $e) {
print_r($e);
echo "<p> Date m/d/Y =",$db->UserDate($rs->fields[4],'m/d/Y');
}*/

?>