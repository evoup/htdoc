<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0028)index.php -->
<HTML xml:lang="en" xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>佳艺企业内部网 - 短消息</TITLE>
<META http-equiv=content-type content="text/html; charset=gb2312">
<META content=jiayi name=description>
<META content=your,keywords,goes,here name=keywords>
<META content="jiayi / Design : evoup" name=author><LINK media=all 
href="../css/style_3div.css" type=text/css rel=stylesheet>
<link rel=stylesheet href="../css/css.css" type="text/css">
</HEAD>
<BODY>
<DIV id=page-container><!-- HEADER --><!-- Global Navigation -->
<H3 class=hide>全站导航</H3>
<DIV class=nav-global-container>
<DIV class="nav-global nav-global-font">
<UL>
  <LI><A href="index.php">短消息</A> </LI>
  <LI><A href="index.php#">企业邮箱</A> </LI>
  <LI><A href="index.php#">Impressum</A> </LI></UL></DIV></DIV><!-- Sitename and Banner -->
<DIV class=site-name>佳艺企业内部网 
<DIV class=site-slogan>佳艺腾飞，通向富有 </DIV></DIV>
<DIV><IMG class=img-header alt="" src="../image/3divheader.jpg"></DIV><!-- Main Navigation -->
<H3 class=hide>Top Navigation</H3>
<DIV class="nav-main nav-main-font">
<UL>
  <LI><A href="../index.php">首页</A> </LI>
  <LI><A class=selected href="content.html">制度规定</A> </LI>
  <LI><A href="options.html">选项</A> </LI></UL></DIV><!-- Sub-Navigation -->
<H3 class=hide>栏目导航</H3>
<DIV class="nav-sub nav-sub-font nav-sub-align">
<DIV class=buffer></DIV>
<SCRIPT language=JavaScript src=""></SCRIPT><BR>
 <IMG alt="" src="../image/email.gif" border=0>短消息<A 
href="msgview_i.php">[<SPAN id=msgunread 
style="DISPLAY: inline">0</SPAN>]</A>未读 
<DIV 
style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; LEFT: 0px; PADDING-BOTTOM: 5px; OVERFLOW: auto; WIDTH: 140px; PADDING-TOP: 5px; POSITION: absolute; TOP: 40px"></DIV><A HREF="dispatch_i.php?type=ubb"><h3 ><img alt='' src='../image/massemail.png' width=30px height=30px border=0/>发送消息</h3></A>
<DIV id=leijia value="0"></DIV><IMG alt="" src="../image/sch.gif"> <!--<ul>
        <li class="title">导航</li>
        <li class="group"><a href="content.html">Group link 1</a></li>		
        <li><a href="#" class="selected">Sublink 1-1</a></li>
        <li><a href="#">Sublink 1-2</a></li>
		    <li><a href="#">Sublink 1-3</a></li>
        <li class="group"><a href="#">Group Link 2</a></li>
        <li><a href="#">Sublink 2-1</a></li>
        <li><a href="#">Sublink 2-2</a></li>
        <li><a href="#">Sublink 2-3</a></li>
        <li><a href="#">Sublink 2-4</a></li>				
        <li class="group"><a href="#">Group link 3</a></li>
        <li class="group"><a href="#">Group link 4</a></li>
        <li class="group"><a href="#">Group link 5</a></li>
      </ul>--></DIV><!-- WRAP CONTENT AND SIDEBAR -->
<DIV class=container-content-sidebar><!-- 	CONTENT -->
<H3 class=hide>Content</H3>
<DIV ><!-- Page title -->
  <!--code-->
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
<BODY>
<?php
include("../include/checkpostandget.php");
include("../include/dbclass.php");
include("../include/session_mysql.php");
session_start();
include("../include/check_if_iskick.php");
if (!isset($_SESSION['name'])) 
{
die("你没有权限进入本栏目!");
}
?>
<form id =fm0 action="delmsg.php" method="post" >
  <table class=tableborder  height=40 cellspacing=1 cellpadding=4 width=80％ align=left border=0 style='margin-left:3px;margin-top:20px'>
 
    <tr>
      <td class=header1 colspan=2 >消息列表</td>
    </tr>
    <tr >
      <td class=altbg2><table width=100% cellspacing=1 cellpadding=4 class=tableborder>
          <tr >
            <td align=middle width="10%"   class=altbg1 ><input type="checkbox" name="Input" onClick="this.value=check(document.getElementsByName('list[]'))">
              全选</td>
            <td align=middle width="30%"  class=altbg1>主题</td>
            <td align=middle width="20%"  class=altbg1 >来自</td>
            <td align=middle width="20%"  class=altbg1 >时间</td>
            <td align=middle width="10%"  class=altbg1 >重要等级</td>
          </tr>
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

echo "<a href=opmsg_i.php?id=$x>".$row[0];
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
//echo ""; 
break; 




} 
?>
      </table></td>
    </tr>
	<tr><td><div align=center style='margin-top:10px'><INPUT TYPE="button" value=" 删 除 " class=inp2 onclick='javascript:document.getElementById("fm0").submit()'></div></td></tr>
  </table>
  
</form>










<!--code-->

</DIV>
<!-- SIDEBAR -->
<!--<H3 class=hide>Sidebar</H3>
<DIV class="sidebar sidebar-font">
<DIV class="sidebarbox-border bg-yellow03">
<DIV class="sidebarbox-title-shading bg-yellow07">搜索</DIV>
<P><INPUT style="WIDTH: 100px"> <IMG height=22 alt="" 
src="../image/search02.jpg" width=80 align=right></P>
<P>建设中</P></DIV>
<DIV class="sidebarbox-border bg-blue02">
<DIV class="sidebarbox-title-shading bg-blue05 txt-white">访问过的连接</DIV>
<P>业务操作规程实施细则（讨论稿）</P></DIV>
<DIV class="sidebarbox-border bg-green02">
<DIV class="sidebarbox-title-shading bg-green05 txt-white">佳艺新闻</DIV>
<P>佳艺今年盈利又上了1％（测试）</P></DIV>
<DIV class="sidebarbox-border bg-red02">
<DIV class="sidebarbox-title-shading bg-red05 txt-white">信息化新闻</DIV>
<P>今年信息化项目投入了2个...</P></DIV><A href="admin/admin_login.php" 
target=_blank>管理登陆</A> </DIV>--><!-- END WRAP CONTENT AND SIDEBAR --></DIV><!-- FOOTER -->
<H3 class=hide>Footer</H3>
<DIV class="footer footer-font">Copyright &copy; 2006 佳艺企业内部网 | All Rights 
Reserved<BR>Design: Made in Jiading | Author: <A 
href="mailto:gw@actamail.com">evoup</A> | <A 
title="Validate code as W3C XHTML 1.1 Strict Compliant" 
href="http://validator.w3.org/check?uri=referer">W3C XHTML 1.1</A> | <A 
title="Validate Style Sheet as W3C CSS 2.0 Compliant" 
href="http://jigsaw.w3.org/css-validator/">W3C CSS 2.0</A> 
</DIV></DIV></BODY></HTML>
