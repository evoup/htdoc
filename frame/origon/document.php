<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
<title>���Ĺ���</title>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312" />
<script type="text/javascript" src="../js/static/xtree.js"></script>

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
<a href="xtree.rar">����</a>
<p><button onclick="debug();">���¼����첽��</button> &nbsp;
<button onclick="getSel();">�鿴ѡ��ڵ�ֵ</button>
<br><br>
�첽���ش�ѡ������:<br>

<div style="background:#EEEEEE;width:200px;height:250px;overflow:auto">
<script type="text/javascript">
var atree = new WebFXLoadTree("���Ĺ���ϵͳ","document_general.xml");
//var rti;
//var tree = new WebFXTree("Root");
//atree.add(new WebFXTreeItem("Tree Item 1"));
//atree.add(new WebFXLoadTreeItem("Tree Item 2", "document_general.xml"));
//atree.add(rti = new WebFXLoadTreeItem("Tree Item 3 (Reload)", "document_general.xml"));
//atree.add(new WebFXTreeItem("Tree Item 4"));
document.write(atree);
</script>
</div>
<!-- <hr> -->
<!-- ��ͨ��:
<script  language="javascript">

	var tree = new WebFXTree('Root');
	tree.setBehavior('classic');
	var a = new WebFXTreeItem('ffff');
	tree.add(a);
	var b = new WebFXTreeItem('1.1');
	a.add(b);
	b.add(new WebFXTreeItem('1.1.1'));
	var f = new WebFXTreeItem('1.1.4');
	b.add(f);
	f.add(new WebFXTreeItem('1.1.4.1'));
	var c = new WebFXTreeItem('1.2');
	a.add(c);
	c.add(new WebFXTreeItem('1.5.1'));
	a.add(new WebFXTreeItem('1.3'));

	var d = new WebFXTreeItem('2');
	tree.add(d);
	var e = new WebFXTreeItem('2.1');
	d.add(e);
	e.add(new WebFXTreeItem('2.1.1'));
	d.add(new WebFXTreeItem('2.2'));
	d.add(new WebFXTreeItem('2.3'));
	document.write(tree);

</script>	
 -->






<FORM METHOD=POST ACTION="document.php">

current menugrade
<INPUT TYPE="text" NAME="x" value=now id=x ><br>superior menuid
<INPUT TYPE="text" NAME="y" value=now id=y >
<BR>

����<BR><INPUT TYPE="submit" value='ɾ���ļ���Ŀ¼'>
</FORM>
<A HREF=''></A><p><button onclick="atree.indexOf('�����͹���').reload()">Reload Item</button></p>
</body>
</html>
