<?php

$id=$_GET['id'];
//$oriname=$_GET[];
//echo $id;
//die;
include("../include/dbclass.php");
include("../include/session_mysql.php");
session_start();
include("../include/check_if_iskick.php");
if (!isset($_SESSION ['name'])) 
{
die("你没有权限进入本栏目!");
}
$result2=$db->query("select * from attachments where ID='{$id}'");



while ( $row2 = mysql_fetch_array($result2)){$filename0=$row2['src'];$oriname=utf8_decode($row2['name']);}

$filename='../upload_dir/attachments/'.$filename0;
$filesize=filesize($filename);
//header("Content-Type:text/plain");
ob_end_clean();
ob_start();
header("Content-Type:pplication/octet-stream");
header("Accept-Ranges:bytes");
//header("Content-Transfer-Encoding: base64 ");
//header("Accept-Length:".filesize($filename));
//header("Content-Disposition: attachment;filename=".basename($filename));
header("Content-Disposition: attachment;filename=$oriname");
header("Content-Transfer-Encoding: binary");
@$fp = fopen($filename, 'rb');
@flock($fp, 2);
$attachment = @fread($fp, $filesize);
@fclose($fp);
echo $attachment;
?>