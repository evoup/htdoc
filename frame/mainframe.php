<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> ������ </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<link rel=stylesheet href="../css/css.css" type="text/css">
</HEAD>

<BODY>
<BR>
<h3><span>��ӭ��Ϣ for E������칫ϵͳV1.0</span></h3>
<BR><BR>
ȫ�����̽�����,�ܽ���Ϊ��<FONT SIZE="" COLOR="#3366FF"><?php
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
{echo "<br><B><FONT  COLOR=#FF0000>���Ͱ���</FONT></B>";}
else if($total<60&&$total>=30)
{echo "<br><B><FONT  COLOR=#00CC00>��������</FONT></B>";}
$userinput="��ô���°�";
//$x= base64_encode($userinput);
//echo "<A HREF=$x>11</A>";
//echo "break reach";

?></FONT><BR><BR>

<UL>
	<LI>��Ʒ�����--
	<LI>ϵͳ����<?php echo $l1."%";?>
	<LI>���¹���<?php echo $l2."%";?>
	<LI>��Ŀ����<?php echo $l3."%";?>
	<LI>�ĵ�����<?php echo $l4."%";?>
	<LI>����Ϣϵͳ��<?php echo $l5."%";?>
	<LI>ͨѶ¼��<?php echo $l6."%";?>
	<LI>��˾�ճ̹���:<?php echo $l7."%";?>
	<LI>ͶƱ�䣺<?php echo $l8."%";?>

</UL>

<FONT SIZE="" COLOR="#FF0000">����BUG:</FONT><UL>
	<LI>��Ҫ���������û�ɾ�����˵Ķ���Ϣ
	<LI>��Ҫ����ͬһIP�Ķ����½����
	<li>�и��ظ�������Ϣ���ݵ����⣬����input type =hidden���
</UL>


</BODY>
</HTML>
