<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<?php
include("../include/checkpostandget.php");
include("../include/session_mysql.php");
include("../fckeditor.php") ;
session_start();
if (!isset($_SESSION ['name'])) 
{
die("你没有权限进入本栏目!");
}
?>
	<head>
		<title>表单结果</title>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
		<meta name="robots" content="noindex, nofollow">
			<link rel=stylesheet href="../css/css.css" type="text/css">
		
<SCRIPT LANGUAGE="JavaScript" type="text/javascript">
<!--
function alertx(){

var zt=document.getElementById("tit").value;
var tmpRus=zt.replace(/^\s+|\s+$/g,"");
if(zt.length==0)

{
alert("主题不能为空！");
return false;
}

}
//-->
</SCRIPT></head>
<BODY  topmargin=0>

<?php

$Recipientx=$_GET['Recipient'];
//echo "Recipientx是".$Recipientx;
include("../include/dbclass.php");

//根据昵称查处要发的人id
$res=$db->query("select nickname from usr where id='{$Recipientx}';");

$row=$db->getarray($res);

$recid=$row[nickname];
echo "<form action=\"postresult.php\" method=\"post\" target=\"_blank\" name=pstmsg id=pstmsg \n";
echo "onsubmit=\"javascript :return alertx();\">\n";
if((isset($recid))&&(!empty($recid))){
echo "发给<INPUT TYPE=\"text\" NAME=\"Recipient\" readonly id=\"Recipient\" value= ".$recid.">";}
else{//假如是发文
$Recipientx=$_POST['newRight'];
echo "<INPUT TYPE=\"text\" NAME=\"Recipient\" readonly id=\"Recipient\" value=".$Recipientx.">";
//$Recipientx = preg_split ("/[,]+/", $Recipientx);
//echo $v[2];

}

?>
重要性<INPUT TYPE="radio" NAME="lv" value="1">重要
<INPUT TYPE="radio" NAME="lv" value="0">普通<br>
<A HREF="">从通讯录添加</A>  |  <A HREF="">添加抄送</A>  -  <A HREF="">添加密送</A><BR>
主题<INPUT TYPE="text" NAME="bt" size=70 maxlength=20 id = "tit">
				

<?php
///	FCK引用
/// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
$sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

$oFCKeditor = new FCKeditor('FCKeditor1') ;
//$oFCKeditor->BasePath = $sBasePath ;
$oFCKeditor->BasePath = "../" ;
//if ( isset($_GET['Toolbar']) )
//	$oFCKeditor->ToolbarSet = htmlspecialchars($_GET['Toolbar']);
//改成basic
$oFCKeditor->ToolbarSet = htmlspecialchars('Default');
//$oFCKeditor->ToolbarSet = htmlspecialchars('Basic');
$oFCKeditor->Value = '' ;
$oFCKeditor->Create() ;

?>

			<div align=center><input type="submit" value="提交" class="mybutton"></div>
			<INPUT TYPE="hidden" name="uid" value="<?php echo $Recipientx;?>">
		</form>
	</body>
</html>