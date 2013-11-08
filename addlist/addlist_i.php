

<?php
include("../include/checkpostandget.php");
include("../include/session_mysql.php");
include("../include/common.php");
require "../inc/template.inc";
$tpl = new Template("../template");

//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[##"; //修改左边界符为[##
$tpl->right_delimiter = "##]"; //修改右边界符##]
$tpl->set_file("main", "skin7/addlist.html");
session_start();
if (!isset($_SESSION ['name']))
{
die("你没有权限进入本栏目!");
}
?>
<!-- 通讯录模块 -->

<?php
if(!isset($_POST["pagex"]))
$page=safe_convert($_GET["page"]);
else
$page=safe_convert($_POST["pagex"]);
//echo 'page是'.$page;
include("../include/dbclass.php");
//$totlerows=$db->getcount("select * from usr ");
$sql="select * from usr ";
//$sql="select t1.id, t1. email,t1.telm,t1.zhuceshijian,t2.src,t1.sex,t3.depname,t1.nickname  from usr AS t1, usrimg AS t2,department AS t3 where t1.usrimg = t2.id AND t1.department=t3.id group by id";
$result=$db->query($sql);
$tpl->set_block("main", "listx", "nlistx"); 
while ($row = mysql_fetch_array($result))
{$tpl->set_var('name',$row[1]);$tpl->set_var('mail',$row['email']);
$tpl->set_var('man','');$tpl->set_var('dep','');
$tpl->set_var('tel','');$tpl->set_var('isleave','');


$tpl->parse("nlistx", "listx", true);}

$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
?>
