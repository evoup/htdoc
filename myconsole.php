<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>

<title></title>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?> 
 <!-- <link rel=stylesheet href="../css/css.css" type="text/css"> -->
<?php
include("include/session_mysql.php");
session_start();


?>
<SCRIPT LANGUAGE="JavaScript" src='ajaxmsg.js'></SCRIPT>
</HEAD>

<BODY>
<IMG SRC="image/email.gif"  BORDER="0" ALT="">����Ϣ<A HREF="messenge/msgview.php" target="main">[<span id=msgunread style='display:inline'  >0</span>]</A>δ��
<div style="position: absolute; width: 140px; top: 40px; left: 0px;  padding: 5px; overflow: auto;">
</div><div id=leijia value=0></div>




<?php
 
if($_GET["action"]== strval('logout'))
{
echo "���Ѿ��ǳ�ϵͳ!";
// ���ַ����ǽ�ԭ��ע���ĳ����������
unset($_SESSION ['name']); 
unset($_SESSION ['staff']);
// ���ַ������������� Session �ļ�
session_destroy(); 
//����frame
echo "<SCRIPT LANGUAGE=JAVASCRIPT>\n";
echo "<!-- \n";
echo "if (top.location !== self.location) {\n";
echo "top.location=self.location;\n";
echo "}\n";
echo "</SCRIPT>\n";
}
if (isset($_SESSION['name'])) 
{ 
//echo "���Ѿ��ɹ���½<br>"; 
} 
else 
{ 
// ��֤ʧ�ܣ��� $_SESSION["admin"] ��Ϊ false
//$_SESSION[��name��] = false; 
die("����Ȩ���ʱ���Ŀ!"); 
}


		$x=$_SESSION ['name'];
		$y=$_SESSION ['staff'];
		echo "���ã�<b>".$x."</b>!"." �����ǣ�";
echo $showtime=date('Y-m-d');



?>






</BODY>
</HTML>
