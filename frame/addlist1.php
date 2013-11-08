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
<!-- 通讯录模块 -->

<TABLE class=border-a  height=40 cellSpacing=0 cellPadding=1 width=100% align=center border=0 class=border-a>
<tr><td class=tbg colspan=2 ><IMG SRC="../image/user3.gif" WIDTH="13" HEIGHT="16" BORDER="0" ALT="">用户列表</td></tr>
<tr>
<td>
<TABLE width=100%>
<TR bgColor=#ffffff>
 <td width="19%" bgcolor=white  style="border-width:1px; border-color:black; border-style:solid;" height="12%" valign="top"><SPAN style="FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal">姓名</SPAN></FONT></B></TD>
<TD align=middle width="12%"  bgcolor=white  style="border-width:1px; border-color:black; border-style:solid;" height="12%" valign="top"><B><FONT color=#800000><B><FONT color=#800000><SPAN style="FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal">性别</SPAN></FONT></B></TD>
<TD align=middle width="20%"  bgcolor=white  style="border-width:1px; border-color:black; border-style:solid;" height="12%" valign="top"><B><FONT color=#800000><B><FONT color=#800000><SPAN style="FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal">电子邮箱</SPAN></FONT></B></TD>
<TD align=middle width="12%"  bgcolor=white  style="border-width:1px; border-color:black; border-style:solid;" height="12%" valign="top"><B><FONT color=#800000><B><FONT color=#800000><SPAN style="FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal">部门</SPAN></FONT></B></TD>
<TD align=middle width="15%"  bgcolor=white  style="border-width:1px; border-color:black; border-style:solid;" height="12%" valign="top"><B><FONT color=#800000><B><FONT color=#800000><SPAN style="FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal">联系电话</SPAN></FONT></B></TD>
<TD align=middle width="17%"  bgcolor=white  style="border-width:1px; border-color:black; border-style:solid;" height="12%" valign="top"><B><FONT color=#800000><B><FONT color=#800000><SPAN style="FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal">注册时间</SPAN></FONT></B></TD></TR>
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
	$sex="男";
	}
else if($row[5]=="1")
	{
	$sex="女";
	}
	echo $sex;
echo "<br>";
echo "$row[6]";
$dep=$row[6];
echo "<br>";
echo "$row[7]";
$nickname=$row[7];
}*/




//分页开始

$pageSize= 4; //每页显示的记录数
//$page变量标示当前显示的页

if(!isset($page)) 
{$page=1;} 

if($page==0)
{$page=1; }
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
echo "共有<FONT COLOR=#0066FF>[$totlerows]</FONT>条信息&nbsp;&nbsp;分&nbsp;<FONT  COLOR=#0066FF>$maxPage</FONT>&nbsp;页&nbsp;&nbsp;&nbsp;<FONT  COLOR=#0066FF>$pageSize</FONT>&nbsp;条/页";
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
echo "<tr>"; 
//得到当前纪录，填充到数组$row; 
$row= mysql_fetch_row($res); 
	if($row) 
	{ 
//循环显示当前纪录的所有字段值 
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
	$sex="男";
	}
else if($row[5]=="1")
	{
	$sex="女";
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















//echo "测试断点可到达!";






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
	$sex="男";
	}
else if($row[5]=="1")
	{
	$sex="女";
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
