<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<?php
include("../include/checkpostandget.php");
include("../include/session_mysql.php");
include("../fckeditor.php") ;
session_start();
if (!isset($_SESSION ['name'])) 
{
die("��û��Ȩ�޽��뱾��Ŀ!");
}
?>
	<head>
		<title>�����</title>
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
alert("���ⲻ��Ϊ�գ�");
return false;
}

}
//-->
</SCRIPT></head>
<BODY  topmargin=0>

<?php

$Recipientx=$_GET['Recipient'];
//echo "Recipientx��".$Recipientx;
include("../include/dbclass.php");

//�����ǳƲ鴦Ҫ������id
$res=$db->query("select nickname from usr where id='{$Recipientx}';");

$row=$db->getarray($res);

$recid=$row[nickname];
echo "<form action=\"postresult.php\" method=\"post\" target=\"_blank\" name=pstmsg id=pstmsg \n";
echo "onsubmit=\"javascript :return alertx();\">\n";
if((isset($recid))&&(!empty($recid))){
echo "����<INPUT TYPE=\"text\" NAME=\"Recipient\" readonly id=\"Recipient\" value= ".$recid.">";}
else{//�����Ƿ���
$Recipientx=$_POST['newRight'];
echo "<INPUT TYPE=\"text\" NAME=\"Recipient\" readonly id=\"Recipient\" value=".$Recipientx.">";
//$Recipientx = preg_split ("/[,]+/", $Recipientx);
//echo $v[2];

}

?>
��Ҫ��<INPUT TYPE="radio" NAME="lv" value="1">��Ҫ
<INPUT TYPE="radio" NAME="lv" value="0">��ͨ<br>
<A HREF="">��ͨѶ¼���</A>  |  <A HREF="">��ӳ���</A>  -  <A HREF="">�������</A><BR>
����<INPUT TYPE="text" NAME="bt" size=70 maxlength=20 id = "tit">
				

<?php
///	FCK����
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
//�ĳ�basic
$oFCKeditor->ToolbarSet = htmlspecialchars('Default');
//$oFCKeditor->ToolbarSet = htmlspecialchars('Basic');
$oFCKeditor->Value = '' ;
$oFCKeditor->Create() ;

?>

			<div align=center><input type="submit" value="�ύ" class="mybutton"></div>
			<INPUT TYPE="hidden" name="uid" value="<?php echo $Recipientx;?>">
		</form>
	</body>
</html>