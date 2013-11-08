<?php
define('IN_EVP', true);
include("../include/checkpostandget.php");
include('../include/dbclass.php');
include("../include/common.php");
include(".././include/session_mysql.php");
session_start();
include(".././include/check_if_iskick.php");
if (!isset($_SESSION['name'])) 
{
//超时就退出
killsession_go_index(1);
die("");
//die("你没有权限进入本栏目!");
}
require "../inc/template.inc";
$tpl = new Template("../template");

//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[##"; //修改左边界符为[##
$tpl->right_delimiter = "##]"; //修改右边界符##]
$tpl->set_file("main", "depman.html");
$action=$_GET['action'];
if ($action==edit){
$editid=trim(safe_convert($_GET['pid']));

$sqle='select * from department where id={$editid}';

}
else{
//下面是depman基本页的开始
$tpl->set_block("main", "list", "nlist"); 
$sql='select * from department';

$result=$db->query($sql);
while($row=$db->getarray($result)){
//echo "$row[1]";
$tpl->set_var("pid", "$row[0]");
$tpl->set_var("dep", "$row[1]");
if (ltrim(trim($row[2]))!=""){
$tpl->set_var("mng", "$row[2]");}//主管是谁
else
	{
$tpl->set_var("mng", "--");}

if (ltrim(trim($row[3]))!=""){//电话
$tpl->set_var("tel", "$row[3]");}

//$tpl->set_var("tax", "$row[5]");}

else
	{
$tpl->set_var("mng", "N/A");}
$tpl->set_var("tel1", "$row[4]");
$tpl->set_var("tax", "$row[5]");
$tpl->set_var("edt", "编辑");
$tpl->parse("nlist", "list", true);
}
//depmain基本页结束
}








$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");

?>




</HTML>
