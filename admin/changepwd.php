<?php
define('IN_EVP', true);
include_once(dirname(__FILE__)."/../include/define.php"); 
include_once(dirname(__FILE__)."/../include/global.php");//干掉全局变量 
include_once(dirname(__FILE__)."/../include/checkpostandget.php");
adodb?require(dirname(__FILE__)."/../include/adodb/adodb.inc.php"):include_once(dirname(__FILE__).'/../include/dbclass.php'); 
!adodb?include ('../include/session_mysql.php'):include ('../include/adodb_session_mysql.php');
include("../include/common.php");

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
#box{position:relative;top:-50%;left:-50%;z-index:9999;width:400px}
#box[id]{left:0;margin:0 auto;}
div.boxstyle{border:1px solid #3366FF;text-align:center;padding:5px;}

-->
</style>
<body> 

</head>
<body>

<?php

if (isset($_POST['originalpwd'])){
$originalpwd=md5($_POST['originalpwd']);
	if (adodb){
	$conn=evp_conn(3);
	$sql="select * from admin_user where user_name='".$_SESSION['admin_name']."' and password ='".$originalpwd."'";
	$res=$conn->Execute($sql);
	while (!$res->EOF){
			$res->MoveNext();
			}
	$numrows=$res->RecordCount();
	
	if (!$numrows) die("原密码输入错误！");
	}
	if ($_POST['newpwd1']!=$_POST['newpwd2']) die("新密码输入二次不一致！");
	if (strlen($_POST['newpwd1'])<6) die("密码长度不够，至少要6个英文字母");
	$newpwd1=md5($_POST['newpwd1']);
	$sql="update admin_user set password= '".$newpwd1."' where user_name='".$_SESSION['admin_name']."'";
	$conn->Execute($sql);
		if (strlen(trim(ltrim($_POST['newname'])))!=0){//如果修改用户名了
		$sql="update admin_user set user_name= '".$_POST['newname']."' where user_name='".$_SESSION['admin_name']."'";
		$conn->Execute($sql);$_SESSION['admin_name']=$_POST['newname'];
		}
	echo "<script>alert('修改成功！')</script>";
}
?>



<div id="wrapper">
<div id="mid">
<div id="box" class="boxstyle"><FORM METHOD=POST ACTION="">

<br>
<TABLE border=0 cellspacing=4 cellpadding=4>
<TR><TD>管理员用户名</TD><TD><?php echo $_SESSION['admin_name'];?></TD></TR>
<TR>
<TR><TD>更名为（不改请跳过）</TD><TD><INPUT TYPE="text" NAME="newname"></TD></TR>
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