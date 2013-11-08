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
die("你没有权限进入本栏目!");
}



$x=md5($_POST['newpass']);

include("../include/dbclass.php");



$sql="UPDATE login SET pwd='{$x}' where logname='{$_SESSION ['logname']}'";
$db->query($sql);


//echo $x[$i]."被删除了!";

echo "<SCRIPT LANGUAGE=\"JavaScript\">alert(\"操作成功完成!,请重新登陆!!\");window.close();</SCRIPT>";
?>
</BODY>
</HTML>

