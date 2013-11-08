<?php
define('IN_EVP', true);
include("../include/checkpostandget.php");
include("../include/dbclass.php");
include("../include/session_mysql.php");
include("../include/common.php");
//session_start();
//if (!isset($_SESSION ['name']))
//{
//die("你没有权限进入本栏目!");
//}
session_start();
include("../include/check_if_iskick.php");
if (!isset($_SESSION['name'])) 
{
//超时就退出
killsession_go_index();
die("");
//die("你没有权限进入本栏目!");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> 成员列表 </TITLE>
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">
<link rel=stylesheet href="lightbox.css"  type="text/css" >
<link rel=stylesheet href="../css/css_lightbox.css" type="text/css">
<script type="text/javascript" src="lightbox.js"></script>
</HEAD>
<BODY leftmargin=0 rightmargin=0 topmargin=0>
<!-- 通讯录模块 -->
<!-- <div id="h_green_t"><h3><span>通讯录</span></h3></div> -->
<TABLE class=tableborder  cellSpacing=1 cellPadding=4 width="98%" align=center>
<tr><td class=header1 colspan=2 >成员列表</td></tr>
<tr >
<td >
<TABLE width=100%>
<TR bgColor=#ffffff>
 <td align=center width="20%" bgcolor=white  style="border-width:1px; border-color:black; border-style:solid;" height="5%" valign="top"><SPAN style="FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal">姓&nbsp;名</SPAN></FONT></B></TD>
 <TD align=center width="12%"  bgcolor=white  style="border-width:1px; border-color:black; border-style:solid;" height="12%" valign="top"><B><FONT color=#800000><B><FONT color=#800000><SPAN style="FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal">性&nbsp;别</SPAN></FONT></B></TD>
<TD align=center width="20%"  bgcolor=white  style="border-width:1px; border-color:black; border-style:solid;" height="12%" valign="top"><B><FONT color=#800000><B><FONT color=#800000><SPAN style="FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal">电子邮箱</SPAN></FONT></B></TD>
<TD align=center width="12%"  bgcolor=white  style="border-width:1px; border-color:black; border-style:solid;" height="12%" valign="top"><B><FONT color=#800000><B><FONT color=#800000><SPAN style="FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal">部&nbsp;门</SPAN></FONT></B></TD>
<TD align=center width="15%"  bgcolor=white  style="border-width:1px; border-color:black; border-style:solid;" height="12%" valign="top"><B><FONT color=#800000><B><FONT color=#800000><SPAN style="FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal">办公电话</SPAN></FONT></B></TD>
<TD align=center width="17%"  bgcolor=white  style="border-width:1px; border-color:black; border-style:solid;" height="12%" valign="top"><B><FONT color=#800000><B><FONT color=#800000><SPAN style="FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal">注册时间</SPAN></FONT></B></TD></TR>
<?php
if(!isset($_POST["pagex"]))
$page=safe_convert($_GET["page"]);
else
$page=safe_convert($_POST["pagex"]);
//echo 'page是'.$page;
//include("../include/dbclass.php");
$totlerows=$db->getcount("select * from usr ");
$sql="select t1.id, t1. email,t1.telm,t1.zhuceshijian,t2.src,t1.sex,t3.depname,t1.nickname  from usr AS t1, usrimg AS t2,department AS t3 where t1.usrimg = t2.id AND t1.department=t3.id group by id";
$result=$db->query($sql);
//分页开始
$pageSize= 20; //每页显示的记录数
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
echo "<tr onMouseOver=\"this.className=''\" onMouseOut=\"this.className=''\">"; 
//得到当前纪录，填充到数组$row; 
$row= mysql_fetch_row($res); 
	if($row) 
	{ 
$proid=$row[0];
echo "<TD ><table border=0><tr><td>";
//echo "<div class=\"pic\"><a target=_blank rel=\"lightbox\" class=\"mynobod\" href=../upload_dir/";echo $row[4]."><span>";

//echo "<IMG SRC=../upload_dir/thumb/".$row[4];
//echo "  width=62 height=62 title=\"$row[7]\" alt=\"\" border=0>";
//echo "</span></a></div>";
echo "</td><td><A href=\"pro.php?proid=$proid\"><SPAN style=\"FONT-WEIGHT: normal; \n";
echo "FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal\" title=\"查看资料\">\n";
echo $row[7];
echo "</SPAN></A></td></tr></table></TD>\n";
echo "<TD align=center ><SPAN style=\"FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; \n";
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
echo "<TD align=middle ><SPAN style=\"FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; \n";
echo "FONT-STYLE: normal; FONT-VARIANT: normal\">\n";
echo $row[3];
echo "</SPAN></TD></tr>\n";

echo "<tr ><td colspan=6 style='height:0;BORDER-BOTTOM: #cccccc 1px dashed'; align=right>&nbsp;<A href=\"pro.php?proid=$proid\">查看资料</A>&nbsp;|&nbsp;<A href='../messenge/msgpost_ubb.php?Recipient=$proid'>发送消息</A></td></tr>";
	} 

} 
$style = "2"; 
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
//if($page<>1) 
echo "<form action=?page=$page method=post><a href='?page=1' alt='首页' autocomplete = \"off\">< < </a>"; 
for($t=1;$t<=$maxPage;$t++) 
//for($t=$start;$t<=$end;$t++) 
{ 
echo ($page==$t) ? "<font color='black' style=text-decoration:underline><b>".$t."</b></font>  " : "<a href='?page=$t'>$t</a>  "; 
} 
//if($page<>$maxPage) 
//echo  "  <a href='?page=$maxPage' alt='末页' ><img src='../image/next_page_act.gif' border=0></a>&nbsp;"; 
echo  "  <a href='?page=$maxPage' alt='末页' >> ></a>&nbsp;"; 
echo "<input type=text name=pagex size=1 style=\"width:20px;height=18px;border-style:solid;border-width:1;padding-left:4;padding-right:4;padding-top:1;padding-bottom:1\"       onkeyup=\"if(event.keyCode !=37 && event.keyCode != 39) value=value.replace(/\D/g,'');\"onbeforepaste=\"clipboardData.setData('text',clipboardData.getData('text').replace(/\D/g,''))\"  autocomplete = \"off\">";
echo "&nbsp;Pages:".$page."/".$maxPage."<input type=image src='../image/btn_ok.gif'></form>"; 
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
</TABLE>
</td>
</tr>
</TABLE>
</BODY>
</HTML>