<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0028)index.php -->
<HTML xml:lang="en" xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>������ҵ�ڲ��� - ����Ϣ</TITLE>
<META http-equiv=content-type content="text/html; charset=gb2312">
<META content=jiayi name=description>
<META content=your,keywords,goes,here name=keywords>
<META content="jiayi / Design : evoup" name=author><LINK media=all 
href="../css/style_3div.css" type=text/css rel=stylesheet>
<link rel=stylesheet href="../css/css.css" type="text/css">
</HEAD>
<BODY>
<DIV id=page-container><!-- HEADER --><!-- Global Navigation -->
<H3 class=hide>ȫվ����</H3>
<DIV class=nav-global-container>
<DIV class="nav-global nav-global-font">
<UL>
  <LI><A href="index.php">����Ϣ</A> </LI>
  <LI><A href="index.php#">��ҵ����</A> </LI>
  <LI><A href="index.php#">Impressum</A> </LI></UL></DIV></DIV><!-- Sitename and Banner -->
<DIV class=site-name>������ҵ�ڲ��� 
<DIV class=site-slogan>�����ڷɣ�ͨ���� </DIV></DIV>
<DIV><IMG class=img-header alt="" src="../image/3divheader.jpg"></DIV><!-- Main Navigation -->
<H3 class=hide>Top Navigation</H3>
<DIV class="nav-main nav-main-font">
<UL>
  <LI><A href="../index.php">��ҳ</A> </LI>
  <LI><A class=selected href="content.html">�ƶȹ涨</A> </LI>
  <LI><A href="options.html">ѡ��</A> </LI></UL></DIV><!-- Sub-Navigation -->
<H3 class=hide>��Ŀ����</H3>
<DIV class="nav-sub nav-sub-font nav-sub-align">
<DIV class=buffer></DIV>
<SCRIPT language=JavaScript src=""></SCRIPT><BR>
 <IMG alt="" src="../image/email.gif" border=0>����Ϣ<A 
href="msgview_i.php">[<SPAN id=msgunread 
style="DISPLAY: inline">0</SPAN>]</A>δ�� 
<DIV 
style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; LEFT: 0px; PADDING-BOTTOM: 5px; OVERFLOW: auto; WIDTH: 140px; PADDING-TOP: 5px; POSITION: absolute; TOP: 40px"></DIV><A HREF="dispatch_i.php?type=ubb"><h3 ><img alt='' src='../image/massemail.png' width=30px height=30px border=0/>������Ϣ</h3></A>
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
<DIV class=container-content-sidebar><!-- 	CONTENT -->
<H3 class=hide>Content</H3>
<DIV ><!-- Page title -->
  <!--code-->
  <!-- checkboxȫѡ -->
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
die("��û��Ȩ�޽��뱾��Ŀ!");
}
?>
<form id =fm0 action="delmsg.php" method="post" >
  <table class=tableborder  height=40 cellspacing=1 cellpadding=4 width=80�� align=left border=0 style='margin-left:3px;margin-top:20px'>
 
    <tr>
      <td class=header1 colspan=2 >��Ϣ�б�</td>
    </tr>
    <tr >
      <td class=altbg2><table width=100% cellspacing=1 cellpadding=4 class=tableborder>
          <tr >
            <td align=middle width="10%"   class=altbg1 ><input type="checkbox" name="Input" onClick="this.value=check(document.getElementsByName('list[]'))">
              ȫѡ</td>
            <td align=middle width="30%"  class=altbg1>����</td>
            <td align=middle width="20%"  class=altbg1 >����</td>
            <td align=middle width="20%"  class=altbg1 >ʱ��</td>
            <td align=middle width="10%"  class=altbg1 >��Ҫ�ȼ�</td>
          </tr>
          <?php
$page=$_GET["page"];



$sql="select title,sender,sendtime,important,msgid,isread,withattach from msg where inceptid={$_SESSION['id']} order by msgid desc";
$totlerows=$db->getcount($sql);
$result=$db->query($sql);

//��ҳ��ʼ
$pageSize= 8; //ÿҳ��ʾ�ļ�¼��
//$page������ʾ��ǰ��ʾ��ҳ
if(!isset($page)) 
{$page=1;} 
if($page==0)
{$page=1;}
//�õ���ǰ��ѯ���ļ�¼�� $totlerows 
//$totlerows= mysql_num_rows($res);

//if($totlerows<=0)
if($totlerows<=0)
{ 
echo "<p align=center>û�м�¼"; 
exit; 
} 
//�õ����ҳ����maxPage 
$maxPage = (int)ceil($totlerows/$pageSize); 
echo "����<FONT COLOR=#0066FF>[$totlerows]</FONT>����Ϣ&nbsp;&nbsp;��&nbsp;<FONT  COLOR=#0066FF>$maxPage</FONT>&nbsp;ҳ&nbsp;&nbsp;&nbsp;<FONT  COLOR=#0066FF>$pageSize</FONT>&nbsp;��/ҳ";

if((int)$page>$maxPage) 
{
$page=$maxPage; 
}
$res=$result;
//����ƫ����($page - 1)*$pageSize,����mysql_data_seek�����õ�Ҫ��ʾ��ҳ�� 
if(mysql_data_seek($res,($page-1)*$pageSize) ) 
{ 
$i=0; 
}
//ѭ����ʾ��ǰ��¼�� 
for($i;$i< $pageSize;$i++)
{ 
echo "<tr >"; 
//�õ���ǰ��¼����䵽����$row; 
$row= mysql_fetch_row($res); 
	if($row) 
	{ $x=$row[4];
echo "<TD  align=center class=altbg2><INPUT TYPE=\"checkbox\" NAME=\"list[]\" value=$x></TD>\n";
echo "<TD align=left class=altbg2>\n";

if ($row[5]=="0"){
	echo "<IMG SRC=\"../image/message/status_5.gif\"  BORDER=0 ALT=\"\">";}
	if($row[5]=="1"){
	echo "<IMG SRC=\"../image/message/status_6.gif\"  BORDER=0 ALT=\"\">";}
if ($row[6]==1) {//����
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
//��ʽ: [��ҳ] [��ҳ] [��ҳ] [ĩҳ] 
case "1": 
{ 
$out = "<div align=center>"; 
echo "[��".$maxPage."ҳ]  [��".$page."ҳ]  "; 
//��ҳ����ҳ������ 
if( $totlerows>1 && $page>1) 
{ 
$prevPage=$page-1; 
echo "<a href=$PHP_SELF?page=1>[��ҳ]</a>"; 
echo "<a href=$PHP_SELF?page=$prevPage >[��ҳ]</a>  "; 
} 
//��ҳ��ĩҳ������ 
if( $page>=1 && $page< $maxPage) 
{ 
$nextPage= $page+1; 
echo " <a href=$PHP_SELF?page=$nextPage >[��ҳ]</a>  "; 
echo " <a href=$PHP_SELF?page=$maxPage>[ĩҳ]</a>"; 
} 
echo "</div>"; 
echo $out; 
} 
break; 
//��ʽ: 1 2 3 4 5 
case "2": 
{ 
$linkNum = "4";//ҳ������ʾ���ӵĸ�����ʾ 
//$out = "<div align=center>�� "; 
$start = ($page-round($linkNum/2))>0 ? ($page-round($linkNum/2)) : "1"; 
$end = ($page+round($linkNum/2))< $maxPage ? ($page+round($linkNum/2)) : $maxPage; 
if($page<>1) 
echo "<a href='?page=1' alt='��ҳ'>1</a>  < <"; 
//for($t=1;$t< =$maxPage;$t++) 
for($t=$start;$t<=$end;$t++) 
{ 
echo ($page==$t) ? "<font color='red'><b>".$t."</b></font>  " : "<a href='?page=$t'>$t</a>  "; 
} 
if($page<>$maxPage) 
echo  ">>  <a href='?page=$maxPage' alt='ĩҳ'>$maxPage</a>"; 
echo "ҳ</div>"; 
//echo $out; 
} 
break; 
//select������ֱ����ת 
case "3": 
{ 
$out = "<div align=center>"; 
echo "�� <select style=\"width: 70px; font-size: 11px; color: rgb(137, 125, 78); background-color: rgb(230, 223, 193);\"  onchange=\"location='?page='+this.options[this.selectedIndex].value\">"; 
for($i=1; $i<=$maxPage; $i++) { 
echo "<option value='$i'".(($i==$page) ? ' selected' : '').">$i</option>"; 
} 
echo "</select> ҳ"; 
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
	<tr><td><div align=center style='margin-top:10px'><INPUT TYPE="button" value=" ɾ �� " class=inp2 onclick='javascript:document.getElementById("fm0").submit()'></div></td></tr>
  </table>
  
</form>










<!--code-->

</DIV>
<!-- SIDEBAR -->
<!--<H3 class=hide>Sidebar</H3>
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
target=_blank>�����½</A> </DIV>--><!-- END WRAP CONTENT AND SIDEBAR --></DIV><!-- FOOTER -->
<H3 class=hide>Footer</H3>
<DIV class="footer footer-font">Copyright &copy; 2006 ������ҵ�ڲ��� | All Rights 
Reserved<BR>Design: Made in Jiading | Author: <A 
href="mailto:gw@actamail.com">evoup</A> | <A 
title="Validate code as W3C XHTML 1.1 Strict Compliant" 
href="http://validator.w3.org/check?uri=referer">W3C XHTML 1.1</A> | <A 
title="Validate Style Sheet as W3C CSS 2.0 Compliant" 
href="http://jigsaw.w3.org/css-validator/">W3C CSS 2.0</A> 
</DIV></DIV></BODY></HTML>
