<?php
define('IN_EVP', true);
header('Expires: 0'); // rfc2616 - Section 14.21
header('Last-Modified: ' . $GLOBALS['now']);
header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
header('Pragma: no-cache'); // HTTP/1.0


include("../include/session_mysql.php");
session_start(); 
if($_GET["action"]== strval( logout))
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
//echo $_GET["action"];
if($_GET["action"]== strval('logout'))
{
echo "��ѡ��ǳ�!";
// ���ַ����ǽ�ԭ��ע���ĳ����������
unset($_SESSION ['name']); 
// ���ַ������������� Session �ļ�
session_destroy(); 
}
include("../include/dbclass.php") ;

$totlerows=$db->getcount("select * from msg where inceptid='{$_SESSION['id']}' and isread =0;");
echo  $t=trim($totlerows);
if ($t>0)
{echo " <object data=\"music.mp3\" type=\"application/x-mplayer2\" width=\"0\" height=\"0\">\n";
echo "    <param name=\"src\" value=\"sound2.wav\">\n";
echo "  </object>\n";



//echo "<SCRIPT LANGUAGE=\"javascript\" defer> \n";
//echo "<!-- ";
//echo "<!-- \n";echo "if (msg && msg.open && !msg.closed) { alert ('yahoo is opening') } ";
//echo "msg=window.open('page.html');";
//echo "eval(msg);";
//echo "<!-- \n";echo "if (msg && msg.open && !msg.closed) { //alert ('yahoo is opening') } ";
//echo "--> \n";
//echo "</SCRIPT> \n";


echo "<SCRIPT LANGUAGE=\"JavaScript\" defer>\n";
echo "<!--\n";
echo "a=null;";
echo "if(a  &&  a.open  &&  !a.closed)  \n";
echo "a.focus();\n";
echo "else  \n";
echo "a=window.open('../frame/qmsg.php', 'newwindow', 'height=270, width=380, top=20, left=30, toolbar=no, menubar=no, scrollbars=no,resizable=no,location=no, statu s=no')  \n";echo "a.focus();\n";
echo "//-->\n";
echo "</SCRIPT>\n";



}



//echo "iconv( GB2312, UTF-8, ��������� )";
//echo ���������;
?>