<?php
define('IN_EVP', true);
include("../include/checkpostandget.php");
include('../include/dbclass.php');
include("../include/common.php");
require "../inc/template.inc";
$tpl = new Template("../template");

//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[##"; //�޸���߽��Ϊ[##
$tpl->right_delimiter = "##]"; //�޸��ұ߽��##]
$tpl->set_file("main", "admin_group_set.html");
$action=$_GET['action'];
if ($action==edit){
$editid=trim(safe_convert($_GET['pid']));

$sqle='select * from department where id={$editid}';

}
else{
//������depman����ҳ�Ŀ�ʼ
$tpl->set_block("main", "list", "nlist"); 
$sql='select * from department';

$result=$db->query($sql);
while($row=$db->getarray($result)){
//echo "$row[1]";
$tpl->set_var("pid", "$row[0]");
$tpl->set_var("dep", "$row[1]");
if (ltrim(trim($row[2]))!=""){
$tpl->set_var("mng", "$row[2]");}//������˭
else
	{
$tpl->set_var("mng", "--");}

if (ltrim(trim($row[3]))!=""){//�绰
$tpl->set_var("tel", "$row[3]");}

//$tpl->set_var("tax", "$row[5]");}

else
	{
$tpl->set_var("mng", "N/A");}
$tpl->set_var("tel1", "$row[4]");
$tpl->set_var("tax", "$row[5]");
$tpl->set_var("edt", "�༭");
$tpl->parse("nlist", "list", true);
}
//depmain����ҳ����
}








$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");

?>




</HTML>
