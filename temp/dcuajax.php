<?php
define('IN_EVP', true);
include("include/checkpostandget.php");
include('include/dbclass.php');
include("include/common.php");
require "inc/template.inc";
$tpl = new Template("template");
//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[##"; //�޸���߽��Ϊ[##
$tpl->right_delimiter = "##]"; //�޸��ұ߽��##]
$tpl->set_file("main", "dcu.html");
$fs='Server-X236';
//$action=$_GET['action'];
if (!empty($_GET["id"])){
$cuid=$_GET["id"];}
else{$cuid=0;}
	$grid=$_GET["gd"];
$gradeid=1;//��Ŀ¼ID�����Ϊ1,���Ƕ�����Ĭ����1
$superior=0; 
if ($action==edit){
//$editid=trim(safe_convert($_GET['pid']));
}
else{
//������depman����ҳ�Ŀ�ʼ
$tpl->set_block("main", "list", "nlist"); 
$sql="select * from fsdcu where  superior={$cuid} ";
$result=$db->query($sql);
if ($db->getcount($sql)==0)
	{
	$tpl->set_var("wjm", "");
	$tpl->set_var("tar","");
	$tpl->set_var("lst", "");
	$tpl->set_var("typ", "");	
	$tpl->set_var("size", "");
	$tpl->set_var("link","\\\<A HREF=\"dcu.php\">$fs</A>");
	$tpl->parse("nlist", "list", true);
	$tpl->set_var("alert_display","block");
	$tpl->set_var("alert", "���ļ�����û���κ��ļ�");
	}
$i=0;
while($row=$db->getarray($result)){
//echo "$row[1]";
if ($i%2==0)
	{
$tpl->set_var("rowstyout","row");
}
else
	{
$tpl->set_var("rowstyout","rowhigh");
}
$tpl->set_var("rowstyover","row1");
$tpl->set_var("pid", "$row[ID]");
$tpl->set_var("gd", "$row[grade]");
$tpl->set_var("wjmhref", "dcu.php?id=$row[ID]&gd=$row[grade]");

//if ($row[superior]==0){
	$wjm_have_ext=$row[1];//��������չ�����ļ�����
$tpl->set_var("wjm", "<IMG SRC=\"frame/images/linuxsuse/folder.png\" border=0> $row[1]");




if (ltrim(trim($row[4]))!=""){
$tpl->set_var("lst", "$row[moddate]");}//�޸�ʱ����
else
	{
$tpl->set_var("lst", "--");}

$filename=basename(ltrim(trim($row['subdirname'])),'.php');// ע���inject��ȥ��php
	//Ŀ¼�㷨��������չ���㣬��������ַ�.��ʾ���ļ���������Ŀ¼�����Ƕ���Ƭ��������û����չ����
	//�ļ���Ҫ�����ж�
if ($filename!=""){
$flag=explode(".",$filename);
if ($flag[sizeof($flag)-1]!=''){
$typ=extdiff($flag[sizeof($flag)-1]);
	$tpl->set_var("typ", "$typ");}

}


else
	{$tpl->set_var("typ", "�ļ���");
	$tpl->set_var("lst", "N/A");}
	$tpl->set_var("size", "$row[5]");
	$tpl->set_var("alert", "");
	$tpl->set_var("alert_display","none");
	//$cuid=11;//ID
	//$grid=3;//�ȼ�ID
	
	$linkstr=' ';
	for ($sw=0,$c=$cuid,$g=$grid;$g>0;$g--){//sw���Ƶ�һ���㷨�Ļ������Ƴ�ǰһ��,c���ǲ�ǰһ���Ĳ�����g����ѭ�������ǵȼ�
		//��һ��Ŀ¼�㷨
		//if (!is_int($cuid)){die('����Ĳ���');}

if ($sw==0){$sql="select superior  from fsdcu where id={$c} and   grade={$g}";	}
else {$sql="select superior  from fsdcu where id={$c} ";	}
		$shangjiid=$db->getfirst($sql);
		if ($shangjiid==''){die('����Ĳ���,δ�ҵ����ID');}
		
		if ($sw!=0){$c=$shangjiid[0];
		$sqllink="select subdirname,grade from fsdcu where id='{$shangjiid[0]}'";
		}
		else{$sqllink="select subdirname,grade from fsdcu where id='{$c}'";
		

		$sw=1;}//������ǵ�һ�Σ������һ��
		$linktempstr=$db->getfirst($sqllink);
		
		

		//$linkstr=$linkstr.'\'.'<a href=>'.$linktempstr[0].'</a>';//�����㷨�Ǹ������һ��Ŀ¼��ǰ��
		//����Ҫ������-_-!����û������,��Ȼû����ת��
        if (!empty($linktempstr[0])){
		$linkstr=str_replace($linkstr, '\<a href=dcu.php?id='.$c.'&gd='.$g.'>'.$linktempstr[0].'</a>'.$linkstr, $linkstr);//��ת
		if ($i==0)//�����һ�ν������飬��ô�͸�href,�Ժ�ͱ���
			{$linkstr1=str_replace($linkstr,'\\'.$linktempstr[0].$linkstr1,$linkstr);}
		else{$linkstr1=$linkstr1;}
		
		}
		else{
		$linkstr=str_replace($linkstr, '<a href=dcu.php>'.$linktempstr[0].'</a>'.$linkstr, $linkstr);
		
		}


		}
	$tpl->set_var("link","\\\<A HREF=\"dcu.php\">$fs</A>{$linkstr}");
	
	//��֮ǰ��href������ļ��Ļ���ָ��ʵ��·������ͼ��
	if ($flag[sizeof($flag)-1]!=''){$tpl->set_var("wjmhref","file:/\\$fs$linkstr1\\$wjm_have_ext");
	$ico=$flag[sizeof($flag)-1];
	$tpl->set_var("wjm", "<IMG SRC=\"image/attach/$ico.gif\" border=0> $row[1]");
	$tpl->set_var("tar","_blank");
	}
	else{$tpl->set_var("tar","");}//��������targetΪ��
	$tpl->parse("nlist", "list", true);
	$i++;
	}
//depmain����ҳ����
}


$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");

?>