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
//��ʱ���˳�
killsession_go_index(0);
die("");
//die("��û��Ȩ�޽��뱾��Ŀ!");
}


$editid=safe_convert($_GET['id']);
$tpl = new Template(".././template");


//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[##"; //�޸���߽��Ϊ[##
$tpl->right_delimiter = "##]"; //�޸��ұ߽��##]
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

//����ע��Ҫ�Ӻ�ע������򣬷���ת����ƥ��󽫵����޷���½
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
		echo "<script language='javascript'>alert('��Ʒ����Ϊ��!');window.location.href='editbom.php';</script>";
		exit;
	}
	elseif (empty($cpgg))
	{echo "<script language='javascript'>alert('��Ʒ�����Ϊ��!');window.location.href='editbom.php';</script>";
	exit;}
	elseif (empty($gz))
	{echo "<script language='javascript'>alert('���ֲ���Ϊ��!');window.location.href='editbom.php';</script>";
	exit;}
	elseif (empty($hd))
	{echo "<script language='javascript'>alert('��Ȳ���Ϊ��!');window.location.href='editbom.php';</script>";
	exit;}
	elseif (empty($gylx))
	{echo "<script language='javascript'>alert('�������Ͳ���Ϊ��!');window.location.href='editbom.php';</script>";
	exit;}
	/*elseif (empty($rt))//R������Ϊ0
	{echo "<script language='javascript'>alert('R�ǲ���Ϊ��!');window.location.href='editbom.php';</script>";
	exit;}*/
	elseif (empty($zkkd))
	{echo "<script language='javascript'>alert('չ����Ȳ���Ϊ��!');</script>";
	}
	elseif (empty($jz))
	{echo "<script language='javascript'>alert('���鲻��Ϊ��!');window.location.href='editbom.php';</script>";
	exit;}
	elseif (empty($picid))
	{echo "<script language='javascript'>alert('��Ҫѡ����״ͼƬ!');window.location.href='editbom.php';</script>";
	exit;}
	else{if (empty($tel1))
	{$type='--';}

		$sql="update erp_product set `��Ʒ`='{$cp}',`��Ʒ���`='{$cpgg}',`���`='{$hd}',`��������`='{$gylx}',`ԭ�Ͽ��`='{$zkkd}',`R��`='{$rt}',`����`='{$jz}',`picsrc`='{$picid}' where id='{$editid}';";

		$db->query($sql);
		echo "<script language='javascript'>alert('��Ϣ�޸ĳɹ�!');</script>";
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