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
echo "���Ѿ��ǳ�ϵͳ!";
// ���ַ����ǽ�ԭ��ע���ĳ����������
unset($_SESSION ['name']); 
unset($_SESSION ['staff']);
// ���ַ������������� Session �ļ�
session_destroy(); 
//����frame
echo "<SCRIPT LANGUAGE=JAVASCRIPT>\n";
echo "<!-- \n";
echo "if (top.location !== self.location) {\n";
echo "top.location=self.location;\n";
echo "}\n";
echo "</SCRIPT>\n";
}
if (isset($_SESSION['name'])) 
{ 
//echo "���Ѿ��ɹ���½<br>"; 
} 
else 
{ 
// ��֤ʧ�ܣ��� $_SESSION["admin"] ��Ϊ false
//$_SESSION[��name��] = false; 
die("����Ȩ���ʱ���Ŀ!"); 
}
//echo $_GET["action"];
if($_GET["action"]== strval( logout))
{
echo "��ѡ��ǳ�!";
// ���ַ����ǽ�ԭ��ע���ĳ����������
unset($_SESSION ['name']); 
// ���ַ������������� Session �ļ�
session_destroy(); 
}
?><BR><div id=leijia value=0></div>
<span class="bold">&raquo;</span>
����Ϣ<A HREF="../messenge/msgview.php" target="mainFrame">
[<div id=msgunread >0</div>]</A>δ��<BR>

<div id="navcontainer">
<ul id="navlist">
<LI><A class=textbox-link href="../addlist/admin.php" target="mainFrame">�������</A> </LI>
<LI><A class=textbox-link href="../calendar1/index.php" target="mainFrame">��ҵ����¼</A> </LI>
<LI><A class=textbox-link href="../store/store.php" target="mainFrame">�칫��Ʒ����</A> </LI>
<?php
if (isset($_SESSION['acc'])&&$_SESSION['acc']>=5) 
{
echo "<LI><A class=textbox-link href=\"../addlist/admin.php\" target=\"mainFrame\">���¹���</A> </LI>\n";
}
?>
<!-- <LI><A class=textbox-link href="../addlist/admin.php" target="mainFrame">���¹���</A> </LI> -->
<LI><A class = textbox-link HREF="../addlist/addlist.php" target="mainFrame">ͨѶ¼</A> </LI>
<?php
if (isset($_SESSION['acc'])&&$_SESSION['acc']>=5) 
{
echo "<LI><A class=textbox-link href=\"../addlist/addlist.php\" target=\"mainFrame\">֪ʶ�����</A> </LI>\n";
}
?>
<!-- <LI><A class = textbox-link HREF="../addlist/addlist.php" target="mainFrame">֪ʶ�����</A></LI> -->
<LI><A class = textbox-link HREF="../addlist/addlist.php" target="mainFrame">֪ʶ��</A></LI>
<!-- <LI><A class = textbox-link HREF="../addlist/addlist.php" target="mainFrame">��ҵ����</A></LI> -->
<LI><A class = textbox-link HREF="../addlist/addlist.php" target="mainFrame">���˹���</A></LI>
<LI><A class = textbox-link HREF="../addlist/addlist.php" target="mainFrame">�޸���Ϣ</A></LI>
<?php
if (isset($_SESSION['acc'])&&$_SESSION['acc']>=5) 
{
echo "<LI><A class=textbox-link href=\"../messenge/dispatch.php\" target=\"mainFrame\">����</A> </LI>\n";
}
?>
<!-- <LI><A class = textbox-link HREF="../messenge/msgpost.php" target="mainFrame" ;">����Ϣ</A></LI> -->
<?php
if (isset($_SESSION['acc'])&&$_SESSION['acc']>=5) 
{echo "<LI><A class = textbox-link HREF=\"../vote/mymanage.php\" target=\"mainFrame\" ;\">ͶƱ����</A></LI>\n";}
?>
<LI><A class = textbox-link HREF="../vote/vote1.php" target="mainFrame" ;">ͶƱ��</A></LI>
<LI><A class = textbox-link HREF="../frame/mainframe.php" target="mainFrame" ;">*��������</A></LI>

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
<div class="font10px">�����Ӿ���10px�ļ����������塣���Է���������ʾЧ�����ǲ���ġ�</div> -->




</BODY>
</HTML>