<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> ����dep_s.js�ļ� </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
</HEAD>
<BODY>
<?php
require ("function.php");
//echo "break ok";
class makes
{
//����js
	function makejs($i,$content,$sort)
	{
echo "��������";
	$jsfile = "../../js/dep_s.js";
	//��Ҫ�Ĺ��˺���
	//.........................
	$temp=$content;
	$jscontent=$temp;
include("../../include/dbclass.php");
error_reporting(E_ALL);
$db=new dbClass("root","getter","jzoa","localhost");
$db->connect();
mysql_query("SET NAMES 'gbk'");
$db->select();
 $result=$db->query("select * from department group by id");

//echo "document.write(\"<select name=aa onchange=location='?page='+this.options\n";
//echo "[this.selectedIndex].value>\");\n";


//$out="document.write(\"<select name=aa>\");\n";
$out="document.write(\"<select name=aa onchange=location='?aa='+this.options";
$out.="[this.selectedIndex].value>\");\n";
$out.="document.write(\"<option value=na>��ѡ����</option>\");\n";
while($row=$db->getarray($result)){
	$out.="document.write(\"<option value=$row[id]>$row[depname]</option>\");\n";
	//д����״̬
	echo "<$row[id].$row[depname]><br>...........";
}
$out.="document.write(\"</select>\");\n";
	$rs = write_file($jsfile,$out); 
	if ($rs) {
				return true;
				} else {
				return false;
				}
	}
}
$MK=new makes();
//����
$content="�����ˣ���";
if (!$MK->makejs("", $content,"hot")) 
{
echo "����selemulti.jsʧ�ܣ�";
}
else
{
echo "<H3>100%���!</H3>";
}
?>
</BODY>
</HTML>
