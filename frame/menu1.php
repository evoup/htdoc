<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> menu </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">

<link rel=stylesheet href="../css/css.css" type="text/css">


</HEAD>

<BODY>
<?php
//echo $_GET["action"];
if($_GET["action"]== strval( logout))
{
	echo "你已经登出系统!";
session_start(); 
// 这种方法是将原来注册的某个变量销毁
unset($_SESSION [’name’]); 

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





session_start();
if (isset($_SESSION[’name’])) 
{ 
echo "您已经成功登陆"; 
} 
else 
{ 
// 验证失败，将 $_SESSION["admin"] 置为 false
$_SESSION[’name’] = false; 
die("您无权访问本栏目!"); 
}

//echo $_GET["action"];
if($_GET["action"]== strval( logout))
{
	echo "你选择登出!";
session_start(); 
// 这种方法是将原来注册的某个变量销毁
unset($_SESSION [’name’]); 

// 这种方法是销毁整个 Session 文件
session_destroy(); 




}

//include("../include/session_mysql.php");
?>
<span class="bold">&raquo;</span>你好,
<?php 
session_start();
//echo $_SESSION[’var1’]; 
$x=$_SESSION [’name’];
echo $x ;

//echo '传递的session变量var1的值为：'.$_SESSION[’var1’]; 
//if(isset($_SESSION[’name’]))
//{echo '已经通过验证';
//}

?><br>
<a href=<?php echo"$PHP_SELF?action=logout";?>>登出</a>

<!-- <A HREF="../ceshi.php">测试</A> --><A HREF="">短消息</A><BR><BR><BR>
<!-- <TABLE border=0>
<TR>
	<TD ><A HREF="../addlist/admin.php" target=mainFrame>最近安排</A></TD>
</TR>
<TR>
	<TD ><A HREF="../addlist/admin.php" target=mainFrame>办公物品申领</A></TD>
</TR>


<TR>
	<TD ><A HREF="../addlist/admin.php" target=mainFrame>通讯录管理</A></TD>
</TR>
<TR>
	<TD><A HREF="../addlist/addlist.php" target="mainFrame">通讯录</A></TD>
</TR>
<TR>
	<TD>知识库管理</TD>
</TR>
<TR>
	<TD>知识库</TD>
</TR>
<TR>
	<TD>作业流程</TD>
</TR>
<TR>
	<TD>个人工具</TD>
</TR>
</TABLE> -->




<DIV id=lselect>
<H3 class=select><SPAN>选择一个功能:</SPAN></H3>
<UL>
<LI> <A class=c href="http://deepblue.indika.net.id/">最近安排</A> </LI>
<LI><A class=c href="../addlist/admin.php" target="mainFrame">办公用品申领</A> </LI>
<LI><A class=c href="../addlist/admin.php" target="mainFrame">通讯录管理</A> </LI>
<LI><A class = c HREF="../addlist/addlist.php" target="mainFrame">通讯录</A> </LI>
<LI><A class = c HREF="../addlist/addlist.php" target="mainFrame">知识库管理</A></LI>
<LI><A class = c HREF="../addlist/addlist.php" target="mainFrame">知识库</A></LI>
<LI><A class = c HREF="../addlist/addlist.php" target="mainFrame">作业流程</A></LI>
<LI><A class = c HREF="../addlist/addlist.php" target="mainFrame">个人工具</A></LI>
</UL></DIV>










</BODY>
</HTML>
