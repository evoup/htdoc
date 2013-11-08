<?php
include("adodb/adodb.inc.php");
$db = NewADOConnection('mysql');
$db->Connect("localhost", "root", "getter", "sf");
//echo "12";
$result = $db->Execute("SELECT * FROM sforum");
if ($result === false) die("failed");  
while (!$result->EOF) {
    for ($i=0, $max=$result->FieldCount(); $i < $max; $i++)
           print $result->fields[$i].' ';
    $result->MoveNext();
    print "<br>n";
} 


?>