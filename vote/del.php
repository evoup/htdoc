<?
include ("myconst.php");
include("../include/dbclass.php");
if (!isset($_SESSION['name'])||!isset($_SESSION['acc'])||$_SESSION['acc']<5)
{
   echo "<script language='javascript'>alert('��û��Ȩ��!');window.location.href='../index.php';</script>";
   exit;
}
$sql="delete from vote_title where id='{$_GET['id']}'";

$result=$db->query($sql);
echo "<script language='javascript'>alert('����ɾ���ɹ�!');history.go(-1);</script>";
?>