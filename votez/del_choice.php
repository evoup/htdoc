<?
include ("const.php");
link_data();
$query="delete from choice where id='".$_GET["id"]."'";
$result=mysql_query($query);
echo "<script language='javascript'>alert('ѡ��ɾ���ɹ�!');history.go(-1);</script>";
?>