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
<?php print ("$_POST[username]");
//print ("$_POST[password]");

$x=mysql_connect('192.168.16.104','root','getter')or die ('Not connected : ' . mysql_error());
mysql_select_db('jzoa',$x)  or die ('Can\'t use foo : ' . mysql_error());
$result=mysql_query(" SELECT * FROM login where username=\'$_post[username]\' ",$x);

echo $result;
while($row=mysql_fetch_row($result))
	{
	echo "$row[1]";
	}
?>



</BODY>
</HTML>
