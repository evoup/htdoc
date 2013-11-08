<?php
define('IN_EVP', true);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); //不要缓存
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?>
<?php
include("../include/checkpostandget.php");
include("../include/dbclass.php");
include("../include/session_mysql.php");
include("../include/common.php");
session_start();
include("../include/check_if_iskick.php");
if (!isset($_SESSION['name'])) 
{
//超时就退出
killsession_go_index(1);
die("");
//die("你没有权限进入本栏目!");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> 选择接受对象 </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<link rel=stylesheet href='../css/css.css' type='text/css'>
<SCRIPT LANGUAGE="JavaScript" src='../js/static/selectbox.js' charset=utf8></script>
<SCRIPT LANGUAGE="JavaScript" src='../js/static/OptionTransfer.js' charset=utf8></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
var opt = new OptionTransfer("list1","list2");
opt.setAutoSort(false);
opt.setDelimiter(",");
//正则
opt.setStaticOptionRegex("^(Bill|Bob|Matt)$");
opt.saveRemovedLeftOptions("removedLeft");
opt.saveRemovedRightOptions("removedRight");
opt.saveAddedLeftOptions("addedLeft");
opt.saveAddedRightOptions("addedRight");
opt.saveNewLeftOptions("newLeft");
opt.saveNewRightOptions("newRight");
</SCRIPT>
</HEAD>
<!--加下面的onload-->
<BODY onkeydown="if(event.keyCode==27) return false;" leftMargin=10 topMargin=0 rightMargin=0 onLoad="opt.init(document.forms[0])">





<br>
位置：个人工具 -> 短消息

<?php
$type = $_GET['type'];
echo $type;
if ($type == 'vis')
{
  echo"<form id=form1 name=form1 action='msgpost_vis2.php' METHOD=POST>";
}

if ($type == 'ubb')
{
  echo"<form id=form1 name=form1 action='msgpost_ubb.php' METHOD=POST>";
}

?>
<!-- <form action="msgpost_ubb.php" METHOD=POST> -->
<TABLE  class=tableborder cellSpacing=1 cellPadding=4 width="98%">
<tr class=header1>
	<TD colspan=3>接收对象</TD>
</TR>
<TR><TD class=altbg2 COLSPAN=3><P><IMG SRC="<?php $DOCUMENT_ROOT?>/image/new_6.jpg"  BORDER="0" ALT=""> 按住ctrl或shift可以选择多个人员(如果你使用较新的浏览器，可以双击)</P></TD></TR>
<TR>
	<TD class=altbg2 width=33%><p align=center><SCRIPT src='../js/depusr_transfer.js?time=<?php echo time();?>'></SCRIPT></p><BR></TD>
	<TD class=altbg2 width=23% align=center>发送<BR><BR><INPUT TYPE="button" NAME="right" VALUE="添加&gt;&gt;" ONCLICK="opt.transferRight()"><BR><BR><INPUT TYPE="button" NAME="right" VALUE="全部&gt;&gt;" ONCLICK="opt.transferAllRight()"><BR><BR><INPUT TYPE="button" NAME="left" VALUE="删除&lt;&lt;" ONCLICK="opt.transferLeft()"><BR><BR><INPUT TYPE="button" NAME="left" VALUE="全删&lt;&lt;" ONCLICK="opt.transferAllLeft()"><BR><!-- 密送<BR><INPUT TYPE="button" NAME="right" VALUE="添加&gt;&gt;" ONCLICK="opt.transferRight()"><BR><INPUT TYPE="button" NAME="right" VALUE="全部&gt;&gt;" ONCLICK="opt.transferAllRight()"><BR><INPUT TYPE="button" NAME="left" VALUE="删除&lt;&lt;" ONCLICK="opt.transferLeft()"><BR><INPUT TYPE="button" NAME="left" VALUE="全删&lt;&lt;" ONCLICK="opt.transferAllLeft()"><BR> --></TD><TD class=altbg2 width=44%><SELECT NAME="list2" MULTIPLE SIZE=10 onDblClick="opt.transferLeft()" style="width:170px;height:155px;"></SELECT></TD>
</TR><TR>
	<TD class=altbg1 colspan=3 align=right><div style="display:none">选择的ID: <INPUT TYPE="text" NAME="newRight" id="newRight" VALUE="" SIZE=70></div><INPUT TYPE="submit" value='下一步' class="inputs" ></TD>
</TR>

</TABLE>

</FORM>

</BODY>
</HTML>

