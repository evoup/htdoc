<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
<title>���Ĺ���</title>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312" />
<script type="text/javascript" src="../js/static/xtree.js"></script>
<script type="text/javascript" src="../js/static/xmlextras.js"></script>
<script type="text/javascript" src="../js/static/xloadtree.js"></script>
<link type="text/css" rel="stylesheet" href="../css/xtree.css" />
<!-- ����Ҫ�Ӹ�js�������ݵ�xml���js call-->
<SCRIPT LANGUAGE="JavaScript">
<!--
function call(a,b){
//alert(a+b);
document.getElementById('x').value=a;
document.getElementById('y').value=b;
var gourl="?x="+a+"&y="+b;//alert(url);

//return gourl;
}

//-->
</SCRIPT>
<script language="javascript">
function debug(){
	atree.reload();
}

function getSel(){
	var astr = tree.getSelectIds();
	alert(astr);
}
</script>
</head>
<body style="background:#CCCCCC;font-size:9pt" >
<?php
include("../include/checkpostandget.php");
include("../include/common.php");
/*include("../include/session_mysql.php");
session_start();
if (!isset($_SESSION ['name'])) 
{
die("��û��Ȩ�޽��뱾��Ŀ!");
}*/
$x=intval(safe_convert($_POST['x']));
echo $x;
$y=intval(safe_convert($_POST['y']));
echo $y;
include("../include/dbclass.php");
$sql="update menu set isdel=1 where menu_grade='{$x}'and menu_superior='{$y}' ";
//$sql="update menu set isdel=0";
$db->query($sql);
echo "<SCRIPT LANGUAGE=\"JavaScript\">alert(\"�����ɹ����\");</SCRIPT>";
?>


<div style="background:#EEEEEE;width:200px;height:250px;overflow:auto">
<script type="text/javascript">
//var tree = new WebFXTree("Root");
//tree.add(new WebFXTreeItem("Tree Item 1"));
//var atree =tree.add(new WebFXLoadTreeItem("���Ĺ���ϵͳ", "document_general.xml"));
webFXTreeConfig.rootIcon		= "images/linuxsuse/folder.png";
webFXTreeConfig.openRootIcon	= "images/linuxsuse/openfolder.png";
webFXTreeConfig.folderIcon		= "images/linuxsuse/folder.png";
webFXTreeConfig.openFolderIcon	= "images/linuxsuse/openfolder.png";
webFXTreeConfig.fileIcon		= "images/linuxsuse/file.png";
webFXTreeConfig.lMinusIcon		= "images/linuxsuse/Lminus.png";
webFXTreeConfig.lPlusIcon		= "images/linuxsuse/Lplus.png";
webFXTreeConfig.tMinusIcon		= "images/linuxsuse/Tminus.png";
webFXTreeConfig.tPlusIcon		= "images/linuxsuse/Tplus.png";
webFXTreeConfig.iIcon			= "images/linuxsuse/I.png";
webFXTreeConfig.lIcon			= "images/linuxsuse/L.png";
webFXTreeConfig.tIcon			= "images/linuxsuse/T.png";
//var atree = new WebFXLoadTree("���Ĺ���ϵͳ","document_general.xml");

//var atree = new WebFXLoadTree("���Ĺ���ϵͳ","treeLARGE.xml");

var tree = new WebFXTree("���Ĺ�����");
tree.add(rti = new WebFXLoadTreeItem("���Ĺ���", "document_general.xml"));


document.write(tree);
</script>
</div>







<FORM METHOD=POST ACTION="document.php">

current menugrade
<INPUT TYPE="text" NAME="x" value=now id=x ><br>superior menuid
<INPUT TYPE="text" NAME="y" value=now id=y >
<BR>

����<BR><INPUT TYPE="submit" value='ɾ���ļ���Ŀ¼'>
</FORM>
<A HREF=''></A><p><button onclick="rti.reload()">Reload Item</button></p>
</body>
</html>
