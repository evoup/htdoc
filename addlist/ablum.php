<?php
define('IN_EVP', true);
require "../inc/template.inc";
include "../include/common.php";
$tpl = new Template("../template");

//evoupV1.1 phplibupdate
//$tpl->unknowns = "keep";
//$tpl->left_delimiter = "[##"; //�޸���߽��Ϊ[##
//$tpl->right_delimiter = "##]"; //�޸��ұ߽��##]




$tpl->set_file("main", "ablum.html");
$tpl->set_block("main", "list", "nlist"); 
include("../include/dbclass.php");
$sql="select t1.src,t2.nickname from usrimg as t1,usr as t2 where t1.id=t2.usrimg";
if(isset($_GET['action'])&&$_GET['action']=='search')
{
$names=$_POST['empname'];
if(safe_convert($names)=='')
	{
	echo "<script language='javascript'>alert('������!');history.go(-1);</script>";
	die;}
$sql="select t1.src,t2.nickname from usrimg as t1,usr as t2 where t1.id=t2.usrimg and t2.nickname like '%{$names}%'";
}



$rs=$db->query($sql);

	if($db->getcount($sql)==0)
	{
echo "<script>alert('û���ҵ���ؼ�¼��');history.go(-1);</script>";
die;
	}
while ( $row = mysql_fetch_array($rs))
{
$tpl->set_var("imgsrc","../upload_dir/".$row['src']);
$tpl->set_var("imgalt",$row['nickname']);
$tpl->set_var("imgtext",$row['nickname']);
$tpl->parse("nlist", "list", true);
}
$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
?>