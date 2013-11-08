<?php
define('IN_EVP', true);
include("../include/checkpostandget.php");
include("../include/session_mysql.php");
session_start();
if (!isset($_SESSION ['name'])) 
{
die("你没有权限进入本栏目!");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> New Document </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
</HEAD>
<BODY>
<?php
$x=$_POST['list'];
/*echo $_POST["list"][0];
echo $_POST["list"][1];
echo $_POST["list"][2];
echo $_POST["list"][3];
echo $_POST["list"][4];
echo $_POST["list"][5];
echo $_POST["list"][6];
echo $_POST["list"][7];
echo $_POST["list"][8];
echo $_POST["list"][9];*/

//echo $x[];
include("../include/dbclass.php");


for($i=0;$i<count($x);$i++){




$sql="delete  from msg where inceptid='{$_SESSION['id']}' and msgid='{$x[$i]}'";
$db->query($sql);


//echo $x[$i]."被删除了!";
}
echo "<SCRIPT LANGUAGE=\"JavaScript\">alert(\"操作成功完成\");history.go(-1);</SCRIPT>";
?>
</BODY>
</HTML>