<?
include ("const.php");
link_data();
$query="delete from title where id='".$_GET["id"]."'";
$result=mysql_query($query);
echo "<script language='javascript'>alert('����ɾ���ɹ�!');history.go(-1);</script>";
?>