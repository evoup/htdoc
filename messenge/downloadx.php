<?php
$id=$_GET['id'];
//$oriname=$_GET[];
//echo $id;
//die;
//include("../include/dbclass.php");
include("../include/session_mysql.php");
include("../include/downloadfileclass.php");

$downloadfile = new DOWNLOADFILE('../upload_dir/attachments/20070104090310_2006Äê10ÔÂÉú²úÈÕ±¨.xls');
if (!$downloadfile->df_download()) echo "Sorry, we are experiencing technical difficulties downloading this file. Please report this error to Technical Support.";










//$filesize=filesize($filename);
//header("Content-Type:text/plain");
//header("Content-Type:pplication/octet-stream");
//header("Accept-Ranges:bytes");
//header("Content-Transfer-Encoding: base64 ");
//header("Accept-Length:".filesize($filename));
//header("Content-Disposition: attachment;filename=".basename($filename));
//header("Content-Disposition: attachment;filename=$oriname");
//header("Content-Transfer-Encoding: binary");
//@$fp = fopen($filename, 'rb');
//@flock($fp, 2);
//$attachment = @fread($fp, $filesize);
//@fclose($fp);
//echo $attachment;
?>