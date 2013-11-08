<?php
define('IN_EVP', true);
require ".././inc/template.inc";
include('.././include/dbclass.php');

include(".././include/session_mysql.php");
include(".././include/common.php");
session_start();
include(".././include/check_if_iskick.php");
if (!isset($_SESSION['name'])) 
{
//超时就退出
killsession_go_index(0);
die("");
//die("你没有权限进入本栏目!");
}


$editid=safe_convert($_GET['id']);
$tpl = new Template(".././template");


//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[##"; //修改左边界符为[##
$tpl->right_delimiter = "##]"; //修改右边界符##]
$tpl->set_file("main", "erp/editbom.html");

$tpl->set_block("main", "list", "nlist");


$sql='select * from erp_product where id='.$editid;
$result=$db->query($sql);
//$result=$db->query($sql);
while($row=$db->getarray($result)){
$tpl->set_var("cp", "$row[1]");
$tpl->set_var("cpgg", "$row[2]");
$tpl->set_var("gz", "$row[3]");
$tpl->set_var("hd", "$row[4]");
$tpl->set_var("gylx", "$row[5]");
$tpl->set_var("rt", "$row[6]");
$tpl->set_var("zkkd", "$row[7]");
$tpl->set_var("jz", "$row[8]");
$tpl->set_var("pic_src", "$row[9]");

$tpl->parse("nlist", "list", true);
}




$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
//////////////////post SELF

//这里注意要加好注册的正则，否则转化不匹配后将导致无法登陆
if ($_POST["actionsflag"]=="1")
{
	$cp=trim(safe_convert($_POST["cp"]));
	$cpgg=trim(safe_convert($_POST["cpgg"]));
	$gz=trim(safe_convert($_POST["gz"]));
	$tel1=trim(safe_convert($_POST["tel1"]));
	$hd=trim(safe_convert($_POST["hd"]));
	$gylx=trim(safe_convert($_POST["gylx"]));
	$rt=trim(safe_convert($_POST["rt"]));
	$zkkd=trim(safe_convert($_POST["zkkd"]));
	$jz=trim(safe_convert($_POST["jz"]));
	$picid=trim(safe_convert($_POST["picid"]));


	if (empty($cp))
	{
		echo "<script language='javascript'>alert('产品不能为空!');window.location.href='editbom.php';</script>";
		exit;
	}
	elseif (empty($cpgg))
	{echo "<script language='javascript'>alert('产品规格不能为空!');window.location.href='editbom.php';</script>";
	exit;}
	elseif (empty($gz))
	{echo "<script language='javascript'>alert('钢种不能为空!');window.location.href='editbom.php';</script>";
	exit;}
	elseif (empty($hd))
	{echo "<script language='javascript'>alert('厚度不能为空!');window.location.href='editbom.php';</script>";
	exit;}
	elseif (empty($gylx))
	{echo "<script language='javascript'>alert('工艺类型不能为空!');window.location.href='editbom.php';</script>";
	exit;}
	/*elseif (empty($rt))//R角允许为0
	{echo "<script language='javascript'>alert('R角不能为空!');window.location.href='editbom.php';</script>";
	exit;}*/
	elseif (empty($zkkd))
	{echo "<script language='javascript'>alert('展开宽度不能为空!');</script>";
	}
	elseif (empty($jz))
	{echo "<script language='javascript'>alert('机组不能为空!');window.location.href='editbom.php';</script>";
	exit;}
	elseif (empty($picid))
	{echo "<script language='javascript'>alert('需要选择形状图片!');window.location.href='editbom.php';</script>";
	exit;}
	else{if (empty($tel1))
	{$type='--';}

		$sql="update erp_product set `产品`='{$cp}',`产品规格`='{$cpgg}',`厚度`='{$hd}',`工艺类型`='{$gylx}',`原料宽度`='{$zkkd}',`R角`='{$rt}',`机组`='{$jz}',`picsrc`='{$picid}' where id='{$editid}';";

		$db->query($sql);
		echo "<script language='javascript'>alert('信息修改成功!');</script>";
		//if ($_POST['actionsflag2']=='go')
		//	echo "<script language='javascript'>window.location.href='editbom.php';</script>";
		/*elseif ($_POST['actionsflag2']=='back')
			echo "<script language='javascript'>window.location.href='depman.php';</script>";
	}*/
	if ($_POST['actionsflag2']=='close')
			echo "<script language='javascript'>dialogArguments.location=\"yfgl.php\";window.close('editbom.php');</script>";
	}
}



//////////////////





?>