<?
include ("myconst.php");
include("../include/dbclass.php");
if (!isset($_SESSION['name'])||!isset($_SESSION['acc'])||$_SESSION['acc']<5)
{
   echo "<script language='javascript'>alert('你没有权限!');window.location.href='../index.php';</script>";
   exit;
}
$sql="delete from vote_title where id='{$_GET['id']}'";

$result=$db->query($sql);
echo "<script language='javascript'>alert('主题删除成功!');history.go(-1);</script>";
?>