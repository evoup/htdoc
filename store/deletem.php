<?php
define('IN_EVP', true);
include("../include/session_mysql.php");
include("../include/common.php");
include("../include/dbclass.php");
$deleteid=trim(safe_convert($_GET['id']));
//echo $deleteid;

session_start();
if (!isset($_SESSION ['name'])) 
{
die("你没有权限进入本栏目!");
}


$sql="delete  from store where id='{$deleteid}'";
if($db->query($sql))

{echo "<SCRIPT LANGUAGE=\"JavaScript\">alert(\"操作成功完成\");history.go(-1);</SCRIPT>";}



?>