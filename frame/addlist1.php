<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> New Document </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">

<link rel=stylesheet href="../css/css.css" type="text/css">


</HEAD>

<BODY>
<!-- ͨѶ¼ģ�� -->

<TABLE class=border-a  height=40 cellSpacing=0 cellPadding=1 width=100% align=center border=0 class=border-a>
<tr><td class=tbg colspan=2 ><IMG SRC="../image/user3.gif" WIDTH="13" HEIGHT="16" BORDER="0" ALT="">�û��б�</td></tr>
<tr>
<td>
<TABLE width=100%>
<TR bgColor=#ffffff>
 <td width="19%" bgcolor=white  style="border-width:1px; border-color:black; border-style:solid;" height="12%" valign="top"><SPAN style="FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal">����</SPAN></FONT></B></TD>
<TD align=middle width="12%"  bgcolor=white  style="border-width:1px; border-color:black; border-style:solid;" height="12%" valign="top"><B><FONT color=#800000><B><FONT color=#800000><SPAN style="FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal">�Ա�</SPAN></FONT></B></TD>
<TD align=middle width="20%"  bgcolor=white  style="border-width:1px; border-color:black; border-style:solid;" height="12%" valign="top"><B><FONT color=#800000><B><FONT color=#800000><SPAN style="FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal">��������</SPAN></FONT></B></TD>
<TD align=middle width="12%"  bgcolor=white  style="border-width:1px; border-color:black; border-style:solid;" height="12%" valign="top"><B><FONT color=#800000><B><FONT color=#800000><SPAN style="FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal">����</SPAN></FONT></B></TD>
<TD align=middle width="15%"  bgcolor=white  style="border-width:1px; border-color:black; border-style:solid;" height="12%" valign="top"><B><FONT color=#800000><B><FONT color=#800000><SPAN style="FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal">��ϵ�绰</SPAN></FONT></B></TD>
<TD align=middle width="17%"  bgcolor=white  style="border-width:1px; border-color:black; border-style:solid;" height="12%" valign="top"><B><FONT color=#800000><B><FONT color=#800000><SPAN style="FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal">ע��ʱ��</SPAN></FONT></B></TD></TR>
<?php
$page=$_GET["page"];

include("../include\dbclass.php");
$db=new dbClass("root","getter","jzoa","localhost");
$db->connect();
mysql_query("SET NAMES 'utf8'");
$db->select();



$totlerows=$db->getcount("select * from usr ");

$sql="select t1.id, t1. email,t1.tel,t1.zhuceshijian,t2.src,t1.sex,t3.depname,t1.nickname  from usr AS t1, usrimg AS t2,department AS t3 where t1.usrimg = t2.id AND t1.department=t3.id group by id";
$result=$db->query($sql);
//echo $result;
/*while($row=$db->getarray($result))
{echo "<br>";
echo "$row[0]";
echo "<br>";
echo "$row[1]";
$em=$row[1];
echo "<br>";
echo "$row[2]";
$tel=$row[2];
echo "<br>";
echo "$row[3]";
$regtime=$row[3];
echo "<br>";
echo "$row[4]";
$img=$row[4];
echo "<br>";
echo "$row[5]";
if ($row[5]=="0")
	{
	$sex="��";
	}
else if($row[5]=="1")
	{
	$sex="Ů";
	}
	echo $sex;
echo "<br>";
echo "$row[6]";
$dep=$row[6];
echo "<br>";
echo "$row[7]";
$nickname=$row[7];
}*/




//��ҳ��ʼ

$pageSize= 4; //ÿҳ��ʾ�ļ�¼��
//$page������ʾ��ǰ��ʾ��ҳ

if(!isset($page)) 
{$page=1;} 

if($page==0)
{$page=1; }
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
echo "<tr>"; 
//�õ���ǰ��¼����䵽����$row; 
$row= mysql_fetch_row($res); 
	if($row) 
	{ 
//ѭ����ʾ��ǰ��¼�������ֶ�ֵ 
	//	for($j = 0;$j <count($row);$j++) 
	//	{ 
	//	echo "<td>".$row[$j]."</td>"; 
	//	} 
	echo "<TD><IMG SRC=\n";

echo $row[4];
echo "  width=40 height=40><A href=\"pro.php?username=$row[7]\"><SPAN style=\"FONT-WEIGHT: normal; \n";
echo "FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal\">\n";

echo $row[7];
echo "</SPAN></A></TD>\n";
echo "<TD align=middle><SPAN style=\"FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; \n";
echo "FONT-STYLE: normal; FONT-VARIANT: normal\">\n";
if ($row[5]=="0")
	{
	$sex="��";
	}
else if($row[5]=="1")
	{
	$sex="Ů";
	}
echo $sex;
echo "</SPAN></TD>\n";
echo "<TD align=middle><SPAN style=\"FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; \n";
echo "FONT-STYLE: normal; FONT-VARIANT: normal\">\n";


echo $row[1];

echo "</SPAN></TD>\n";
echo "<TD align=middle><SPAN style=\"FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; \n";
echo "FONT-STYLE: normal; FONT-VARIANT: normal\">\n";

echo $row[6];
echo "</SPAN></TD>\n";
echo "<TD align=middle><SPAN style=\"FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; \n";
echo "FONT-STYLE: normal; FONT-VARIANT: normal\">\n";

echo $row[2];
echo "</SPAN></TD>\n";
echo "<TD align=middle><SPAN style=\"FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; \n";
echo "FONT-STYLE: normal; FONT-VARIANT: normal\">\n";

echo $row[3];
echo "</SPAN></TD></TD>\n";



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
echo ""; 
break; 
} 















//echo "���Զϵ�ɵ���!";






/*while($row=$db->getarray($result))
{
	echo "<TR bgColor=#ffffff>\n";
echo "<TD><IMG SRC=\n";

echo $row[4];
echo "  width=40 height=40><A href=\"pro.php?username=lwy84\"><SPAN style=\"FONT-WEIGHT: normal; \n";
echo "FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal\">\n";

echo $row[7];
echo "</SPAN></A></TD>\n";
echo "<TD align=middle><SPAN style=\"FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; \n";
echo "FONT-STYLE: normal; FONT-VARIANT: normal\">\n";
if ($row[5]=="0")
	{
	$sex="��";
	}
else if($row[5]=="1")
	{
	$sex="Ů";
	}
echo $sex;
echo "</SPAN></TD>\n";
echo "<TD align=middle><SPAN style=\"FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; \n";
echo "FONT-STYLE: normal; FONT-VARIANT: normal\">\n";


echo $row[1];

echo "</SPAN></TD>\n";
echo "<TD align=middle><SPAN style=\"FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; \n";
echo "FONT-STYLE: normal; FONT-VARIANT: normal\">\n";

echo $row[6];
echo "</SPAN></TD>\n";
echo "<TD align=middle><SPAN style=\"FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; \n";
echo "FONT-STYLE: normal; FONT-VARIANT: normal\">\n";

echo $row[2];
echo "</SPAN></TD>\n";
echo "<TD align=middle><SPAN style=\"FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; \n";
echo "FONT-STYLE: normal; FONT-VARIANT: normal\">\n";

echo $row[3];
echo "</SPAN></TD></TD></TR>\n";
}*/


?>


</TABLE>
</td>
</tr>



</TABLE>


















</BODY>
</HTML>
