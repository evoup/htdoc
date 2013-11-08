<?php
ob_start();
include("../include/classdate.php");
$d=new Date();
$yea=$d->getYear();
$mth=$d->getMonth();
$day=$d->getDay();
$hor=$d->getHours();
$min=$d->getMinutes();
$snd= $d->getSeconds();

?><html><head><title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="banner/style.css" type="text/css" rel="stylesheet">
<?php
echo "<script>\n";
echo "var JE_CURENTTIME = new Date($yea,$mth,$day,$hor,$min,$snd);\n";
echo "function timeview()\n";
echo "{\n";
echo "  timestr=JE_CURENTTIME.toLocaleString();\n";
echo "  timestr=timestr.substr(timestr.indexOf(\" \"));\n";
echo "  document.getElementById('time_area').innerHTML = timestr;\n";
echo "  JE_CURENTTIME.setSeconds(JE_CURENTTIME.getSeconds()+1);\n";
echo "  window.setTimeout( \"timeview()\", 1000 );\n";
echo "}\n";
echo "</script>\n";
echo "<script language=\"JavaScript\">\n";
echo "today=new Date();\n";
echo "function initArray(){\n";
echo "this.length=initArray.arguments.length\n";
echo "for(var i=0;i<this.length;i++)\n";
echo "this[i+1]=initArray.arguments[i] }\n";
echo "var d=new initArray(\n";
echo "\"星期日\",\n";
echo "\"星期一\",\n";
echo "\"星期二\",\n";
echo "\"星期三\",\n";
echo "\"星期四\",\n";
echo "\"星期五\",\n";
echo "\"星期六\");\n";
echo "</script>\n";
?>






<script language="JavaScript">
if (window.Event)
  document.captureEvents(Event.MOUSEUP);

function nocontextmenu()
{
 event.cancelBubble = true
 event.returnValue = false;

 return false;
}

function norightclick(e)
{
 if (window.Event)
 {
  if (e.which == 2 || e.which == 3)
   return false;
 }
 else
  if (event.button == 2 || event.button == 3)
  {
   event.cancelBubble = true
   event.returnValue = false;
   return false;
  }

}

document.oncontextmenu = nocontextmenu;  // for IE5+
document.onmousedown = norightclick;  // for all others
</script>

</head><body class="bodycolor" leftmargin="0" topmargin="0" onLoad="timeview();">

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
echo "<script>window.location =\"../index.html\";</script>";
die("您无权访问本栏目!"); 
}
?>


<table border="0" cellpadding="0" cellspacing="0" height="50" width="100%">
  <tbody>
  <tr>
    <td background="banner/banner.gif">
      <div style="margin-left:20pt;margin-top: 0pt; font-weight: bold; font-size: 14pt; width: 100%; color: rgb(255, 255, 255); font-family: 宋体;display:inline;background-image:url('banner/logo.gif');background-repeat: no-repeat;"><!-- 佳艺网络办公系统 --><div style='padding-left:250px;display:inline;font:12px/normal "宋体";margin-left:40px;color:black;'>搜索
	  ：</div><div style='display:inline'><INPUT TYPE="text" NAME=""></div><div style='display:inline;margin-left:20px'><INPUT TYPE="button" value='GO'></div></div></td>
     

      
      
    <td class="small" background="banner/bannerb.gif" width="300">
    
   
      <div style="font-weight: bold; font-size: 9pt; width: 100%; color: rgb(0, 0, 0); height: 20pt;" align="right">
	  <?php
echo "<script language=\"javascript\"> \n";
echo "document.write( \n";
echo "\"<font color=white> \", \n";
echo "$yea,\"年\", \n";
echo "$mth,\"月\", \n";
echo "today.getDate(),\"日 \", \n";
echo "d[today.getDay()+1], \n";
echo "\"</font>\" ); </script>\n";
?>

	  <!-- <script language="javascript"> 
document.write( 
"<font color=#000080> ", 
today.getYear(),"年", 
today.getMonth()+1,"月", 
today.getDate(),"日 ", 
d[today.getDay()+1], 
"</font>" ); </script> -->&nbsp;<font color="white"><b><span id="time_area"> 22:37:56</span></b></font>

</div><b><a href="../mainindex.php" target="main"><img alt="我的办公桌" src="banner/mytable.gif" border="0" height="16" width="16"><font color="white">&nbsp;桌面&nbsp;</font><font color="white">|</font></a><a href="" ><font color="white">&nbsp;计算器</font></a><a href="" ><img alt="在线帮助" src="banner/c.gif" border="0" height="16" width="16"><font color="white">&nbsp;帮助</font></a>        <a onClick="return(window.confirm('你真想退出本系统?'));" href=<?php echo"$PHP_SELF?action=logout";?> target="_top">&nbsp;&nbsp;&nbsp;<img alt="退出系统" src="banner/exit.gif" border="0" height="16" width="16"><font color="white">&nbsp;退出</font></a></b></td></tr></tbody></table></body></html>