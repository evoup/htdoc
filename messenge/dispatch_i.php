<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0028)index.php -->
<HTML xml:lang="en" xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>佳艺企业内部网 - 选择要发送消息的对象</TITLE>
<META http-equiv=content-type content="text/html; charset=gb2312">
<META content=jiayi name=description>
<META content=your,keywords,goes,here name=keywords>
<META content="jiayi / Design : evoup" name=author><LINK 
href="../css/css.css" type=text/css rel=stylesheet><LINK media=all 
href="../css/style_3div.css" type=text/css rel=stylesheet>
</HEAD>
<BODY onkeydown="if(event.keyCode==27) return false;" leftMargin=10 topMargin=0 rightMargin=0 onLoad="opt.init(document.forms[0])">
<DIV id=page-container><!-- HEADER --><!-- Global Navigation -->
<H3 class=hide>全站导航</H3>
<DIV class=nav-global-container>
<DIV class="nav-global nav-global-font">
<UL>
  <LI><A href="../index.php">首页</A> </LI>
  <LI><A href="../index.php#">企业邮箱</A> </LI>
  <LI><A href="../index.php#">Impressum</A> </LI></UL></DIV></DIV><!-- Sitename and Banner -->
<DIV class=site-name>佳艺企业内部网 
<DIV class=site-slogan>佳艺腾飞，通向富有 </DIV></DIV>
<DIV><IMG class=img-header alt="" src="../image/3divheader.jpg"></DIV><!-- Main Navigation -->
<H3 class=hide>Top Navigation</H3>
<DIV class="nav-main nav-main-font">
<UL>
  <LI><A href="../index.php">首页</A> </LI>
  <LI><A class=selected href="../content.html">制度规定</A> </LI>
  <LI><A href="../options.html">选项</A> </LI></UL></DIV><!-- Sub-Navigation -->
<H3 class=hide>栏目导航</H3>
<DIV class="nav-sub nav-sub-font nav-sub-align">
<DIV class=buffer></DIV>
<SCRIPT language=JavaScript src=""></SCRIPT>
 <IMG alt="" src="../image/email.gif" border=0>短消息<A 
href="msgview_i.php">[<SPAN id=msgunread 
style="DISPLAY: inline">0</SPAN>]</A>未读 
<DIV 
style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; LEFT: 0px; PADDING-BOTTOM: 5px; OVERFLOW: auto; WIDTH: 140px; PADDING-TOP: 5px; POSITION: absolute; TOP: 40px"></DIV>
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
<DIV class=container-content-sidebar>

<DIV class="content content-font"><!-- Page title -->
<!-- <DIV class=content-pagetitle>
</DIV> -->
<!--code-->
<SCRIPT LANGUAGE="JavaScript" src='../js/static/selectbox.js'></script>
<SCRIPT LANGUAGE="JavaScript" src='../js/static/OptionTransfer.js'></SCRIPT>
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

<?php
$type=$_GET['type'];
//echo $type;
if ($type=='vis'){
echo "<form id=form1 name=form1 action='msgpost_vis2_i.php' METHOD=POST>";}
if ($type=='ubb'){
echo "<form id=form1 name=form1 action='msgpost_ubb_i.php' METHOD=POST>";}
?>
<!-- <form action="msgpost_ubb.php" METHOD=POST> -->
<TABLE  class=tableborder cellSpacing=1 cellPadding=4 width="98%">
<tr class=header1>
	<TD colspan=3>接收对象</TD>
</TR>
<TR><TD class=altbg2 COLSPAN=3><P><IMG SRC="<?php $DOCUMENT_ROOT?>/image/icoTip.gif"  BORDER="0" ALT=""> 按住ctrl或shift可以选择多个人员(如果你使用较新的浏览器，可以双击)</P></TD></TR>
<TR>
	<TD class=altbg2 width=33%><p align=center><SCRIPT src='../js/depusr_transfer.js?time=<?php echo time();?>'></SCRIPT></p><BR></TD>
	<TD class=altbg2 width=23% align=center>发送<BR><BR><INPUT TYPE="button" NAME="right" VALUE="添加&gt;&gt;" ONCLICK="opt.transferRight()"><BR><BR><INPUT TYPE="button" NAME="right" VALUE="全部&gt;&gt;" ONCLICK="opt.transferAllRight()"><BR><BR><INPUT TYPE="button" NAME="left" VALUE="删除&lt;&lt;" ONCLICK="opt.transferLeft()"><BR><BR><INPUT TYPE="button" NAME="left" VALUE="全删&lt;&lt;" ONCLICK="opt.transferAllLeft()"><BR><!-- 密送<BR><INPUT TYPE="button" NAME="right" VALUE="添加&gt;&gt;" ONCLICK="opt.transferRight()"><BR><INPUT TYPE="button" NAME="right" VALUE="全部&gt;&gt;" ONCLICK="opt.transferAllRight()"><BR><INPUT TYPE="button" NAME="left" VALUE="删除&lt;&lt;" ONCLICK="opt.transferLeft()"><BR><INPUT TYPE="button" NAME="left" VALUE="全删&lt;&lt;" ONCLICK="opt.transferAllLeft()"><BR> --></TD><TD class=altbg2 width=44%><SELECT NAME="list2" MULTIPLE SIZE=10 onDblClick="opt.transferLeft()" style="width:170px;height:155px;"></SELECT></TD>
</TR><TR>
	<TD class=altbg1 colspan=3 align=right>选择的ID: <INPUT TYPE="text" NAME="newRight" id="newRight" VALUE="" SIZE=70><INPUT TYPE="submit" value='下一步' class="inputs" ></TD>
</TR>

</TABLE>


</FORM>



<!--code-->
</DIV>
<!-- SIDEBAR -->
<H3 class=hide>Sidebar</H3>
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
target=_blank>管理登陆</A> </DIV><!-- END WRAP CONTENT AND SIDEBAR --></DIV><!-- FOOTER -->
<H3 class=hide>Footer</H3>
<DIV class="footer footer-font">Copyright &copy; 2006 佳艺企业内部网 | All Rights 
Reserved<BR>Design: Made in Jiading | Author: <A 
href="mailto:gw@actamail.com">evoup</A> | <A 
title="Validate code as W3C XHTML 1.1 Strict Compliant" 
href="http://validator.w3.org/check?uri=referer">W3C XHTML 1.1</A> | <A 
title="Validate Style Sheet as W3C CSS 2.0 Compliant" 
href="http://jigsaw.w3.org/css-validator/">W3C CSS 2.0</A> 
</DIV></DIV></BODY></HTML>
