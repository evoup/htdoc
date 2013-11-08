<?php
define('IN_EVP', true);
//error_reporting(E_ALL);
error_reporting(E_ALL   ^   E_NOTICE);//否则会出现Use of undefined constant HTTP_X_FORWARDED_FOR ,优雅的报错-_-!


if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}


require ".././inc/template.inc";
include('.././include/dbclass.php');

include(".././include/session_mysql.php");
include(".././include/common.php");
session_start();
include(".././include/check_if_iskick.php");
if (!isset($_SESSION['name'])) 
{
//超时就退出
killsession_go_index(1);
die("");
//die("你没有权限进入本栏目!");
}








require_once('.././include/ext_page.class.php');
//   $page=new page(array('total'=>22,'perpage'=>5));
//   echo 'mode:1<br>'.$page->show();
 //echo '<!-- <hr>mode:2<br> -->'.$page->show(2);  
//   echo '<hr>mode:3<br>'.$page->show(3);
//   echo '<hr>mode:4<br>'.$page->show(4);





$perpage=10;//每页记录数
//echo $_REQUEST['PB_page'];
if (isset($_REQUEST['PB_page'])){
//$curr_page=empty($_REQUEST['PB_page'])?$_REQUEST['PB_page']:1; //如果参数page为空则返回当前页为1
$curr_page=$_REQUEST['PB_page'];
}
else 
{$curr_page=1;}

$total_sql="select count(*) as total from erp_product group by picsrc";//用来查出总记录数的sql语句
$sql="select * from erp_product limit ".($curr_page-1)*$perpage.",".$perpage;//分页记录集sql语句
//echo $sql;
//数据库操作部分省略，通过$total_sql得到$total ，$total即是总记录数
//记录集显示部分省略
$result=$db->query($sql);
echo "<br>";

//while($row=$db->getarray($result)){
//echo $row[1].$row[2];
//}
///////////////////////////////////////
$tpl = new Template(".././template");


//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[##"; //修改左边界符为[##
$tpl->right_delimiter = "##]"; //修改右边界符##]
$tpl->set_file("main", "erp/product_pic.html");

$tpl->set_block("main", "list", "nlist");




$sql='select * from erp_product group by picsrc';
$result=$db->query($sql);
//$sql="INSERT INTO `erp_product` VALUES (NULL , '矩形管', '101.6*101.6', 'Q235A','3', '圆变方', '0', '674', '600机组', '001.pic')";
//$result=$db->query($sql);
while($row=$db->getarray($result)){
$tpl->set_var("id","$row[0]");//传值维护窗口数值的变量

$tpl->set_var("picsrc", "$row[9]");
$tpl->parse("nlist", "list", true);
}






$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
///////////////////////////////////////


$page=new page(array('total'=>$result,'perpage'=>$perpage));
echo '<!-- mode:1<br> -->'.$page->show();



?>