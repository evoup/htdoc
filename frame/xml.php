<?php

header("Content-Type: text/xml; charset=gb2312");

echo "<?xml version=\"1.0\" encoding=\"GB2312\"?>";
include("../include/dbclass.php");
echo "<tree>";

//$i = 0;
//do {
//  echo "<tree text='$i'>$i</tree>";
//  $i++;
//} while ($i < 10);
$p=$_GET['p'];
$sql="select * from `menu` where `menu_grade`=2 and menuclass='{$p}'";
$r=$db->query($sql);

while ($row=mysql_fetch_array($r))
{
echo "<tree text='$row[1]' action='javascript:top.main.location.href=\"$row[7]\";void(0)'>$row[1]</tree>";
}


echo "</tree>";

?>