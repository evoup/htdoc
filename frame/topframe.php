<HTML>
<HEAD>
<TITLE> 欢迎 </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=gb2312">

<META   HTTP-EQUIV="pragma"   CONTENT="no-cache">   
<META   HTTP-EQUIV="Cache-Control"   CONTENT="no-cache,   must-revalidate">   
<META   HTTP-EQUIV="expires"   CONTENT="Wed,   26   Feb   1997   08:21:57   GMT"> 



</HEAD>
<link rel=stylesheet href="../css/css.css" type="text/css">
<BODY topmargin="0" leftmargin ="0" bgcolor=>
<?php
include("../include/session_mysql.php");
include('../include/UsersOnline3.php');
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
?>
<table cellspacing="0" border="0" cellpadding="0">
    <tbody><tr id="header">
      <td id="headerlogo"><A HREF="../vote/vote1.php" target="mainFrame"  onfocus="blur()"><IMG SRC="../image/logo.png"  title="EVOUP Intranet OA System  --powered by evoup"  BORDER="0"></A><!-- <img src="../image/logo.png" alt="EVOUP Intranet OA System  --powered by evoup" height="64" width="200"> --></td>
      <td id="headerbanner"><IMG SRC="../image/xiaomi.gif"  BORDER="0" ALT=""><span class="bold">&raquo;</span>
	  <?php 
		session_start();
		//echo $_SESSION[’var1’]; 
		$x=$_SESSION ['name'];
		$y=$_SESSION ['staff'];
		echo "您好，<b>".$x."</b>!"." 现在是：";
echo $showtime=date('Y-m-d');
		//echo "[$y]";

		//echo '传递的session变量var1的值为：'.$_SESSION[’var1’]; 
		//if(isset($_SESSION[’name’]))
		//{echo '已经通过验证';
		//}






		?><!-- <?php echo $showtime=date('Y-m-d');?>  -->
		<SCRIPT LANGUAGE="JavaScript" src="../js/static/time2.js"></SCRIPT>
		当前在线：<?php
		
		//初始化类
$ol = new UsersOnline(false);

//get rid of the old records
$ol->refresh();

//who is at my site?

//这只是为了用addvisitor方法-_-!
//ADDING A USER, NO REPORTING
$ol = new UsersOnline(true);
$ol->printNumber("site");
		
		
		
		?>人
<a href=<?php echo"$PHP_SELF?action=logout";?>>退出</a>
</td>
    </tr>
    <tr>
      <td id="headerbar" colspan="2">&nbsp;</td>
    </tr>
  </tbody></table>
</BODY>
</HTML>