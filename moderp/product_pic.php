<?php
define('IN_EVP', true);
//error_reporting(E_ALL);
error_reporting(E_ALL   ^   E_NOTICE);//��������Use of undefined constant HTTP_X_FORWARDED_FOR ,���ŵı���-_-!


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
//��ʱ���˳�
killsession_go_index(1);
die("");
//die("��û��Ȩ�޽��뱾��Ŀ!");
}








require_once('.././include/ext_page.class.php');
//   $page=new page(array('total'=>22,'perpage'=>5));
//   echo 'mode:1<br>'.$page->show();
 //echo '<!-- <hr>mode:2<br> -->'.$page->show(2);  
//   echo '<hr>mode:3<br>'.$page->show(3);
//   echo '<hr>mode:4<br>'.$page->show(4);





$perpage=10;//ÿҳ��¼��
//echo $_REQUEST['PB_page'];
if (isset($_REQUEST['PB_page'])){
//$curr_page=empty($_REQUEST['PB_page'])?$_REQUEST['PB_page']:1; //�������pageΪ���򷵻ص�ǰҳΪ1
$curr_page=$_REQUEST['PB_page'];
}
else 
{$curr_page=1;}

$total_sql="select count(*) as total from erp_product group by picsrc";//��������ܼ�¼����sql���
$sql="select * from erp_product limit ".($curr_page-1)*$perpage.",".$perpage;//��ҳ��¼��sql���
//echo $sql;
//���ݿ��������ʡ�ԣ�ͨ��$total_sql�õ�$total ��$total�����ܼ�¼��
//��¼����ʾ����ʡ��
$result=$db->query($sql);
echo "<br>";

//while($row=$db->getarray($result)){
//echo $row[1].$row[2];
//}
///////////////////////////////////////
$tpl = new Template(".././template");


//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[##"; //�޸���߽��Ϊ[##
$tpl->right_delimiter = "##]"; //�޸��ұ߽��##]
$tpl->set_file("main", "erp/product_pic.html");

$tpl->set_block("main", "list", "nlist");




$sql='select * from erp_product group by picsrc';
$result=$db->query($sql);
//$sql="INSERT INTO `erp_product` VALUES (NULL , '���ι�', '101.6*101.6', 'Q235A','3', 'Բ�䷽', '0', '674', '600����', '001.pic')";
//$result=$db->query($sql);
while($row=$db->getarray($result)){
$tpl->set_var("id","$row[0]");//��ֵά��������ֵ�ı���

$tpl->set_var("picsrc", "$row[9]");
$tpl->parse("nlist", "list", true);
}






$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
///////////////////////////////////////


$page=new page(array('total'=>$result,'perpage'=>$perpage));
echo '<!-- mode:1<br> -->'.$page->show();



?>