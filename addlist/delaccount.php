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
die("��û��Ȩ�޽��뱾��Ŀ!");
}
if (!isset($_SESSION['acc'])||$_SESSION['acc']<5) 
{
die("��û��Ȩ�޽��뱾��Ŀ!");
}



//ͨ���������ֵͣ���ʺ�
//�������ֵ
$fr= $_POST[fr];
//echo $_POST[fr];
//strval
if(!empty($fr)){
//�ӱ�Ҫ�Ĺ���
$db=& new dbClass("root","jysysadmin","jyit","localhost");
$db->connect();
mysql_query("SET NAMES 'gbk'");
$db->select();
$sql=" UPDATE login SET enable=1 where id=$fr;";
$db->query($sql);
}
?>

<div id=h_green_t1><h3><span>���¹���</span></h3></div>
<TABLE class=border-a  height=40 cellSpacing=0 cellPadding=1 width=100% align=center border=0 >
<tr><td class=tbg colspan=2 >&nbsp;</td></tr><FORM METHOD=post ACTION="<?php echo $PHP_SELF;?>">
<tr><td width=20%>��Ա��Ϣ����ͣ����Ա<br>����&nbsp;&nbsp;
<script src="/js/dep_s.js"></script></td ><td width=80% >
</FORM></td></tr>
<tr>
<td colspan=2>
<TABLE width=100%>

<?php
$page=$_GET["page"];
$deps=$_GET["aa"];

//�������ܿ��Ǹĳ����ã���
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
	//ȱ������������ʽ
$sql="select t1.id, t1. email,t1.telm,t1.zhuceshijian,t2.src,t1.sex,t3.depname,t1.nickname,t4.enable  from usr AS t1, usrimg AS t2,department AS t3,login AS t4 where t1.usrimg = t2.id AND t1.department=t3.id AND t1.department='{$deps}' AND t4.id=t1.id AND t4.enable=0 group by id ";
}

$totlerows=$db->getcount($sql);

//$sql="select t1.id, t1. email,t1.tel,t1.zhuceshijian,t2.src,t1.sex,t3.depname,t1.nickname  from usr AS t1, usrimg AS t2,department AS t3 where t1.usrimg = t2.id AND t1.department=t3.id group by id";
$result=$db->query($sql);
//��ҳ��ʼ

$pageSize= 8; //ÿҳ��ʾ�ļ�¼��
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
$proid=$row[0];
echo "<TD><table border=0><tr><td>";
//echo "<TD><table border=0><tr><td><div class=\"pic\"><span><IMG SRC=\n";echo $row[4];
//echo "  width=62 height=62 title=\"$row[7]\" alt=\"\"></span></div></td><td><A href=\"pro.php?proid=$proid\"><SPAN style=\"FONT-WEIGHT: normal; \n";
echo "</td><td><A href=\"pro.php?proid=$proid\"><SPAN style=\"FONT-WEIGHT: normal;FONT-SIZE: 9pt; LINE-HEIGHT: normal; FONT-STYLE: normal; FONT-VARIANT: normal\" title=\"�鿴����\">\n";

echo $row[7];
echo "</SPAN></A></td></tr></table></TD>\n";
echo "<TD align=center><SPAN style=\"FONT-WEIGHT: normal; FONT-SIZE: 9pt; LINE-HEIGHT: normal; \n";
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
//	{echo "<td><A HREF=\"profile_edit.php\" ><IMG SRC=../image/editit.png border=0 alt=\"�༭��Ա����\" title=\"�༭��Ա����\"></A>&nbsp;&nbsp;<A HREF=\"\" >����</A></td>";}
 if ($row[8]==0)
	{echo "<td><A HREF=\"profile_edit.php\"><FORM METHOD=POST ACTION=\"$PHP_SELF\"><IMG SRC=../image/editit.gif border=0 alt=\"�༭��Ա����\" title=\"�༭��Ա����\"></A>&nbsp;&nbsp;<INPUT TYPE=\"hidden\" value=$row[0] name=fr><input type=image class=active src=../image/active.gif onclick=\"javascript: return confirm('ȷʵҪ���ø��ʺţ�')\"  title=\"���ø��ʺ�\"></FORM></td>";}
echo "<tr ><td colspan=6 style='BORDER-BOTTOM: #cccccc 1px dashed'  height='2'>&nbsp;</td></tr>";
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
?>
<!-- <div class="in ltin tpin">
sadsdsds
</div> -->
<tr><td align=right colspan=6><B>������ӣ�<A HREF="admin.php">���Ա</A></B></td></tr>
</TABLE>
</td>
</tr>
</TABLE>
</BODY>
</HTML>
