<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> 生成js文件 </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
</HEAD>

<BODY>
<?php
include("../include/checkpostandget.php");
require ("function.php");
echo "break ok";

class makes
{
//生成js
	function makejs($i,$content,$sort)
	{
echo "正在生成";
	$jsfile = "../../js/depusr_s.js";
	//必要的过滤函数
	//.........................
	$temp=$content;
	$jscontent=$temp;
include("../../include/dbclass.php");
error_reporting(E_ALL);
$db=new dbClass("root","getter","jzoa","localhost");
$db->connect();
mysql_query("SET NAMES 'utf8'");
$db->select();
 $result=$db->query("select * from department group by id");
$out="document.write(\"<select name=crew[] multiple=multiple size=20>\");\n";
while($row=$db->getarray($result)){
//echo "$row[depname] ";
$out.="document.write(\"<optgroup label=-------$row[depname]--------->\");\n";
//算法要优化
//$result2=$db->query("select * from usr,department  where usr.department=department.id and department.depname=\"$row[depname]\"");
//$result2=$db->query("select * from usr,department  where usr.department=department.id and department.depname=\"系统管理员\"");
$depname=$row[depname];
$sql="select * from usr,department  where usr.department=department.id and department.depname='{$row[depname]}'";
//$sql="select t1.id,t2.depname from usr AS t1,department AS t2 where t1.department=t2.id AND t2.depname='{$row[depname]}'";
$result2=$db->query($sql);
	while($row2=$db->getarray($result2)){
	echo $row2[nickname];

	//$out.="document.writeln(\"<option value=$row[depname]>$row[depname]</option>\");\n";
	$out.="document.write(\"<option value=$row2[0]>$row2[nickname]</option>\");\n";
//$out.="document.writeln(\"<option value=$row2[nickname]>11</option>\");\n";
	echo "<br>...........";
	}
}

$out.="document.write(\"</select>\")";


//echo "break ok4";
	//$out = "document.write(\"".addslashes($jscontent)."\");";  
	//$out="document.writeln(\"<select name=crew[] multiple=multiple>\");\n";
//	$out.="document.writeln(\"<option value=xebrax>Xebrax</option>\");\n";
//$out.="document.writeln(\"<option value=Snertal>Snertal</option>\");\n";
//$out.="document.writeln(\"<option value=Gosny>Gosny</option></select>\");\n";


	//创建目录
	//@createdir("../".$sort."_js");
	$rs = write_file($jsfile,$out); 
	if ($rs) {
				return ture;
				} else {
				return false;
				}
	}


}

$MK=new makes();
//测试
$content="看下，生了！！";
if (!$MK->makejs("", $content,"hot")) 
{
echo "生成selemulti.js失败！";
}
else
{
echo "100%done!";
}

?>
</BODY>
</HTML>
