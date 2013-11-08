<?php
define('IN_EVP', true);
ob_start();
include("../include/session_mysql.php");
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<?
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?> 
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<style type="text/css">
<!--
#msgunread{
display:inline;
}
#leijia{
display:none;
}
-->
</style>
<!-- The xtree script file -->
<script src="../js/static/xtree.js"></script>
<link type="text/css" rel="stylesheet" href="../css/xtree.css"> 
<style>
	body { background: #90BED5; color: black; }
	input { width: 120px; }
</style>
<SCRIPT LANGUAGE="JavaScript" src='ajaxmsg.js'></SCRIPT>
</head>
<body onload='tree.expandAll();go();'><div style=""><b>欢迎您，<?php echo $_SESSION ['name'];?>!</b></div><IMG SRC="images/minus.png" WIDTH="19" HEIGHT="16" BORDER="0" ALT="">
<IMG SRC="../image/email.gif"  BORDER="0" ALT="">短消息<A HREF="../messenge/msgview.php" target="main">[<div id=msgunread >0</div>]</A>未读<IMG SRC="../image/xms.gif" HEIGHT="26" BORDER="0" ALT="小秘书"></div>
<div style="border:1px solid #000099;position: absolute; width: 152px; top: 45px; left: 5px;overflow: auto;">

<!-- js file containing the tree content, edit this file to alter the menu,
     the menu will be inserted where this tag is located in the document -->
<div style='margin-left:0px;'><div id='tree_countainer_bg'><?php
if ($_SESSION['acc']>6){//6,7
echo "<script src=\"tree.js\"></script>";
}
else if($_SESSION['acc']>3){
echo "<script src=\"tree1.js\"></script>";
}
?></div></div>
</div><div id=leijia value=0></div>
</body>
</html>
