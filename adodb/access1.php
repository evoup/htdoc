<?php  
require "adodb/tohtml.inc.php";   
require "adodb/adodb.inc.php";   
$db=&ADONewConnection("ado_access");     
print   "<h1>Connecting   $db->databaseType...</h1>";     
$access='test.mdb';
$myDSN='PROVIDER=Microsoft.Jet.OLEDB.4.0;'.'DATA SOURCE='.$access.';';'USER ID=;PASSWORD=;';  
  //$myDSN  =  'PROVIDER=Microsoft.Jet.OLEDB.4.0;'.'DATA  SOURCE='.  $access  .  ';';.'USER  ID=;PASSWORD=;'; 

    
if   (@$db->PConnect($myDSN,   "",   "",   ""))   {     
print   "ADO   version=".$db->_connectionID->version."<br>";     
$sql="select   *   from   product";   
$rs=$db->Execute($sql);   
  //rs2html($rs,'border=2   cellpadding=3',array('Customer   Name','Customer   ID'));     
}
else   print   "ERROR:   Access   test   requires   a   Access   database   $access".'<BR>'.$db->ErrorMsg();     
?>   
