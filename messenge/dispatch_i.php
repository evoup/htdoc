<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0028)index.php -->
<HTML xml:lang="en" xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>������ҵ�ڲ��� - ѡ��Ҫ������Ϣ�Ķ���</TITLE>
<META http-equiv=content-type content="text/html; charset=gb2312">
<META content=jiayi name=description>
<META content=your,keywords,goes,here name=keywords>
<META content="jiayi / Design : evoup" name=author><LINK 
href="../css/css.css" type=text/css rel=stylesheet><LINK media=all 
href="../css/style_3div.css" type=text/css rel=stylesheet>
</HEAD>
<BODY onkeydown="if(event.keyCode==27) return false;" leftMargin=10 topMargin=0 rightMargin=0 onLoad="opt.init(document.forms[0])">
<DIV id=page-container><!-- HEADER --><!-- Global Navigation -->
<H3 class=hide>ȫվ����</H3>
<DIV class=nav-global-container>
<DIV class="nav-global nav-global-font">
<UL>
  <LI><A href="../index.php">��ҳ</A> </LI>
  <LI><A href="../index.php#">��ҵ����</A> </LI>
  <LI><A href="../index.php#">Impressum</A> </LI></UL></DIV></DIV><!-- Sitename and Banner -->
<DIV class=site-name>������ҵ�ڲ��� 
<DIV class=site-slogan>�����ڷɣ�ͨ���� </DIV></DIV>
<DIV><IMG class=img-header alt="" src="../image/3divheader.jpg"></DIV><!-- Main Navigation -->
<H3 class=hide>Top Navigation</H3>
<DIV class="nav-main nav-main-font">
<UL>
  <LI><A href="../index.php">��ҳ</A> </LI>
  <LI><A class=selected href="../content.html">�ƶȹ涨</A> </LI>
  <LI><A href="../options.html">ѡ��</A> </LI></UL></DIV><!-- Sub-Navigation -->
<H3 class=hide>��Ŀ����</H3>
<DIV class="nav-sub nav-sub-font nav-sub-align">
<DIV class=buffer></DIV>
<SCRIPT language=JavaScript src=""></SCRIPT>
 <IMG alt="" src="../image/email.gif" border=0>����Ϣ<A 
href="msgview_i.php">[<SPAN id=msgunread 
style="DISPLAY: inline">0</SPAN>]</A>δ�� 
<DIV 
style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; LEFT: 0px; PADDING-BOTTOM: 5px; OVERFLOW: auto; WIDTH: 140px; PADDING-TOP: 5px; POSITION: absolute; TOP: 40px"></DIV>
<DIV id=leijia value="0"></DIV><IMG alt="" src="../image/sch.gif"> <!--<ul>
        <li class="title">����</li>
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
//����
opt.setStaticOptionRegex("^(Bill|Bob|Matt)$");
opt.saveRemovedLeftOptions("removedLeft");
opt.saveRemovedRightOptions("removedRight");
opt.saveAddedLeftOptions("addedLeft");
opt.saveAddedRightOptions("addedRight");
opt.saveNewLeftOptions("newLeft");
opt.saveNewRightOptions("newRight");
</SCRIPT>
</HEAD>
<!--�������onload-->

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
	<TD colspan=3>���ն���</TD>
</TR>
<TR><TD class=altbg2 COLSPAN=3><P><IMG SRC="<?php $DOCUMENT_ROOT?>/image/icoTip.gif"  BORDER="0" ALT=""> ��סctrl��shift����ѡ������Ա(�����ʹ�ý��µ������������˫��)</P></TD></TR>
<TR>
	<TD class=altbg2 width=33%><p align=center><SCRIPT src='../js/depusr_transfer.js?time=<?php echo time();?>'></SCRIPT></p><BR></TD>
	<TD class=altbg2 width=23% align=center>����<BR><BR><INPUT TYPE="button" NAME="right" VALUE="���&gt;&gt;" ONCLICK="opt.transferRight()"><BR><BR><INPUT TYPE="button" NAME="right" VALUE="ȫ��&gt;&gt;" ONCLICK="opt.transferAllRight()"><BR><BR><INPUT TYPE="button" NAME="left" VALUE="ɾ��&lt;&lt;" ONCLICK="opt.transferLeft()"><BR><BR><INPUT TYPE="button" NAME="left" VALUE="ȫɾ&lt;&lt;" ONCLICK="opt.transferAllLeft()"><BR><!-- ����<BR><INPUT TYPE="button" NAME="right" VALUE="���&gt;&gt;" ONCLICK="opt.transferRight()"><BR><INPUT TYPE="button" NAME="right" VALUE="ȫ��&gt;&gt;" ONCLICK="opt.transferAllRight()"><BR><INPUT TYPE="button" NAME="left" VALUE="ɾ��&lt;&lt;" ONCLICK="opt.transferLeft()"><BR><INPUT TYPE="button" NAME="left" VALUE="ȫɾ&lt;&lt;" ONCLICK="opt.transferAllLeft()"><BR> --></TD><TD class=altbg2 width=44%><SELECT NAME="list2" MULTIPLE SIZE=10 onDblClick="opt.transferLeft()" style="width:170px;height:155px;"></SELECT></TD>
</TR><TR>
	<TD class=altbg1 colspan=3 align=right>ѡ���ID: <INPUT TYPE="text" NAME="newRight" id="newRight" VALUE="" SIZE=70><INPUT TYPE="submit" value='��һ��' class="inputs" ></TD>
</TR>

</TABLE>


</FORM>



<!--code-->
</DIV>
<!-- SIDEBAR -->
<H3 class=hide>Sidebar</H3>
<DIV class="sidebar sidebar-font">
<DIV class="sidebarbox-border bg-yellow03">
<DIV class="sidebarbox-title-shading bg-yellow07">����</DIV>
<P><INPUT style="WIDTH: 100px"> <IMG height=22 alt="" 
src="../image/search02.jpg" width=80 align=right></P>
<P>������</P></DIV>
<DIV class="sidebarbox-border bg-blue02">
<DIV class="sidebarbox-title-shading bg-blue05 txt-white">���ʹ�������</DIV>
<P>ҵ��������ʵʩϸ�����۸壩</P></DIV>
<DIV class="sidebarbox-border bg-green02">
<DIV class="sidebarbox-title-shading bg-green05 txt-white">��������</DIV>
<P>���ս���ӯ��������1�������ԣ�</P></DIV>
<DIV class="sidebarbox-border bg-red02">
<DIV class="sidebarbox-title-shading bg-red05 txt-white">��Ϣ������</DIV>
<P>������Ϣ����ĿͶ����2��...</P></DIV><A href="admin/admin_login.php" 
target=_blank>�����½</A> </DIV><!-- END WRAP CONTENT AND SIDEBAR --></DIV><!-- FOOTER -->
<H3 class=hide>Footer</H3>
<DIV class="footer footer-font">Copyright &copy; 2006 ������ҵ�ڲ��� | All Rights 
Reserved<BR>Design: Made in Jiading | Author: <A 
href="mailto:gw@actamail.com">evoup</A> | <A 
title="Validate code as W3C XHTML 1.1 Strict Compliant" 
href="http://validator.w3.org/check?uri=referer">W3C XHTML 1.1</A> | <A 
title="Validate Style Sheet as W3C CSS 2.0 Compliant" 
href="http://jigsaw.w3.org/css-validator/">W3C CSS 2.0</A> 
</DIV></DIV></BODY></HTML>
