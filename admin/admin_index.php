<?php
define('IN_EVP', true);
  include('../include/dbclass.php');
include('../include/session_mysql.php');
require_once('../include/ext_page.class.php');
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['admin_id']!=1){
die('没有权限');
}
//检查超时开始
	//$timeout=1200;      //超时时间,单位:秒,这里设为20分钟. 
	$timeout=300;      //超时时间,单位:秒,这里设为300秒. 
	$now=time(); 
	if(($now-$_SESSION[ "session_time"]) > $timeout) 
	{ 
	     //超时了. 
	     foreach ($_SESSION as $key=>$value){
	     unset($_SESSION[$key]);
	     @session_destroy();
	     }
	     //session_regenerate_id();//如果超时就再设置一个新的ID
	     die(" <script>alert( \"超时了. \");location.href='admin.php'; </script>"); 
	}else{ 
	     //还没超时. 
	     $_SESSION[ "session_time"]=time(); 
	}	
	//检查超时结束	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>admin_index</title>
</head>
<style type="text/css">
.cms{font-weight:bold;font-family:verdana;color:#3366FF}
.x{
font-size:12px;
font-family:verdana;
}
.x2{
color:gray;
text-align:left;
padding:0 0 0 20%;
line-height:30px;
}
</style>
<body><div style="margin-top:120px; text-align:center">
  <h3>欢迎使用<span class="cms">EVPCMS V1.0</span></h3>
  <p class="x">
    support <FONT SIZE="" COLOR="red">Mozilla FireFox</FONT></p>
  <p class="x x2"><?php

  
  
  echo "服务器软件：".$_SERVER["SERVER_SOFTWARE"];
  include ($_SERVER['DOCUMENT_ROOT'].'/include/lib_common.php');
  if (gzip_enabled()){
  	echo " GZIP enabled.";
  }
echo "<br>Mysql版本：".mysql_get_server_info();
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;服务器IP：".$_SERVER[SERVER_ADDR];
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;时区：". date("T",time());;
  ?></p>
  
</div>
</body>
</html>
