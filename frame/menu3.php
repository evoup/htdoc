<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> 菜单 </TITLE>
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
echo "你已经登出系统!";
// 这种方法是将原来注册的某个变量销毁
unset($_SESSION ['name']); 
unset($_SESSION ['staff']);
// 这种方法是销毁整个 Session 文件
session_destroy(); 
//跳出frame
echo "<SCRIPT LANGUAGE=JAVASCRIPT>\n";
echo "<!-- \n";
echo "if (top.location !== self.location) {\n";
echo "top.location=self.location;\n";
echo "}\n";
echo "</SCRIPT>\n";
}
if (isset($_SESSION['name'])) 
{ 
//echo "您已经成功登陆<br>"; 
} 
else 
{ 
// 验证失败，将 $_SESSION["admin"] 置为 false
//$_SESSION[’name’] = false; 
die("您无权访问本栏目!"); 
}
//echo $_GET["action"];
if($_GET["action"]== strval( logout))
{
echo "你选择登出!";
// 这种方法是将原来注册的某个变量销毁
unset($_SESSION ['name']); 
// 这种方法是销毁整个 Session 文件
session_destroy(); 
}
require "../inc/template.inc";
$tpl = new Template("../template");

//evoupV1.1 phplibupdate
$tpl->unknowns = "keep";
$tpl->left_delimiter = "[##"; //修改左边界符为[##
$tpl->right_delimiter = "##]"; //修改右边界符##]
$tpl->set_file("main", "menu.html");
//$admin_menu=
//"<DIV class=box><H5 class=\"box\">&nbsp;系统管理&nbsp;</H5><DIV class=body><DIV class=\"content odd\"><IMG src=\"../image/icot.png\" border=0> <A href=\"\">操作日志</A><BR><IMG src=\"../image/icot.png\" border=0> <A href=\"\">登陆日志</A><BR><IMG src=\"../image/icot.png\" border=0> <A href=\"\">用户管理</A><BR><IMG src=\"../image/icot.png\" border=0> <A href=\"\">模块管理</A><BR><IMG src=\"../image/icot.png\" border=0> <A href=\"\">角色管理</A><BR><IMG src=\"../image/icot.png\" border=0> <A href=\"\">目录管理</A><BR></DIV></DIV></DIV><br />";
$admin_menu=
"<DIV class=box><H5 class=\"box\">&nbsp;系统管理&nbsp;</H5><DIV class=body><DIV class=\"content odd\"><script type=\"text/javascript\">webFXTreeConfig.rootIcon		= \"images/linuxsuse/folder.png\";webFXTreeConfig.openRootIcon	= \"images/linuxsuse/openfolder.png\";webFXTreeConfig.folderIcon		= \"images/linuxsuse/folder.png\";webFXTreeConfig.openFolderIcon	= \"images/linuxsuse/openfolder.png\";webFXTreeConfig.fileIcon		= \"images/linuxsuse/file.png\";webFXTreeConfig.lMinusIcon		= \"images/linuxsuse/Lminus.png\";webFXTreeConfig.lPlusIcon		= \"images/linuxsuse/Lplus.png\";webFXTreeConfig.tMinusIcon		= \"images/linuxsuse/Tminus.png\";webFXTreeConfig.tPlusIcon		=\"images/linuxsuse/Tplus.png\";webFXTreeConfig.iIcon			=\"images/linuxsuse/I.png\";webFXTreeConfig.lIcon			= \"images/linuxsuse/L.png\";webFXTreeConfig.tIcon			= \"images/linuxsuse/T.png\";var tree = new WebFXLoadTree(\"系统管理\",\"sys_general.xml\");tree.write();</script></DIV></DIV></DIV><br>";








//$personnelmatters_menu=
//"<DIV class=box><H5 class=\"box\">&nbsp;人事管理&nbsp;</H5><DIV class=body><DIV class=\"content odd\"><IMG src=\"../image/icot.png\" border=0> <A  href=\"\">部门管理*</A><BR><IMG  src=\"../image/icot.png\" border=0> <A href=\"../addlist/admin.php\" target=\"main\">人员管理</A><BR><IMG src=\"../image/icot.png\" border=0> <A href=\"../addlist/ablum.php\" target=\"main\">人员照片</A><BR><IMG src=\"../image/icot.png\" border=0> <A href=\"../admin/makejs/makedepusr_transfer.php\" target=\"main\">生成人员列表</A><BR></DIV></DIV></DIV><br>";
$personnelmatters_menu=
"<DIV class=box><H5 class=\"box\">&nbsp;人事管理&nbsp;</H5><DIV class=body><DIV class=\"content odd\"><script type=\"text/javascript\">webFXTreeConfig.rootIcon		= \"images/linuxsuse/folder.png\";webFXTreeConfig.openRootIcon	= \"images/linuxsuse/openfolder.png\";webFXTreeConfig.folderIcon		= \"images/linuxsuse/folder.png\";webFXTreeConfig.openFolderIcon	= \"images/linuxsuse/openfolder.png\";webFXTreeConfig.fileIcon		= \"images/linuxsuse/file.png\";webFXTreeConfig.lMinusIcon		= \"images/linuxsuse/Lminus.png\";webFXTreeConfig.lPlusIcon		= \"images/linuxsuse/Lplus.png\";webFXTreeConfig.tMinusIcon		= \"images/linuxsuse/Tminus.png\";webFXTreeConfig.tPlusIcon		=\"images/linuxsuse/Tplus.png\";webFXTreeConfig.iIcon			=\"images/linuxsuse/I.png\";webFXTreeConfig.lIcon			= \"images/linuxsuse/L.png\";webFXTreeConfig.tIcon			= \"images/linuxsuse/T.png\";var tree = new WebFXLoadTree(\"人事管理\",\"personel_general.xml\");tree.write();</script></DIV></DIV></DIV><br>";




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