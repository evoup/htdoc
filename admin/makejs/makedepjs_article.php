<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> 生成dep_s.js文件 </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META http-equiv=Content-Type content="text/html; charset=utf-8">
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
//生成js
	function makejs($i,$content,$sort)
	{
echo "正在生成";
	$jsfile = "../../js/dep_s_article.js";
	//必要的过滤函数
	//.........................
	$temp=$content;
	$jscontent=$temp;
include("../../include/dbclass.php");
error_reporting(E_ALL);
$db=new dbClass("root","jysysadmin","jyit","localhost");
$db->connect();
mysql_query("SET NAMES 'utf8'");
$db->select();
 $result=$db->query("select * from department group by id");

//echo "document.write(\"<select name=aa onchange=location='?page='+this.options\n";
//echo "[this.selectedIndex].value>\");\n";


//$out="document.write(\"<select name=aa>\");\n";
$out="document.write(\"<select name=aa \");\n";
$out.="document.write(\"<option value=na>请选择部门</option>\");\n";
while($row=$db->getarray($result)){
	$out.="document.write(\"<option value=$row[id]>$row[depname]</option>\");\n";
	//写生成状态
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
//测试
$content="生成了！！";
if (!$MK->makejs("", $content,"hot")) 
{
echo "生成selemulti.js失败！";
}
else
{
echo "<H3>100%完成!</H3>";
}
?>
</BODY>
</HTML>
