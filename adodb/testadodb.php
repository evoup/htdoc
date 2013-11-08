<?php



$link = mysql_connect("localhost", "root", "getter");
mysql_select_db("sf",$link);
$result = mysql_query("SELECT * FROM sforum",$link);
if ($result === false) die("failed"); 
while ($row = mysql_fetch_row($result)) {

        print $row[5];

print "<br>n";
$i=$i++;
} 

?>