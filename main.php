<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0040)http://localhost/edown21/admin/admin.php -->
<HTML><HEAD><TITLE>E��OAϵͳ</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<SCRIPT language=javascript>
 var ie = (document.all) ? true : false;
function changeColor(j){
	if(j < 0) return;
	(ie)?chIE(j,idb):chNS(j,idb.document);
}
function chIE(j,obj){
with(obj){
	document.bgColor = j;
}}
function chNS(j,obj){
with(obj){
	bgColor = j;
}}
</SCRIPT>
<!-- ////////// Setup Color Library -->
<SCRIPT>
function switchSysBar(){
if (document.all("frmTitle").style.display==""){
document.getElementById('placeholder').src="image/switchpoint_b.gif";
document.all("frmTitle").style.display="none"
}else{
document.getElementById('placeholder').src="image/switchpoint.gif";
document.all("frmTitle").style.display=""
}}
</SCRIPT>
<LINK href="css/css.css" type=text/css rel=stylesheet>
<LINK href="css/a.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2900.2963" name=GENERATOR></HEAD>
<BODY leftMargin=0 topMargin=0><table height="100%"><tr><td>
<TABLE height="51" cellSpacing=0 cellPadding=0 width="100%" align=center
border=0>
  <TR>
    <TD bgColor=#CCCCCC colSpan=3 height=23>
	<?php
include("include/session_mysql.php");
include("include/dbclass.php");

include('include/UsersOnline3.php');
session_start();
include("include/check_if_iskick.php");
if ($_GET["action"] == strval('logout'))
{
  echo"���Ѿ��ǳ�ϵͳ!";
  // ���ַ����ǽ�ԭ��ע���ĳ����������
  unset($_SESSION['name']);
  unset($_SESSION['staff']);
  // ���ַ������������� Session �ļ�
  session_destroy();
  //����frame
  echo"<SCRIPT LANGUAGE=JAVASCRIPT>\n";
  echo"<!-- \n";
  echo"if (top.location !== self.location) {\n";
  echo"top.location=self.location;\n";
  echo"}\n";
  echo"</SCRIPT>\n";
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

?>
<table cellspacing="0" border="0" cellpadding="0" >
    <tbody><tr id="header">
      <td id="headerlogo" ><A HREF="main.php" onFocus="blur()"><IMG SRC="../image/logo.png"  title="EVOUP Intranet OA System  --powered by evoup"  BORDER="0"></A><!-- <img src="../image/logo.png" alt="EVOUP Intranet OA System  --powered by evoup" height="64" width="200"> --></td>
      <td id="headerbanner"><IMG SRC="../image/xiaomi.gif"  BORDER="0" ALT=""><span class="bold">&raquo;</span>
	  <?php
session_start();
//echo $_SESSION[��var1��];
$x = $_SESSION['name'];
$y = $_SESSION['staff'];
echo"<span class=spanx>���ã�<b>".$x."</b>!".
  " �����ǣ�<img name=\"\" src=\"image/time.gif\"  alt=\"\">";
echo $showtime = date('Y-m-d');

//echo "[$y]";

//echo '���ݵ�session����var1��ֵΪ��'.$_SESSION[��var1��];
//if(isset($_SESSION[��name��]))
//{echo '�Ѿ�ͨ����֤';
//}

?><!-- <?php echo $showtime=date('Y-m-d');?>  -->
		<SCRIPT LANGUAGE="JavaScript" src="../js/static/time2.js"></SCRIPT>
		��ǰ���ߣ�<?php

//��ʼ����
$ol = new UsersOnline(false);

//get rid of the old records
$ol->refresh();

//who is at my site?

//��ֻ��Ϊ����addvisitor����-_-!
//ADDING A USER, NO REPORTING
$ol = new UsersOnline(true);
$ol->printNumber("site");

?>��</span><a href='main.php'><img src="image/mytable.gif"  alt="" width="16" height="16" border="0">����</a><a href=<?php echo"$PHP_SELF?action=logout";?> ><img src="image/login.gif"  alt="" border="0">ע��</a>
<a href=<?php echo"$PHP_SELF?action=logout";?> ><img src="image/exit.gif"  alt="" border="0">�˳�</a></td>
    </tr>
   <!--  <tr>
      <td id="headerbar" colspan="2">&nbsp;</td>
    </tr> -->
  </tbody></table>

	</TD>
  </TR>
</TABLE>
<TABLE height="90%" cellSpacing=0 cellPadding=0 width="100%" align=center
border=0>
  <TBODY>
  <TR ><!--bar-->
    <TD background="image/bar.gif" HEIGHT="27">&nbsp;</TD>
    <TD background="image/bar.gif" HEIGHT="27">&nbsp;</TD>
    <TD background="image/bar.gif" HEIGHT="27">&nbsp;</TD></TR>
  <TR>
    <TD id=frmTitle vAlign=top height="97%"><IFRAME
      style="Z-INDEX: 2; VISIBILITY: inherit; WIDTH: 160px; HEIGHT: 100%"
      name=left src="frame/menu4.php" frameBorder=0></IFRAME></TD>
    <TD vAlign=top bgColor=#0472BC>
      <TABLE height="100%" cellSpacing=0 cellPadding=0 border=11>
        <TBODY>
        <TR>
          <TD style="WIDTH: 2px; HEIGHT: 100%" onclick=switchSysBar()><FONT
            style="FONT-SIZE: 9pt; CURSOR: hand; COLOR: #ffffff; FONT-FAMILY: Webdings"><SPAN
            id=switchPoint title=��/�ر���ߵ�����><IMG SRC="image/switchpoint.gif" WIDTH="7" HEIGHT="50" BORDER="0" ALT="��/�ر���ߵ�����" id='placeholder' title="��/�ر���ߵ�����"></SPAN></FONT>
        </TR></TBODY></TABLE></TD>
    <TD vAlign=top width="100%" height="97%"><IFRAME id=main
      style="Z-INDEX: 1; VISIBILITY: inherit; WIDTH: 100%; HEIGHT: 100%"
      name=main src="mainindex.php" frameBorder=0
      scrolling=yes></IFRAME></TD></TR></TBODY></TABLE>
<TABLE height="2%" cellSpacing=0 cellPadding=0 width="100%" align=center
border=0 bgColor=#0472BC>
  <TBODY>
  <TR bgColor=#0472BC>
    <TD><IFRAME id=dorepage
      style="Z-INDEX: 1; VISIBILITY: inherit; WIDTH: 0px; HEIGHT: 0px"
      name=dorepage src="E��OAϵͳ" frameBorder=0
      scrolling=no></IFRAME></TD>
    <TD>
      <DIV align=center><FONT color=#ffffff>Powered by <strong>Evoup</strong> Vesion 1.0</FONT></DIV></TD>
    <TD>&nbsp;</TD></TR></TBODY></TABLE>
	</td></tr></table></BODY></HTML>
