<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> 主界面 </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<link rel=stylesheet href="../css/css.css" type="text/css">
</HEAD>

<BODY>
<BR>
<h3><span>欢迎信息 for E普网络办公系统V1.0</span></h3>
<BR><BR>
全部工程进行中,总进度为：<FONT SIZE="" COLOR="#3366FF"><?php
$l1=0;
$l2=90;
$l3=0;
$l4=0;
$l5=85;
$l6=100;
$l7=70;
$l8=80;
$total=($l1+$l2+$l3+$l4+$l5+$l6+$l7+$l7+$l8)/8;
//$total=45;
echo $total."%";
if ($total<30)
{echo "<br><B><FONT  COLOR=#FF0000>加油啊！</FONT></B>";}
else if($total<60&&$total>=30)
{echo "<br><B><FONT  COLOR=#00CC00>继续工作</FONT></B>";}
$userinput="怎么回事啊";
//$x= base64_encode($userinput);
//echo "<A HREF=$x>11</A>";
//echo "break reach";

?></FONT><BR><BR>

<UL>
	<LI>设计方案：--
	<LI>系统管理：<?php echo $l1."%";?>
	<LI>人事管理：<?php echo $l2."%";?>
	<LI>项目管理：<?php echo $l3."%";?>
	<LI>文档管理：<?php echo $l4."%";?>
	<LI>短消息系统：<?php echo $l5."%";?>
	<LI>通讯录：<?php echo $l6."%";?>
	<LI>公司日程管理:<?php echo $l7."%";?>
	<LI>投票箱：<?php echo $l8."%";?>

</UL>

<FONT SIZE="" COLOR="#FF0000">待修BUG:</FONT><UL>
	<LI>需要限制其他用户删除别人的短消息
	<LI>需要避免同一IP的多个登陆？？
	<li>有个重复插入消息数据的问题，拟用input type =hidden解决
</UL>


</BODY>
</HTML>
