<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> New Document </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
</HEAD>

<BODY>
<?php
include("../include/checkpostandget.php");
include("../include/session_mysql.php");
session_start();
if (!isset($_SESSION ['name'])) 
{
die("��û��Ȩ�޽��뱾��Ŀ!");
}



$x=md5($_POST['newpass']);

include("../include/dbclass.php");



$sql="UPDATE login SET pwd='{$x}' where logname='{$_SESSION ['logname']}'";
$db->query($sql);


//echo $x[$i]."��ɾ����!";

echo "<SCRIPT LANGUAGE=\"JavaScript\">alert(\"�����ɹ����!,�����µ�½!!\");window.close();</SCRIPT>";
?>
</BODY>
</HTML>

