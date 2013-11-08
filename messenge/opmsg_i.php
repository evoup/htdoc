<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0028)index.php -->
<HTML xml:lang="en" xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>佳艺企业内部网 - 我的短消息</TITLE>
<META http-equiv=content-type content="text/html; charset=gb2312">
<META content=jiayi name=description>
<META content=your,keywords,goes,here name=keywords>
<META content="jiayi / Design : evoup" name=author><LINK 
href="../css/css.css" type=text/css rel=stylesheet><LINK media=all 
href="../css/style_3div.css" type=text/css rel=stylesheet>
</HEAD>
<BODY >
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
<DIV 
style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; LEFT: 0px; PADDING-BOTTOM: 5px; OVERFLOW: auto; WIDTH: 140px; PADDING-TOP: 5px; POSITION: absolute; TOP: 40px"></DIV>
<DIV id=leijia value="0"></DIV><IMG alt="" src="../image/sch.gif"></DIV><!-- WRAP CONTENT AND SIDEBAR -->
<DIV class=container-content-sidebar><!-- 	CONTENT -->
<H3 class=hide>Content</H3>
<DIV class="content content-font"><!-- Page title -->
  <!--code-->
  <!-- 模块－－查看具体信息内容 -->
<SCRIPT src='../js/static/common.js'></SCRIPT>
<?php
//来自global.php from bbg,还要把放到通用层用来经常引用
function getemot ($matches) {//Emot
	global $myemots;
	$currentemot=$matches[1];
	$emotimage=$myemots[$currentemot]['image'];
	return "<img src=\"../image/emot/{$currentemot}.gif\" border=\"0\" alt=\"$currentemot\" />";
}
//include("../include/checkpostandget.php");
include("../include/classdate.php");
include("../include/dbclass.php");
include("../include/session_mysql.php");
session_start();
include("../include/check_if_iskick.php");
require "../inc/template.inc";
$tpl = new Template("../template");
//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[##"; //修改左边界符为[##
$tpl->right_delimiter = "##]"; //修改右边界符##]
$tpl->set_file("main", "opmsg.html");

if (!isset($_SESSION ['name'])) 
{
die("你没有权限进入本栏目!");
}
$id=$_GET['id'];
//echo $id;
//echo $_SESSION[’var1’]; 
$x=$_SESSION ['name'];
$y=$_SESSION ['staff'];
//echo "$x"."[$y]" ;

function getcontent($content, $html=0, $ubb=1, $emot=1, $advanced=1) {
	$content=str_replace('[separator]', '', $content);
	$content=str_replace('[newpage]', '', $content);
if ($emot==1) {
	$content =preg_replace_callback("/\[emot\]([^ ]+?)\[\/emot\]/is", 'getemot', $content);
}
if ($ubb==1) {
	include_once  ("../include/ubb.php");
	$content =convert_ubb($content, $advanced);
}
return $content;
}
/**
+--------------------------------------------------
| 函数名：Encode($str)
| 作用：转换html代码和转行等。
| 参数：
| @param: $str：要转换的字符串
| 返回值：转换后的字符串。
+--------------------------------------------------
*/
function Encode($str){
if(!get_magic_quotes_gpc()){
$str = addslashes($str);
}
$str = htmlspecialchars($str);
$str = str_replace("\r\n","<br>",$str);
$str = str_replace("\r","<br>",$str);
$str = str_replace("\n","<br>",$str);
$str = str_replace(" ","　",$str);
$str = str_replace("'","’",$str);
return $str;
}
/**
+--------------------------------------------------
| 函数名：Decode($str)
| 作用：与Encode相反，用于修改时还原回本来的字符串
| 参数：
| @param: $str：要转换的字符串。
| 返回值：转换后的字符串。
+--------------------------------------------------
*/
function Decode($str){
$str = str_replace("<br>","\r\n",$str);
$str = str_replace("<br>","\r",$str);
$str = str_replace("<br>","\n",$str);
$str = str_replace("<","&lt;",$str);
$str = str_replace(">","&gt;",$str);
$str = str_replace("’","'",$str);
return $str;
}
$query="update msg set isread='1' where msgid={$id};";
$db->query($query);
$result=$db->query("select * from msg where msgid={$id} and inceptid={$_SESSION['id']}");
while($row=$db->getarray($result)){
if (!$row)
{die('错误的版面参数');}
$row[content]=getcontent($row[content]);
$sender=$row[sender];
$result1=$db->query("select * from usr where nickname='{$sender}'");
$row1=$db->getarray($result1);

//echo $row1[0];
//regx判断扩展名有效性
 function rexp($filename){
       while(1){
           $flag=preg_match("/\.(.*)/i",$filename,$matches);
           if ($flag == ""){
              return $filename;        
           }else{
              $filename=$matches[1];
           }
       }
   }

//$xcontd=Decode($row[content]);
//$xcontd=html_entity_decode($row[content]);

$tpl->set_var("title", "$row[title]");
$tpl->set_var("from", "$sender");
$tpl->set_var("to", "$row[inceptid]");
$tpl->set_var("time", "$row[sendtime]");
$tpl->set_var("content", "$row[content]");
$tpl->set_block("main", "list", "nlist"); 



$result2=$db->query("select * from attachments where msgid='{$id}'");



while ( $row2 = mysql_fetch_array($result2))
{$filename=$row2['name'];
$flag=strtolower(rexp($filename));
$attachment=utf8_decode($row2[name]);
//$attachmentstmp="<A href=".$DOCUMENT_ROOT."/upload_dir/attachments/$row2[src] target=_blank>$attachment</a>";
$attachmentstmp="$attachment";
if ($flag!=''){$attachmentstmp=$attachmentstmp."<img src=".$DOCUMENT_ROOT."/image/attach/$flag.gif><span style='margin-left:20px'><A HREF=\"download.php?id=$row2[ID]\" >下载附件</A></span><br>";}
$tpl->set_var("attachments", $attachmentstmp);


$tpl->parse("nlist", "list", true);
}
//下面这个算法很不好,查下怎么弄
if(!mysql_fetch_array($result2))
	{
$tpl->set_var("attachments", '');$tpl->parse("nlist", "list", true);

}

//$tpl->set_var("senderid","$row1[0]");
$senderid=$row1[0];
//未回复连接的文章标题URL传递进行加密
$title_encoded=base64_encode($row['title']);
//加密有时有乱码问题等等再说
$title_encoded=$row['title'];
//$tpl->set_var("replylink","<a href=\"msgpost_ubb.php?Recipient=$senderid&action=reply&title=$title_encoded\">回复</a> ");
$tpl->set_var("replylink","<a href=\"javascript:window.open('msgpost_ubb.php?Recipient=$senderid&action=reply&title=$title_encoded','回复','width=500,height=450');void(0);\">回复</a> ");


$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
}
//2006-6-8 09:07 PM
?><!-- <script>
//leftFrame指左边框架的名字
parent.leftFrame.location.reload();
</script> -->
<!-- 快速回复<p><input type="textarea" style="width:590px; height:100px;" ></p> -->
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
