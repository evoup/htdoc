<?
include ("const.php");
link_data();
$query="delete from choice where id='".$_GET["id"]."'";
$result=mysql_query($query);
echo "<script language='javascript'>alert('选项删除成功!');history.go(-1);</script>";
?>