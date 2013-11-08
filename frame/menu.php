<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> menu </TITLE>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?>
<link rel=stylesheet href="../css/css.css" type="text/css">
<style type="text/css">
<!--
#msgunread{
display:inline;
}
#leijia{
display:none;
}
-->
</style>
<body> 


<SCRIPT LANGUAGE="JavaScript">
<!--
var xmlHttp;

function createXMLHttpRequest(){
if (window.ActiveXObject){xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");}
else if (window.XMLHttpRequest){xmlHttp=new XMLHttpRequest();}
}


function go() {
            createXMLHttpRequest();
           
            xmlHttp.open("GET", "news.php?time=new Date().getTime()", true);
            xmlHttp.onreadystatechange = goCallback;
            xmlHttp.send("");
        }
function goCallback() {
            if (xmlHttp.readyState == 4) {
                if (xmlHttp.status == 200) {
					var msg = document.getElementById("msgunread");

					msg.innerHTML=xmlHttp.responseText;
					
                    setTimeout("pollServer()", 5000);
                }
            }
        }

function pollServer() {
go();
        }


//-->
</SCRIPT>



</HEAD>
<BODY topmargin="0" bgcolor=#ffffff onload="go();">
<?php
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
if($_GET["action"]== strval( logout))
{
echo "你选择登出!";
// 这种方法是将原来注册的某个变量销毁
unset($_SESSION ['name']); 
// 这种方法是销毁整个 Session 文件
session_destroy(); 
}
?><BR><div id=leijia value=0></div>
<span class="bold">&raquo;</span>
短消息<A HREF="../messenge/msgview.php" target="mainFrame">
[<div id=msgunread >0</div>]</A>未读<BR>

<div id="navcontainer">
<ul id="navlist">
<LI><A class=textbox-link href="../addlist/admin.php" target="mainFrame">最近安排</A> </LI>
<LI><A class=textbox-link href="../calendar1/index.php" target="mainFrame">企业行事录</A> </LI>
<LI><A class=textbox-link href="../store/store.php" target="mainFrame">办公用品申领</A> </LI>
<?php
if (isset($_SESSION['acc'])&&$_SESSION['acc']>=5) 
{
echo "<LI><A class=textbox-link href=\"../addlist/admin.php\" target=\"mainFrame\">人事管理</A> </LI>\n";
}
?>
<!-- <LI><A class=textbox-link href="../addlist/admin.php" target="mainFrame">人事管理</A> </LI> -->
<LI><A class = textbox-link HREF="../addlist/addlist.php" target="mainFrame">通讯录</A> </LI>
<?php
if (isset($_SESSION['acc'])&&$_SESSION['acc']>=5) 
{
echo "<LI><A class=textbox-link href=\"../addlist/addlist.php\" target=\"mainFrame\">知识库管理</A> </LI>\n";
}
?>
<!-- <LI><A class = textbox-link HREF="../addlist/addlist.php" target="mainFrame">知识库管理</A></LI> -->
<LI><A class = textbox-link HREF="../addlist/addlist.php" target="mainFrame">知识库</A></LI>
<!-- <LI><A class = textbox-link HREF="../addlist/addlist.php" target="mainFrame">作业流程</A></LI> -->
<LI><A class = textbox-link HREF="../addlist/addlist.php" target="mainFrame">个人工具</A></LI>
<LI><A class = textbox-link HREF="../addlist/addlist.php" target="mainFrame">修改信息</A></LI>
<?php
if (isset($_SESSION['acc'])&&$_SESSION['acc']>=5) 
{
echo "<LI><A class=textbox-link href=\"../messenge/dispatch.php\" target=\"mainFrame\">发文</A> </LI>\n";
}
?>
<!-- <LI><A class = textbox-link HREF="../messenge/msgpost.php" target="mainFrame" ;">短消息</A></LI> -->
<?php
if (isset($_SESSION['acc'])&&$_SESSION['acc']>=5) 
{echo "<LI><A class = textbox-link HREF=\"../vote/mymanage.php\" target=\"mainFrame\" ;\">投票管理</A></LI>\n";}
?>
<LI><A class = textbox-link HREF="../vote/vote1.php" target="mainFrame" ;">投票箱</A></LI>
<LI><A class = textbox-link HREF="../frame/mainframe.php" target="mainFrame" ;">*开发进度</A></LI>

</ul>
</div>
<div id = logocopyrightcontainer><hr style="border:1px ; height:1px">
<DIV id=logocopyright>
<H3 class=logocopyright><SPAN>copyright</SPAN></H3></DIV>copyright2001.<BR>
@rt web ALL rights reserved.<hr style="border:1px ; height:1px"></DIV>

<style>
.font10px{
font-size: 11px;
font-family: PMingLiU;
}
</style><!-- 
<div class="font10px">这是视觉上10px的简体中文字体。可以发现中文显示效果还是不错的。</div> -->




</BODY>
</HTML>