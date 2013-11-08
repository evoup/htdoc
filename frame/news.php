<?php
define('IN_EVP', true);
header('Expires: 0'); // rfc2616 - Section 14.21
header('Last-Modified: ' . $GLOBALS['now']);
header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
header('Pragma: no-cache'); // HTTP/1.0


include("../include/session_mysql.php");
session_start(); 
if($_GET["action"]== strval( logout))
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
//echo $_GET["action"];
if($_GET["action"]== strval('logout'))
{
echo "你选择登出!";
// 这种方法是将原来注册的某个变量销毁
unset($_SESSION ['name']); 
// 这种方法是销毁整个 Session 文件
session_destroy(); 
}
include("../include/dbclass.php") ;

$totlerows=$db->getcount("select * from msg where inceptid='{$_SESSION['id']}' and isread =0;");
echo  $t=trim($totlerows);
if ($t>0)
{echo " <object data=\"music.mp3\" type=\"application/x-mplayer2\" width=\"0\" height=\"0\">\n";
echo "    <param name=\"src\" value=\"sound2.wav\">\n";
echo "  </object>\n";



//echo "<SCRIPT LANGUAGE=\"javascript\" defer> \n";
//echo "<!-- ";
//echo "<!-- \n";echo "if (msg && msg.open && !msg.closed) { alert ('yahoo is opening') } ";
//echo "msg=window.open('page.html');";
//echo "eval(msg);";
//echo "<!-- \n";echo "if (msg && msg.open && !msg.closed) { //alert ('yahoo is opening') } ";
//echo "--> \n";
//echo "</SCRIPT> \n";


echo "<SCRIPT LANGUAGE=\"JavaScript\" defer>\n";
echo "<!--\n";
echo "a=null;";
echo "if(a  &&  a.open  &&  !a.closed)  \n";
echo "a.focus();\n";
echo "else  \n";
echo "a=window.open('../frame/qmsg.php', 'newwindow', 'height=270, width=380, top=20, left=30, toolbar=no, menubar=no, scrollbars=no,resizable=no,location=no, statu s=no')  \n";echo "a.focus();\n";
echo "//-->\n";
echo "</SCRIPT>\n";



}



//echo "iconv( GB2312, UTF-8, 这就是新闻 )";
//echo 这就是新闻;
?>