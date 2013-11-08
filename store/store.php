<?php
define('IN_EVP', true);
include("../include/session_mysql.php");
session_start();
if (!isset($_SESSION ['name']))
{
die("你没有权限进入本栏目!");
}


include ("../inc/template.inc");
$tpl = new Template("../template");
$tpl->set_file("main", "store.html");
$tpl->set_block("main", "list", "nlist"); //加载模板main中的块list,并给其一个名字nlist



include("../include/dbclass.php");
$sql="select * from store";
$rs=$db->query($sql);
while ( $row = mysql_fetch_array($rs))
{
$tpl->set_var("sd_name" , $row[1]);
$tpl->set_var("sd_type" , $row[2]);
$tpl->set_var("sd_plannum" , $row[3]);
$tpl->set_var("sd_unit" , $row[4]);
$tpl->set_var("sd_approvenum" , $row[5]);
//调试权限
if (1==1)
$tpl->set_var("action" , "<a href=>详细</a>|<a href=deletem.php?id=$row[0] onclick=\"javascript: return confirm('确实要删除？')\">删除</a>|<a href=editm.php?id=$row[0]>修改</a>");
if (1==2)
$tpl->set_var("action" , "--");



$tpl->parse("nlist", "list", true);
}
//调试权限
if (1==1)
$tpl->set_var("sd_additem" , "<a href='additem.php'>添加新物品</a>");

$tpl->parse("mains", "main");
$tpl->p("mains");
?>
