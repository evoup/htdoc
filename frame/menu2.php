<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> �˵� </TITLE>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?>
<link rel=stylesheet href="../css/css.css" type="text/css">

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
<body> 
<SCRIPT LANGUAGE="JavaScript">
<!--
var xmlHttp;
function createXMLHttpRequest(){
if (window.ActiveXObject){xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");}
else if (window.XMLHttpRequest){xmlHttp=new XMLHttpRequest();}
}
function go() {
            createXMLHttpRequest();            
            xmlHttp.open("GET", "news.php?time=new Date().getTime()", true);
            xmlHttp.onreadystatechange = goCallback;
            xmlHttp.send("");
        }
function goCallback() {
            if (xmlHttp.readyState == 4) {
                if (xmlHttp.status == 200) {
					var msg = document.getElementById("msgunread");

					msg.innerHTML=xmlHttp.responseText;
					
                    setTimeout("pollServer()", 5000);
                }
            }
        }
function pollServer() {
go();
        }
//-->
</SCRIPT>
</HEAD>
<BODY topmargin="0"  onload="go();">
<?php
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
if($_GET["action"]== strval( logout))
{
echo "��ѡ��ǳ�!";
// ���ַ����ǽ�ԭ��ע���ĳ����������
unset($_SESSION ['name']); 
// ���ַ������������� Session �ļ�
session_destroy(); 
}
require "../inc/template.inc";
$tpl = new Template("../template");

//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[##"; //�޸���߽��Ϊ[##
$tpl->right_delimiter = "##]"; //�޸��ұ߽��##]
$tpl->set_file("main", "menu.html");
//$admin_menu=
//"<DIV class=box><H5 class=\"box\">&nbsp;ϵͳ����&nbsp;</H5><DIV class=body><DIV class=\"content odd\"><IMG src=\"../image/icot.png\" border=0> <A href=\"\">������־</A><BR><IMG src=\"../image/icot.png\" border=0> <A href=\"\">��½��־</A><BR><IMG src=\"../image/icot.png\" border=0> <A href=\"\">�û�����</A><BR><IMG src=\"../image/icot.png\" border=0> <A href=\"\">ģ�����</A><BR><IMG src=\"../image/icot.png\" border=0> <A href=\"\">��ɫ����</A><BR><IMG src=\"../image/icot.png\" border=0> <A href=\"\">Ŀ¼����</A><BR></DIV></DIV></DIV><br />";
$admin_menu=
"<DIV class=box><H5 class=\"box\">&nbsp;ϵͳ����&nbsp;</H5><DIV class=body><DIV class=\"content odd\"><script type=\"text/javascript\">webFXTreeConfig.rootIcon		= \"images/linuxsuse/folder.png\";webFXTreeConfig.openRootIcon	= \"images/linuxsuse/openfolder.png\";webFXTreeConfig.folderIcon		= \"images/linuxsuse/folder.png\";webFXTreeConfig.openFolderIcon	= \"images/linuxsuse/openfolder.png\";webFXTreeConfig.fileIcon		= \"images/linuxsuse/file.png\";webFXTreeConfig.lMinusIcon		= \"images/linuxsuse/Lminus.png\";webFXTreeConfig.lPlusIcon		= \"images/linuxsuse/Lplus.png\";webFXTreeConfig.tMinusIcon		= \"images/linuxsuse/Tminus.png\";webFXTreeConfig.tPlusIcon		=\"images/linuxsuse/Tplus.png\";webFXTreeConfig.iIcon			=\"images/linuxsuse/I.png\";webFXTreeConfig.lIcon			= \"images/linuxsuse/L.png\";webFXTreeConfig.tIcon			= \"images/linuxsuse/T.png\";var tree = new WebFXLoadTree(\"ϵͳ����\",\"sys_general.xml\");tree.write();</script></DIV></DIV></DIV><br>";








//$personnelmatters_menu=
//"<DIV class=box><H5 class=\"box\">&nbsp;���¹���&nbsp;</H5><DIV class=body><DIV class=\"content odd\"><IMG src=\"../image/icot.png\" border=0> <A  href=\"\">���Ź���*</A><BR><IMG  src=\"../image/icot.png\" border=0> <A href=\"../addlist/admin.php\" target=\"main\">��Ա����</A><BR><IMG src=\"../image/icot.png\" border=0> <A href=\"../addlist/ablum.php\" target=\"main\">��Ա��Ƭ</A><BR><IMG src=\"../image/icot.png\" border=0> <A href=\"../admin/makejs/makedepusr_transfer.php\" target=\"main\">������Ա�б�</A><BR></DIV></DIV></DIV><br>";
$personnelmatters_menu=
"<DIV class=box><H5 class=\"box\">&nbsp;���¹���&nbsp;</H5><DIV class=body><DIV class=\"content odd\"><script type=\"text/javascript\">webFXTreeConfig.rootIcon		= \"images/linuxsuse/folder.png\";webFXTreeConfig.openRootIcon	= \"images/linuxsuse/openfolder.png\";webFXTreeConfig.folderIcon		= \"images/linuxsuse/folder.png\";webFXTreeConfig.openFolderIcon	= \"images/linuxsuse/openfolder.png\";webFXTreeConfig.fileIcon		= \"images/linuxsuse/file.png\";webFXTreeConfig.lMinusIcon		= \"images/linuxsuse/Lminus.png\";webFXTreeConfig.lPlusIcon		= \"images/linuxsuse/Lplus.png\";webFXTreeConfig.tMinusIcon		= \"images/linuxsuse/Tminus.png\";webFXTreeConfig.tPlusIcon		=\"images/linuxsuse/Tplus.png\";webFXTreeConfig.iIcon			=\"images/linuxsuse/I.png\";webFXTreeConfig.lIcon			= \"images/linuxsuse/L.png\";webFXTreeConfig.tIcon			= \"images/linuxsuse/T.png\";var tree = new WebFXLoadTree(\"���¹���\",\"personel_general.xml\");tree.write();</script></DIV></DIV></DIV><br>";




if (isset($_SESSION['acc'])&&$_SESSION['acc']>=5)
{$tpl->set_var("adminmenu", "$admin_menu");}
else {$tpl->set_var("adminmenu", "");}
if (isset($_SESSION['acc'])&&$_SESSION['acc']>=5)
{$tpl->set_var("personnelmattersmenu", "$personnelmatters_menu");}
else {$tpl->set_var("personnelmattersmenu", "");}
$tpl->parse("mains", "main");
$tpl->pparse("mains", "main");
?><BR><div id=leijia value=0></div></BODY>
</HTML>