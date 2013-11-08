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

<?php
include("../include/checkpostandget.php");
include("../include/session_mysql.php");
include("../include/dbclass.php");
session_start();
if (!isset($_SESSION ['name'])) 
{
die("你没有权限进入本栏目!");
}
if (!isset($_SESSION['acc'])||$_SESSION['acc']<5) 
{
die("你没有权限进入本栏目!");
}



//通过隐藏域的值停用帐号
//隐藏域的值
$fr= $_POST[fr];
//echo $_POST[fr];
//strval
if(!empty($fr)){
//加必要的过滤
$db=& new dbClass("root","jysysadmin","jyit","localhost");
$db->connect();
mysql_query("SET NAMES 'gbk'");
$db->select();
$sql=" UPDATE login SET enable=1 where id=$fr;";
$db->query($sql);
}
?>

<div id=h_green_t1><h3><span>人事管理</span></h3></div>
<TABLE class=border-a  height=40 cellSpacing=0 cellPadding=1 width=100% align=center border=0 >
<tr><td class=tbg colspan=2 >&nbsp;</td></tr><FORM METHOD=post ACTION="<?php echo $PHP_SELF;?>">
<tr><td width=20%>人员信息：已停用人员<br>部门&nbsp;&nbsp;
<script src="/js/dep_s.js"></script></td ><td width=80% >
</FORM></td></tr>
<tr>
<td colspan=2>
<TABLE width=100%>

<?php
$page=$_GET["page"];
$deps=$_GET["aa"];

//出于性能考虑改成引用？？
$db=& new dbClass("root","jysysadmin","jyit","localhost");
$db->connect();
mysql_query("SET NAMES 'gbk'");
$db->select();


if(!isset($deps)) 
{$deps="na";} 

if($deps=="na")
{
$sql="select t1.id, t1. email,t1.telm,t1.zhuceshijian,t2.src,t1.sex,t3.depname,t1.nickname,t4.enable  from usr AS t1, usrimg AS t2,department AS t3,login AS t4 where t1.usrimg = t2.id AND t1.department=t3.id AND t4.id=t1.id AND t4.enable=0 group by id";

}
else
{
	//缺少数字正则表达式
$sql="select t1.id, t1. email,t1.telm,t1.zhuceshijian,t2.src,t1.sex,t3.depname,t1.nickname,t4.enable  from usr AS t1, usrimg AS t2,department AS t3,login AS t4 where t1.usrimg = t2.id AND t1.department=t3.id AND t1.department='{$deps}' AND t4.id=t1.id AND t4.enable=0 group by id ";
}

$totlerows=$db->getcount($sql);

//$sql="select t1.id, t1. email,t1.tel,t1.zhuceshijian,t2.src,t1.sex,t3.depname,t1.nickname  from usr AS t1, usrimg AS t2,department AS t3 where t1.usrimg = t2.id AND t1.department=t3.id group by id";
$result=$db->query($sql);
//分页开始

$pageSize= 8; //每页显示的记录数
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
$proid=$row[0];
echo "<TD><table border=0><tr><td>";
//echo "<TD><table border=0><tr><td><div class=\"pic\"><span><IMG SRC=\n";echo $row[4];
//echo "  width=62 height=62 title=\"$row[7]\" alt=\"\"></span></div></td><td><A href=\"pro.php?proid=$proid\"><SPAN style=\"FONT-WEIGHT: normal; \n";
echo "</td><td><A href=\"pro.php?proid=$proid\"><SPAN style=\"FONT-WEIGHT: normal;FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal\" title=\"查看资料\">\n";

echo $row[7];
echo "</SPAN></A></td></tr></table></TD>\n";
echo "<TD align=center><SPAN style=\"FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; \n";
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
echo "<TD align=center><SPAN style=\"FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; \n";
echo "FONT-STYLE: normal; FONT-VARIANT: normal\">\n";
echo $row[1];
echo "</SPAN></TD>\n";
echo "<TD align=center><SPAN style=\"FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; \n";
echo "FONT-STYLE: normal; FONT-VARIANT: normal\">\n";
echo $row[6];
echo "</SPAN></TD>\n";
echo "<TD align=center><SPAN style=\"FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; \n";
echo "FONT-STYLE: normal; FONT-VARIANT: normal\">\n";
echo $row[2];
echo "</SPAN></TD>\n";
//if ($row[8]==0)
//	{echo "<td><A HREF=\"profile_edit.php\" ><IMG SRC=../image/editit.png border=0 alt=\"编辑人员资料\" title=\"编辑人员资料\"></A>&nbsp;&nbsp;<A HREF=\"\" >启用</A></td>";}
 if ($row[8]==0)
	{echo "<td><A HREF=\"profile_edit.php\"><FORM METHOD=POST ACTION=\"$PHP_SELF\"><IMG SRC=../image/editit.gif border=0 alt=\"编辑人员资料\" title=\"编辑人员资料\"></A>&nbsp;&nbsp;<INPUT TYPE=\"hidden\" value=$row[0] name=fr><input type=image class=active src=../image/active.gif onclick=\"javascript: return confirm('确实要启用该帐号？')\"  title=\"启用该帐号\"></FORM></td>";}
echo "<tr ><td colspan=6 style='BORDER-BOTTOM: #cccccc 1px dashed'  height='2'>&nbsp;</td></tr>";
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
?>
<!-- <div class="in ltin tpin">
sadsdsds
</div> -->
<tr><td align=right colspan=6><B>相关链接：<A HREF="admin.php">活动人员</A></B></td></tr>
</TABLE>
</td>
</tr>
</TABLE>
</BODY>
</HTML>
