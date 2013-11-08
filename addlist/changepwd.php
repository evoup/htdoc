<?php
define('IN_EVP', true);
include("../include/checkpostandget.php");
include('../include/dbclass.php');
include("../include/common.php");
include(".././include/session_mysql.php");
session_start();
?>
<html>
<head>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<style type="text/css">
<!--
#wrapper2{height:100%;width:100%;overflow:hidden;position:relative}
#wrapper2[id]{display:table;}
#mid{position: absolute;top:50%;left:50%}
#mid[id]{display:table-cell;left:0;vertical-align:middle;position:static}
#box{position:relative;top:-50%;left:-50%;z-index:9999;width:300px}
#box[id]{left:0;margin:0 auto;}
div.boxstyle{border:1px solid #3366FF;text-align:center;padding:5px;}

-->
</style>
<body> 

</head>
<body>

<?php
include(".././include/check_if_iskick.php");
if (!isset($_SESSION['name'])) 
{
//超时就退出
killsession_go_index(1);
die("");
//die("你没有权限进入本栏目!");
}



?>



<div id="wrapper">
<div id="mid">
<div id="box" class="boxstyle"><FORM METHOD=POST ACTION="">

<br>
<TABLE border=0 cellspacing=4 cellpadding=4>
<TR>
	<TD>输入原密码</TD>
	<TD><INPUT TYPE="password" NAME="originalpwd">
</TD>
</TR>
<TR>
	<TD>输入新密码</TD>
	<TD><INPUT TYPE="password" NAME="newpwd1"></TD>
</TR>
<TR>
	<TD>再输入一遍</TD>
	<TD><INPUT TYPE="password" NAME="newpwd2"></TD>
</TR>
<TR>
	<TD align=center><INPUT TYPE="reset"></TD>
	<TD align=center><INPUT TYPE="submit" value='确定'></TD>
</TR>
</TABLE></FORM>
</div>
</div>
</div>

</body>
</html>