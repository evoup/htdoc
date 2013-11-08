<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0041)messenge/msgview_i.php -->
<!-- saved from url=(0028)index.php --><HTML 
xmlns="http://www.w3.org/1999/xhtml" 
xml:lang="en"><HEAD><TITLE>佳艺企业内部网 - 首页</TITLE>
<META http-equiv=content-type content="text/html; charset=gb2312">
<META content=jiayi name=description>
<META content=your,keywords,goes,here name=keywords>
<META content="jiayi / Design : evoup" name=author><LINK media=all 
href="css/style_3div.css" type=text/css rel=stylesheet><LINK 
href="css/css.css" type=text/css rel=stylesheet>
</HEAD>
<BODY>
<?php
include("include/checkpostandget.php");
include("include/session_mysql.php");
include("include/dbclass.php");
session_start();
if (!isset($_SESSION ['name']))
{
die("你没有权限进入本栏目!");
}
?>
<DIV id=page-container><!-- HEADER --><!-- Global Navigation -->
<H3 class=hide>全站导航</H3>
<DIV class=nav-global-container>
<DIV class="nav-global nav-global-font">
<UL>
  <LI><A href="messenge/index.php">短消息</A> </LI>
  <LI><A href="messenge/index.php#">企业邮箱</A> </LI>
  <LI><A href="messenge/index.php#">Impressum</A> 
</LI></UL></DIV></DIV><!-- Sitename and Banner -->
<DIV class=site-name>佳艺企业内部网 
<DIV class=site-slogan>佳艺腾飞，通向富有 </DIV></DIV>
<DIV><IMG class=img-header alt="" src="image/3divheader.jpg"></DIV><!-- Main Navigation -->
<H3 class=hide>Top Navigation</H3>
<DIV class="nav-main nav-main-font">
<UL>
  <LI><A href="index.php">首页</A> </LI>
  <LI><A class=selected href="messenge/content.html">制度规定</A> 
  </LI>
  <LI><A href="messenge/options.html">选项</A> </LI></UL></DIV><!-- Sub-Navigation -->
<H3 class=hide>栏目导航</H3>
<DIV class="nav-sub nav-sub-font nav-sub-align">
<DIV class=buffer></DIV>
<IMG alt="" src="image/sch.gif"></DIV><!-- WRAP CONTENT AND SIDEBAR -->
<DIV class=container-content-sidebar><!-- 	CONTENT -->
<H3 class=hide>Content</H3><SCRIPT LANGUAGE="JavaScript">
<!--
function ck(){
if (document.getElementById('newpass').value=='')
	{
alert ("请填写密码！");
return false;
}
}
//-->
</SCRIPT>
<DIV><!-- Page title --><!--code--><form action='console/changepwd.php' method=post onsubmit="javascript :return ck();">
<TABLE class=tableborder cellSpacing=1 cellPadding=4 width="60%" style='margin-top:70px;margin-left:10%;'>
  <TBODY>
  <TR class=header1>
    <TD colSpan=2>修改密码</TD>
  </TR>
  <TR>
    <TD class=altbg2 colSpan=2>
      <P><IMG alt="" src="image/icoTip.gif" border=0> 
      初始密码为8888，请及时自行修改！建议6－8个数字或英文</P></TD></TR>
  <TR>
    <TD class=altbg2 width="33%">
      <P align=center>新密码<BR>
      </P></TD>
    
    <TD class=altbg2 width="44%"><input type="password" name=newpass id=newpass></TD>
  </TR>
  <TR>
    <TD class=altbg1 align=center colSpan=2><INPUT class=inputs type=submit value=修改></TD></TR></TBODY></TABLE>
</form>


<!--code--></DIV></DIV><!-- FOOTER -->
<H3 class=hide>Footer</H3>
<DIV class="footer footer-font">Copyright &copy; 2006 佳艺企业内部网 | All Rights 
Reserved<BR>Design: Made in Jiading | Author: <A 
href="mailto:evoex@126.com">evoup</A> | <A 
title="Validate code as W3C XHTML 1.1 Strict Compliant" 
href="http://validator.w3.org/check?uri=referer">W3C XHTML 1.1</A> | <A 
title="Validate Style Sheet as W3C CSS 2.0 Compliant" 
href="http://jigsaw.w3.org/css-validator/">W3C CSS 2.0</A> 
</DIV></DIV></BODY></HTML>
