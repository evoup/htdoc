<?php
/*if (!session_is_registered('name')){
	session_start();
}*/
if(isset($_GET['action']) and $_GET["action"]== strval('logout'))
{
	echo "<div id=cplusplus><h3>你已经登出系统!<h3>";
	unset($_SESSION ['name']);
	unset($_SESSION ['staff']);
	session_destroy();
	echo "将于3秒后进入系统 <A HREF=../index.php>如果不想自动跳转，请单击这里</A>\n";
	header("refresh:3;url=../index.php");
	echo "</div>";
	die;}
?>