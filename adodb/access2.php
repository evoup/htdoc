<?php 
include('adodb/tohtml.inc.php'); // load code common to ADODB 
include('adodb/adodb.inc.php'); // load code common to ADODB 
$db = &ADONewConnection('ado_access'); 
print "<h1>Connecting $db->databaseType...</h1>"; 
$access = '1.mdb'; 
//$myDSN = 'PROVIDER=Microsoft.Jet.OLEDB.4.0;'.'DATA SOURCE='.$access.';USER ID=;PASSWORD=;'; 

$mydsn='Provider=Microsoft.Jet.OLEDB.4.0;User ID=Admin;Data Source=c:/1.mdb;Mode=Share Deny None;Extended Properties="";Jet OLEDB:System database="";Jet OLEDB:Registry Path="";Jet OLEDB:Database Password="";';




if (@$db->PConnect($myDSN, "", "", "")) { 
        print "ADO version=".$db->_connectionID->version."<br><br>"; 

        $sql = "select * from `test`"; 
        $rs = $db->Execute($sql);

        //while (!$rs->EOF) { 
        //        print $rs->fields[0].' '.$rs->fields[1].' '.$rs->fields[2].'<br>'; 
        //        $rs->MoveNext(); 
        //}
        
        //rs2html($rs,'border=2 cellpadding=3',array('Customer Name','Customer ID',"PS")); 
} else {
        print "ERROR: Access test requires a Access database $access".'<BR>'.$db->ErrorMsg(); 
}
?>
