<?
include ("const.php");
link_data();
$query="delete from title where id='".$_GET["id"]."'";
$result=mysql_query($query);
echo "<script language='javascript'>alert('主题删除成功!');history.go(-1);</script>";
?>