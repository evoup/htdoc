<?php
define('IN_EVP', true);
include("../include/checkpostandget.php");
include("../include/dbclass.php");
include("../include/session_mysql.php");
include("../include/common.php");
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>

<link rel=stylesheet href="../css/message.css" type="text/css">


<TITLE> 收件箱 </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">

<link rel=stylesheet href="../css/css.css" type="text/css">
<!-- checkbox全选 -->
<SCRIPT LANGUAGE="JavaScript">

<!-- Begin
var checkflag = "false";
function check(field) {
if (checkflag == "false") {
for (i = 0; i < field.length; i++) {
field[i].checked = true;}
checkflag = "true";
return "false"; }
else {
for (i = 0; i < field.length; i++) {
field[i].checked = false; }
checkflag = "false";
return "true"; }
}
//  End -->
</script>
</HEAD>
<BODY bgcolor=#E3EEF4>

<?php
include("../include/check_if_iskick.php");
if (!isset($_SESSION['name'])) 
{
//超时就退出
killsession_go_index();
die("");
//die("你没有权限进入本栏目!");
}
?>

<form id =fm0 action="delmsg.php" method="post">
<TABLE class=tableborder  height=40 cellSpacing=1 cellPadding=4 width=98% align=center border=0 style="margin-top:20px;">
<tr><td class=header1 colspan=2 ><DIV class=fsavem_right_top>
<DIV class=fsavem_right_toptitle><SPAN class=f_font1>&nbsp;收件箱</SPAN></DIV>
<DIV class=fsavem_right_topright>消息使用情况 <SPAN 
class=f_font2><STRONG><?php echo $maxPage; ?></STRONG>/500</SPAN>&nbsp;</DIV></DIV></td></tr>
<tr >
<td class=altbg2>
<TABLE width=100% cellspacing=1 cellpadding=4 class=tableborder>
<TR >
 <td align=middle width="10%"   class=altbg1 ><INPUT TYPE="checkbox" style="position:absolute; left:30px; top:100px;clip: rect(6 17 17 6)" NAME="" onClick="this.value=check(document.getElementsByName('list[]'))">全选</TD>
<TD align=middle width="30%"  class=altbg1>消息标题</TD>
<TD align=middle width="20%"  class=altbg1 >发件人</TD>
<TD align=middle width="20%"  class=altbg1 >发送时间</TD>
<TD align=middle width="10%"  class=altbg1 >重要等级</TD>
</TR>
<?php
$page=$_GET["page"];



$sql="select title,sender,sendtime,important,msgid,isread,withattach from msg where inceptid={$_SESSION['id']} order by msgid desc";
$totlerows=$db->getcount($sql);
$result=$db->query($sql);
//分页开始
$pageSize= 8; //每页显示的记录数
//$page变量标示当前显示的页
if(!isset($page)) 
{$page=1;} 
if($page==0)
{$page=1;}
//得到当前查询到的纪录数 $totlerows 
//$totlerows= mysql_num_rows($res);

//if($totlerows<=0)
if($totlerows<=0)
{ 
echo "<p align=center>没有纪录"; 
exit; 
} 
//得到最大页码数maxPage 
$maxPage = (int)ceil($totlerows/$pageSize); 
echo "共有<FONT COLOR=#0066FF>[$totlerows]</FONT>条消息&nbsp;&nbsp;分&nbsp;<FONT  COLOR=#0066FF>$maxPage</FONT>&nbsp;页&nbsp;&nbsp;&nbsp;<FONT  COLOR=#0066FF>$pageSize</FONT>&nbsp;条/页";

if((int)$page>$maxPage) 
{
$page=$maxPage; 
}
$res=$result;
//根据偏移量($page - 1)*$pageSize,运用mysql_data_seek函数得到要显示的页面 
if(mysql_data_seek($res,($page-1)*$pageSize) ) 
{ 
$i=0; 
}
//循环显示当前纪录集 
for($i;$i< $pageSize;$i++)
{ 
echo "<tr >"; 
//得到当前纪录，填充到数组$row; 
$row= mysql_fetch_row($res); 
	if($row) 
	{ $x=$row[4];
echo "<TD  align=center class=altbg2><INPUT TYPE=\"checkbox\" NAME=\"list[]\" value=$x></TD>\n";
echo "<TD align=left class=altbg2>\n";

if ($row[5]=="0"){
	echo "<IMG SRC=\"../image/message/status_5.gif\"  BORDER=0 ALT=\"\">";}
	if($row[5]=="1"){
	echo "<IMG SRC=\"../image/message/status_6.gif\"  BORDER=0 ALT=\"\">";}
if ($row[6]==1) {//附件
echo "<IMG SRC=\"../image/message/attach.gif\"  BORDER=0 ALT=\"\">";}
else {
}

echo "<a href=opmsg.php?id=$x>".$row[0];
echo "</a></TD>\n";
echo "<TD align=center class=altbg2><a href=../addlist/pro.php?username=$row[1]>\n";
//echo $row[6];
echo $row[1];
echo "</SPAN></a></TD>\n";
echo "<TD align=middle class=altbg2>";
echo $row[2];
echo "</TD>\n";
echo "<TD align=middle class=altbg2>";
echo $row[3];
echo "</TD>\n";
	} 
echo "</tr>"; 
} 
$style = "3"; 
switch($style) 
{ 
//格式: [首页] [上页] [下页] [末页] 
case "1": 
{ 
$out = "<div align=center>"; 
echo "[共".$maxPage."页]  [第".$page."页]  "; 
//首页和上页的链接 
if( $totlerows>1 && $page>1) 
{ 
$prevPage=$page-1; 
echo "<a href=$PHP_SELF?page=1>[首页]</a>"; 
echo "<a href=$PHP_SELF?page=$prevPage >[上页]</a>  "; 
} 
//下页和末页的链接 
if( $page>=1 && $page< $maxPage) 
{ 
$nextPage= $page+1; 
echo " <a href=$PHP_SELF?page=$nextPage >[下页]</a>  "; 
echo " <a href=$PHP_SELF?page=$maxPage>[末页]</a>"; 
} 
echo "</div>"; 
echo $out; 
} 
break; 
//格式: 1 2 3 4 5 
case "2": 
{ 
$linkNum = "4";//页面上显示连接的个数显示 
//$out = "<div align=center>第 "; 
$start = ($page-round($linkNum/2))>0 ? ($page-round($linkNum/2)) : "1"; 
$end = ($page+round($linkNum/2))< $maxPage ? ($page+round($linkNum/2)) : $maxPage; 
if($page<>1) 
echo "<a href='?page=1' alt='首页'>1</a>  < <"; 
//for($t=1;$t< =$maxPage;$t++) 
for($t=$start;$t<=$end;$t++) 
{ 
echo ($page==$t) ? "<font color='red'><b>".$t."</b></font>  " : "<a href='?page=$t'>$t</a>  "; 
} 
if($page<>$maxPage) 
echo  ">>  <a href='?page=$maxPage' alt='末页'>$maxPage</a>"; 
echo "页</div>"; 
//echo $out; 
} 
break; 
//select下拉框直接跳转 
case "3": 
{ 
$out = "<div align=center>"; 
echo "第 <select style=\"width: 70px; font-size: 11px; color: rgb(137, 125, 78); background-color: rgb(230, 223, 193);\"  onchange=\"location='?page='+this.options[this.selectedIndex].value\">"; 
for($i=1; $i<=$maxPage; $i++) { 
echo "<option value='$i'".(($i==$page) ? ' selected' : '').">$i</option>"; 
} 
echo "</select> 页"; 
echo "</div>"; 
} 
break; 
default: 
echo ""; 
break; 
} 
?>
</TABLE>
</td>
</tr>
</TABLE>
<div align=center style='margin-top:10px'><INPUT TYPE="button" value=" 删 除 " class=inp2 onclick='javascript:document.getElementById("fm0").submit()'></div>
</form>
</BODY>
</HTML>