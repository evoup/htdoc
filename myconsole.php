<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>

<title></title>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?> 
 <!-- <link rel=stylesheet href="../css/css.css" type="text/css"> -->
<?php
include("include/session_mysql.php");
session_start();


?>
<SCRIPT LANGUAGE="JavaScript" src='ajaxmsg.js'></SCRIPT>
</HEAD>

<BODY>
<IMG SRC="image/email.gif"  BORDER="0" ALT="">短消息<A HREF="messenge/msgview.php" target="main">[<span id=msgunread style='display:inline'  >0</span>]</A>未读
<div style="position: absolute; width: 140px; top: 40px; left: 0px;  padding: 5px; overflow: auto;">
</div><div id=leijia value=0></div>




<?php
 
if($_GET["action"]== strval('logout'))
{
echo "你已经登出系统!";
// 这种方法是将原来注册的某个变量销毁
unset($_SESSION ['name']); 
unset($_SESSION ['staff']);
// 这种方法是销毁整个 Session 文件
session_destroy(); 
//跳出frame
echo "<SCRIPT LANGUAGE=JAVASCRIPT>\n";
echo "<!-- \n";
echo "if (top.location !== self.location) {\n";
echo "top.location=self.location;\n";
echo "}\n";
echo "</SCRIPT>\n";
}
if (isset($_SESSION['name'])) 
{ 
//echo "您已经成功登陆<br>"; 
} 
else 
{ 
// 验证失败，将 $_SESSION["admin"] 置为 false
//$_SESSION[’name’] = false; 
die("您无权访问本栏目!"); 
}


		$x=$_SESSION ['name'];
		$y=$_SESSION ['staff'];
		echo "您好，<b>".$x."</b>!"." 现在是：";
echo $showtime=date('Y-m-d');



?>






</BODY>
</HTML>
