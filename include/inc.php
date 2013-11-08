<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> New Document </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">

<link rel=stylesheet href="../css/css.css" type="text/css">


</HEAD>

<BODY>
<?php 
error_reporting(E_ALL);


//print ("$_POST[username]");
//print ("$_POST[password]");
$dbip="localhost";
$admin="root";
$dbpas="getter";
$x=mysql_connect($dbip,$admin,$dbpas)or die ('Not connected : ' . mysql_error());
mysql_select_db('jzoa',$x)  or die ('Can\'t use foo : ' . mysql_error());
$username=$_POST[username];
$password=$_POST[password];
$result=mysql_query(" SELECT * FROM login where username='{$username}'  and pwd='{$password}' ",$x);

//echo $result;
//while($row=mysql_fetch_row($result))
//	{
//	echo "$row[1]";
//	}
$num_rows = mysql_num_rows($result);
//echo $num_rows;
	if($num_rows==0)
	{
		echo"用户名或密码无效，你有最多5次机会登陆";
	}
	else
	{
		
		while($row=mysql_fetch_row($result))
	{
	

echo "<TABLE  height=200>\n";
echo "<TR>\n";
echo "	<TD></TD>\n";
echo "</TR>\n";
echo "</TABLE>\n";
echo "<TABLE class=border-a height=30 cellSpacing=0 cellPadding=0 width=700 align=center \n";
echo "border=1>\n";
echo "\n";
echo "<TR>\n";
echo "	<TD align=center>你好$row[1]\n\n将于3秒跳转到下页<br><A HREF=..\main.html>如果不想自动跳转，请单击这里</A></TD>\n";
echo "</TR>\n";
echo "</TABLE>\n";


	header("refresh:3;url=..\main.html");
	}
	}



?>



</BODY>
</HTML>
