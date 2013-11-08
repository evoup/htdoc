<?php
define('IN_EVP', true);
include("include/checkpostandget.php");
include('include/dbclass.php');
include("include/common.php");
require "inc/template.inc";
$tpl = new Template("template");
//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[##"; //修改左边界符为[##
$tpl->right_delimiter = "##]"; //修改右边界符##]
$tpl->set_file("main", "dcu.html");
$fs='Server-X236';
//$action=$_GET['action'];
if (!empty($_GET["id"])){
$cuid=$_GET["id"];}
else{$cuid=0;}
	$grid=$_GET["gd"];
$gradeid=1;//父目录ID，如果为1,就是顶级，默认是1
$superior=0; 
if ($action==edit){
//$editid=trim(safe_convert($_GET['pid']));
}
else{
//下面是depman基本页的开始
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
	$tpl->set_var("alert", "该文件夹下没有任何文件");
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
	$wjm_have_ext=$row[1];//存下有扩展名的文件名字
$tpl->set_var("wjm", "<IMG SRC=\"frame/images/linuxsuse/folder.png\" border=0> $row[1]");




if (ltrim(trim($row[4]))!=""){
$tpl->set_var("lst", "$row[moddate]");}//修改时间是
else
	{
$tpl->set_var("lst", "--");}

$filename=basename(ltrim(trim($row['subdirname'])),'.php');// 注意防inject，去掉php
	//目录算法，根据扩展名算，如果包含字符.表示是文件，否则是目录，但是对于片段这样的没有扩展名的
	//文件还要另外判断
if ($filename!=""){
$flag=explode(".",$filename);
if ($flag[sizeof($flag)-1]!=''){
$typ=extdiff($flag[sizeof($flag)-1]);
	$tpl->set_var("typ", "$typ");}

}


else
	{$tpl->set_var("typ", "文件夹");
	$tpl->set_var("lst", "N/A");}
	$tpl->set_var("size", "$row[5]");
	$tpl->set_var("alert", "");
	$tpl->set_var("alert_display","none");
	//$cuid=11;//ID
	//$grid=3;//等级ID
	
	$linkstr=' ';
	for ($sw=0,$c=$cuid,$g=$grid;$g>0;$g--){//sw控制第一次算法的话不用推出前一级,c就是查前一级的参数，g控制循环，就是等级
		//上一级目录算法
		//if (!is_int($cuid)){die('错误的参数');}

if ($sw==0){$sql="select superior  from fsdcu where id={$c} and   grade={$g}";	}
else {$sql="select superior  from fsdcu where id={$c} ";	}
		$shangjiid=$db->getfirst($sql);
		if ($shangjiid==''){die('错误的参数,未找到这个ID');}
		
		if ($sw!=0){$c=$shangjiid[0];
		$sqllink="select subdirname,grade from fsdcu where id='{$shangjiid[0]}'";
		}
		else{$sqllink="select subdirname,grade from fsdcu where id='{$c}'";
		

		$sw=1;}//否则就是第一次，即最后一个
		$linktempstr=$db->getfirst($sqllink);
		
		

		//$linkstr=$linkstr.'\'.'<a href=>'.$linktempstr[0].'</a>';//由于算法是根据最后一个目录朝前算
		//所以要倒过来-_-!还好没用区块,不然没法反转了
        if (!empty($linktempstr[0])){
		$linkstr=str_replace($linkstr, '\<a href=dcu.php?id='.$c.'&gd='.$g.'>'.$linktempstr[0].'</a>'.$linkstr, $linkstr);//反转
		if ($i==0)//如果第一次解释区块，那么就赋href,以后就保留
			{$linkstr1=str_replace($linkstr,'\\'.$linktempstr[0].$linkstr1,$linkstr);}
		else{$linkstr1=$linkstr1;}
		
		}
		else{
		$linkstr=str_replace($linkstr, '<a href=dcu.php>'.$linktempstr[0].'</a>'.$linkstr, $linkstr);
		
		}


		}
	$tpl->set_var("link","\\\<A HREF=\"dcu.php\">$fs</A>{$linkstr}");
	
	//对之前的href如果是文件的话就指向实际路径，换图标
	if ($flag[sizeof($flag)-1]!=''){$tpl->set_var("wjmhref","file:/\\$fs$linkstr1\\$wjm_have_ext");
	$ico=$flag[sizeof($flag)-1];
	$tpl->set_var("wjm", "<IMG SRC=\"image/attach/$ico.gif\" border=0> $row[1]");
	$tpl->set_var("tar","_blank");
	}
	else{$tpl->set_var("tar","");}//否则设置target为空
	$tpl->parse("nlist", "list", true);
	$i++;
	}
//depmain基本页结束
}


$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");

?>